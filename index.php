<?php

require_once "controllers/AlbumController.php";

$action = $_GET['action'] ?? 'list';

$controller = new AlbumController();

switch ($action) {
    case 'list':
        $controller->listAlbums();
        break;
    case 'search':
        $controller->search();
        break;
    case 'stats':
        $controller->stats();
        break;
    default:
        echo "404 - Page non trouvée";
}
