<?php
require_once __DIR__ . '/../repository/UserRepository.php';
use Repository\UserRepository;

class AuthController
{
    public function __construct()
    {
    }

    public function showLogin()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: /medias');
            exit();
        }

        include __DIR__ . '/../views/login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Veuillez remplir tous les champs.';
                header('Location: /login');
                exit();
            }

            $user = UserRepository::getByEmail($email);

            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['success'] = 'Connexion réussie !';

                $redirect = $_SESSION['redirect_after_login'] ?? '/medias';
                unset($_SESSION['redirect_after_login']);
                header('Location: ' . $redirect);
                exit();
            } else {
                $_SESSION['error'] = 'Nom d\'utilisateur ou mot de passe incorrect.';
                header('Location: /login');
                exit();
            }
        }

        $this->showLogin();
    }

    public function logout()
    {
        session_destroy();
        session_start();
        $_SESSION['success'] = 'Vous avez été déconnecté.';
        header('Location: /auth/login');
        exit();
    }

    public static function requireAuth($redirectTo = '/medias')
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_after_login'] = $redirectTo;
            header('Location: /login');
            exit();
        }
    }

    public static function getCurrentUser()
    {
        session_start();
        if (isset($_SESSION['user_id'])) {
            return UserRepository::findById($_SESSION['user_id']);
        }
        return null;
    }
}
?>