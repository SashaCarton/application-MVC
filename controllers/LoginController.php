<?php
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../models/db_connect.php';
require_once __DIR__ . '/../models/User.php';

use Repository\UserRepository;
function index()
{
    login();
}

function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            // Créer la connexion à la base de données
            $db = connection();

            // Créer une instance du repository
            $userRepository = new UserRepository($db);

            // Récupérer l'utilisateur par email
            $userData = $userRepository->getByEmail($email);

            if ($userData && password_verify($password, $userData['password'])) {
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['email'] = $userData['email'];
                header('Location: /');
                exit();
            } else {
                $error = "Identifiants invalides.";
            }
        } catch (Exception $e) {
            $error = "Erreur de connexion. Veuillez réessayer.";
            error_log("Erreur de connexion : " . $e->getMessage());
        }
    }

    // Afficher le formulaire de connexion
    require __DIR__ . '/../views/login.php';
}