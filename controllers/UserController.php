<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';
use Repository\UserRepository;

class UserController
{
    public function index()
    {
        $this->signin();
    }

    public function signin()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if (empty($username) || empty($email) || empty($password)) {
                $error = 'Tous les champs sont obligatoires.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Format d email invalide.';
            } elseif (!$this->validatePassword($password, $username)) {
                $error = 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre, un caractère spécial et ne doit pas contenir le nom d\'utilisateur.';
            } elseif ($password !== $confirmPassword) {
                $error = 'Les mots de passe ne correspondent pas.';
            } else {
                if (UserRepository::getByEmail($email)) {
                    $error = 'Un compte avec cet email existe déjà.';
                } elseif (UserRepository::findByUsername($username)) {
                    $error = 'Ce nom d\'utilisateur est déjà pris.';
                } else {
                    $userData = [
                        'username' => $username,
                        'email' => $email,
                        'password' => password_hash($password, PASSWORD_DEFAULT)
                    ];

                    if (UserRepository::create($userData)) {
                        $_SESSION['success'] = 'Compte créé avec succès ! Vous pouvez maintenant vous connecter.';
                        header('Location: /login');
                        exit;
                    } else {
                        $error = 'Erreur lors de la création du compte. Veuillez réessayer.';
                    }
                }
            }
        }

        include __DIR__ . '/../views/signin.php';
    }

    private function validatePassword(string $password, string $username): bool
    {
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

        return preg_match($regex, $password) &&
            stripos($password, $username) === false;
    }
}
