<?php

/**
 * ConsoleInput
 * Regroupe les saisies utilisateur via readline() pour l'interface CLI.
 */
class ConsoleInput
{
    public static function readMenuChoice(): string
    {
        return trim(readline("Votre choix : "));
    }

    /**
     * Récupère les informations nécessaires à la création d'une réservation.
     */
    public static function readReservationData(): array
    {
        $nomClient     = readline("Nom du client : ");
        $numeroChambre = readline("Numéro de chambre : ");
        $nombreNuits   = readline("Nombre de nuits : ");

        echo "Type de chambre (STANDARD / CONFORT / SUITE) : ";
        $typeChambre = readline();

        return [
            'nom_client'      => $nomClient,
            'numero_chambre'  => $numeroChambre,
            'nombre_nuits'    => $nombreNuits,
            'type_chambre'    => $typeChambre,
        ];
    }

    public static function readReservationId(): string
    {
        return trim(readline("ID de la réservation à annuler : "));
    }
}
