<?php

require_once __DIR__ . '/../models/ReservationModel.php';
/**
 * ReservationController
 * Chef d'orchestre : récupère les requêtes (Web ou Console),
 * applique les règles de gestion, appelle le Modèle,
 * et prépare les données pour la Vue. Aucun echo ici.
 */
class ReservationController
{
    private ReservationModel $model;

    public function __construct()
    {
        $this->model = new ReservationModel();
    }

    /**
     * Crée une réservation après validation des règles de gestion.
     * Retourne un tableau ['success' => bool, 'message' => string]
     */
    public function createReservation(string $nomClient, $numeroChambre, $nombreNuits, string $typeChambre): array
    {
        $nomClient     = trim($nomClient);
        $numeroChambre = (int) $numeroChambre;
        $nombreNuits   = (int) $nombreNuits;
        $typeChambre   = strtoupper(trim($typeChambre));

        $typesValides = array_keys(ReservationModel::TARIFS);

        if ($nomClient === '') {
            return ['success' => false, 'message' => "Le nom du client est obligatoire."];
        }

        if ($numeroChambre <= 0) {
            return ['success' => false, 'message' => "Le numéro de chambre doit etre superieur à 0."];
        }

        if ($nombreNuits <= 0) {
            return ['success' => false, 'message' => "Le nombre de nuits doit etre superieur à 0."];
        }

        if (!in_array($typeChambre, $typesValides, true)) {
            return ['success' => false, 'message' => "Type de chambre invalide. Choix possibles : " . implode(', ', $typesValides)];
        }

        $ok = $this->model->create($nomClient, $numeroChambre, $nombreNuits, $typeChambre);

        if ($ok) {
            return ['success' => true, 'message' => "Reservation creee avec succes pour {$nomClient}."];
        }

        return ['success' => false, 'message' => "Une erreur est survenue lors de la creation de la reservation."];
    }

    /**
     * Retourne la liste des réservations actives.
     */
    public function listActiveReservations(): array
    {
        return $this->model->getActiveReservations();
    }

    /**
     * Annule une réservation après vérification de son existence.
     */
    public function cancelReservation($id): array
    {
        $id = (int) $id;

        if ($id <= 0) {
            return ['success' => false, 'message' => "Identifiant invalide."];
        }

        $reservation = $this->model->findById($id);

        if (!$reservation) {
            return ['success' => false, 'message' => "Aucune reservation trouvee avec l'ID {$id}."];
        }

        if ($reservation['statut'] === 'ANNULEE') {
            return ['success' => false, 'message' => "La reservation #{$id} est deje annulee."];
        }

        $ok = $this->model->cancel($id);

        if ($ok) {
            return ['success' => true, 'message' => "Reservation #{$id} annulee avec succes."];
        }

        return ['success' => false, 'message' => "Erreur lors de l'annulation de la réservation #{$id}."];
    }

    /**
     * Calcule le chiffre d'affaires prévisionnel (réservations VALIDEE).
     */
    public function calculateRevenue(): float
    {
        return $this->model->getRevenue();
    }

    /**
     * Retourne le(s) séjour(s) actif(s) le(s) plus long(s) (gère les ex-aequo).
     */
    public function longestStay(): array
    {
        return $this->model->getLongestStays();
    }
}
