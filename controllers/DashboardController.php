<?php
require_once __DIR__ . '/../models/db_connect.php';
require_once __DIR__ . '/../repository/MediaRepository.php';

use Repository\MediaRepository;

class DashboardController
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $medias = MediaRepository::findAll();

        require __DIR__ . '/../views/dashboard.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit();
    }
}
