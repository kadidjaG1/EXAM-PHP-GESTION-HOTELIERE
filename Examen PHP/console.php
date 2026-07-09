<?php

require_once __DIR__ . '/controllers/ReservationController.php';
require_once __DIR__ . '/views/console/ConsoleView.php';
require_once __DIR__ . '/views/console/ConsoleInput.php';

$controller = new ReservationController();
$running = true;

while ($running) {
    ConsoleView::displayMenu();
    $choice = ConsoleInput::readMenuChoice();

    switch ($choice) {

        case '1':
            $data = ConsoleInput::readReservationData();
            $result = $controller->createReservation(
                $data['nom_client'],
                $data['numero_chambre'],
                $data['nombre_nuits'],
                $data['type_chambre']
            );
            ConsoleView::displayMessage($result);
            break;

        case '2':
            $reservations = $controller->listActiveReservations();
            ConsoleView::displayActiveReservations($reservations);
            break;

        case '3':
            $id = ConsoleInput::readReservationId();
            $result = $controller->cancelReservation($id);
            ConsoleView::displayMessage($result);
            break;

        case '4':
            $revenue = $controller->calculateRevenue();
            ConsoleView::displayRevenue($revenue);
            break;

        case '5':
            $stays = $controller->longestStay();
            ConsoleView::displayLongestStay($stays);
            break;

        case '0':
            echo "\nAu revoir !\n";
            $running = false;
            break;

        default:
            echo "\nChoix invalide, veuillez réessayer.\n";
            break;
    }
}
