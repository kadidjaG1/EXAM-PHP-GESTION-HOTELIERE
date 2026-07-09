<?php

require_once __DIR__ . '/controllers/ReservationController.php';

$controller = new ReservationController();
$action = $_GET['action'] ?? 'home';

require __DIR__ . '/views/web/header.php';

switch ($action) {

    case 'create':
        $result = null;
        $availableRooms = $controller->getAvailableRooms();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $controller->createReservation(
                $_POST['nom_client'] ?? '',
                $_POST['numero_chambre'] ?? 0,
                $_POST['nombre_nuits'] ?? 0,
                $_POST['type_chambre'] ?? ''
            );
            $availableRooms = $controller->getAvailableRooms();
        }

        require __DIR__ . '/views/web/form_create.php';
        break;

    case 'list':
        $reservations = $controller->listActiveReservations();
        require __DIR__ . '/views/web/list_active.php';
        break;

    case 'cancel':
        $result = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $controller->cancelReservation($_POST['id'] ?? 0);
        }

        require __DIR__ . '/views/web/form_cancel.php';
        break;

    case 'revenue':
        $revenue = $controller->calculateRevenue();
        require __DIR__ . '/views/web/revenue.php';
        break;

    case 'longest':
        $stays = $controller->longestStay();
        require __DIR__ . '/views/web/longest_stay.php';
        break;

    case 'home':
    default:
        require __DIR__ . '/views/web/home.php';
        break;
}

require __DIR__ . '/views/web/footer.php';
