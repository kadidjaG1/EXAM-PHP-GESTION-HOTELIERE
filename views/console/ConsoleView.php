<?php

/**
 * ConsoleView
 * Regroupe toutes les fonctions d'affichage dans le terminal (CLI).
 * Aucune logique métier ici : uniquement du formatage texte.
 */
class ConsoleView
{
    public static function displayMenu(): void
    {
        echo "\n=================================================\n";
        echo "      GESTION DES RESERVATIONS - HOTEL \n";
        echo "=================================================\n";
        echo "1. Créer une réservation\n";
        echo "2. Afficher les réservations actives\n";
        echo "3. Annuler une réservation\n";
        echo "4. Calculer le chiffre d'affaires prévisionnel\n";
        echo "5. Afficher le séjour le plus long\n";
        echo "0. Quitter\n";
        echo "-------------------------------------------------\n";
    }

    public static function displayMessage(array $result): void
    {
        $prefix = $result['success'] ? "[OK] " : "[ERREUR] ";
        echo "\n" . $prefix . $result['message'] . "\n";
    }

    public static function displayActiveReservations(array $reservations): void
    {
        echo "\n--- Réservations actives ---\n";

        if (empty($reservations)) {
            echo "Aucune réservation active pour le moment.\n";
            return;
        }

        foreach ($reservations as $r) {
            echo sprintf(
                "#%d | Client: %-20s | Chambre: %-5d | Nuits: %-3d | Type: %-8s | Statut: %s\n",
                $r['id'],
                $r['nom_client'],
                $r['numero_chambre'],
                $r['nombre_nuits'],
                $r['type_chambre'],
                $r['statut']
            );
        }
    }

    public static function displayRevenue(float $revenue): void
    {
        echo "\n--- Chiffre d'affaires prévisionnel ---\n";
        echo number_format($revenue, 0, ',', ' ') . " FCFA\n";
    }

    public static function displayLongestStay(array $stays): void
    {
        echo "\n--- Séjour le plus long ---\n";

        if (empty($stays)) {
            echo "Aucune réservation active pour le moment.\n";
            return;
        }

        if (count($stays) > 1) {
            echo "Plusieurs clients sont ex-æquo :\n";
        }

        foreach ($stays as $r) {
            echo sprintf(
                "#%d | Client: %-20s | Chambre: %-5d | Nuits: %-3d | Type: %s\n",
                $r['id'],
                $r['nom_client'],
                $r['numero_chambre'],
                $r['nombre_nuits'],
                $r['type_chambre']
            );
        }
    }
}
