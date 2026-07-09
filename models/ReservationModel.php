<?php

require_once __DIR__ . '/Database.php';

/**
 * ReservationModel
 * Exécute exclusivement les requêtes SQL (INSERT, SELECT, UPDATE).
 * Ne contient aucune logique métier ni affichage.
 */
class ReservationModel
{
    private PDO $pdo;

    // Grille tarifaire (FCFA / nuit)
    public const TARIFS = [
        'STANDARD' => 25000,
        'CONFORT'  => 50000,
        'SUITE'    => 100000,
    ];

    // Liste des chambres de l'hôtel.
    public const ROOM_NUMBERS = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Insère une nouvelle réservation (statut VALIDEE par défaut en base).
     */
    public function create(string $nomClient, int $numeroChambre, int $nombreNuits, string $typeChambre): bool
    {
        $sql = "INSERT INTO reservations (nom_client, numero_chambre, nombre_nuits, type_chambre, statut)
                VALUES (:nom_client, :numero_chambre, :nombre_nuits, :type_chambre, 'VALIDEE')";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nom_client'      => $nomClient,
            ':numero_chambre'  => $numeroChambre,
            ':nombre_nuits'    => $nombreNuits,
            ':type_chambre'    => $typeChambre,
        ]);
    }

    /**
     * Retourne toutes les réservations actives (statut = VALIDEE).
     */
    public function getActiveReservations(): array
    {
        $sql = "SELECT * FROM reservations WHERE statut = 'VALIDEE' ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    /**
     * Retourne les chambres libres parmi celles de l'hôtel.
     */
    public function getAvailableRooms(): array
    {
        $sql = "SELECT numero_chambre FROM reservations WHERE statut = 'VALIDEE'";
        $stmt = $this->pdo->query($sql);
        $occupied = array_map('intval', array_column($stmt->fetchAll(), 'numero_chambre'));

        $available = array_diff(self::ROOM_NUMBERS, $occupied);
        sort($available, SORT_NUMERIC);

        return array_values($available);
    }

    /**
     * Recherche une réservation par son ID (toutes statuts confondus).
     */
    public function findById(int $id): array|false
    {
        $sql = "SELECT * FROM reservations WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch();
    }

    /**
     * Passe le statut d'une réservation à ANNULEE.
     */
    public function cancel(int $id): bool
    {
        $sql = "UPDATE reservations SET statut = 'ANNULEE' WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }

    /**
     * Calcule le chiffre d'affaires prévisionnel directement en SQL,
     * à partir des réservations actives (VALIDEE), via la grille tarifaire.
     */
    public function getRevenue(): float
    {
        $sql = "SELECT SUM(
                    nombre_nuits * CASE type_chambre
                        WHEN 'STANDARD' THEN CAST(:tarif_standard AS integer)
                        WHEN 'CONFORT'  THEN CAST(:tarif_confort AS integer)
                        WHEN 'SUITE'    THEN CAST(:tarif_suite AS integer)
                    END
                ) AS total
                FROM reservations
                WHERE statut = 'VALIDEE'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':tarif_standard', self::TARIFS['STANDARD'], PDO::PARAM_INT);
        $stmt->bindValue(':tarif_confort',  self::TARIFS['CONFORT'],  PDO::PARAM_INT);
        $stmt->bindValue(':tarif_suite',    self::TARIFS['SUITE'],    PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();

        return (float) ($result['total'] ?? 0);
    }

    /**
     * Retourne la ou les réservations actives ayant le plus grand nombre de nuits
     * (gère les ex-aequo via une sous-requête).
     */
    public function getLongestStays(): array
    {
        $sql = "SELECT * FROM reservations
                WHERE statut = 'VALIDEE'
                AND nombre_nuits = (
                    SELECT MAX(nombre_nuits) FROM reservations WHERE statut = 'VALIDEE'
                )";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }
}
