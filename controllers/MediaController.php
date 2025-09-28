<?php
require_once __DIR__ . '/../models/db_connect.php';
require_once __DIR__ . '/../repository/MediaRepository.php';
require_once __DIR__ . '/../controllers/AuthController.php';

use Repository\MediaRepository;

class MediaController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {
        AuthController::requireAuth('/medias');

        $medias = MediaRepository::findAll();

        $stats = MediaRepository::countByStatus();
        $typeStats = MediaRepository::countByType();

        require __DIR__ . '/../views/medias.php';
    }

    public function borrow()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['media_id'])) {
            $mediaId = (int) $_POST['media_id'];

            $media = MediaRepository::findById($mediaId);

            if ($media && $media->isDisponible()) {
                if (MediaRepository::borrow($mediaId, $_SESSION['user_id'])) {
                    $_SESSION['success'] = 'Média emprunté avec succès !';
                } else {
                    $_SESSION['error'] = 'Erreur lors de l\'emprunt du média.';
                }
            } else {
                $_SESSION['error'] = 'Ce média n\'est pas disponible.';
            }
        }

        header('Location: /medias');
        exit();
    }

    public function return()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['media_id'])) {
            $mediaId = (int) $_POST['media_id'];

            if (MediaRepository::returnMedia($mediaId, $_SESSION['user_id'])) {
                $_SESSION['success'] = 'Média rendu avec succès !';
            } else {
                $_SESSION['error'] = 'Erreur lors du retour du média.';
            }
        }
        header('Location: /medias');
        exit();
    }

    public function search()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $medias = [];
        $query = '';

        if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
            $query = trim($_GET['q']);
            $medias = MediaRepository::search($query);
        } else {
            $medias = MediaRepository::findAll();
        }
        $stats = MediaRepository::countByStatus();
        $typeStats = MediaRepository::countByType();

        require __DIR__ . '/../views/medias.php';
    }

    public function myBorrows()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $medias = MediaRepository::getMediasBorrowedByUser($_SESSION['user_id']);

        require __DIR__ . '/../views/my_borrows.php';
    }
}