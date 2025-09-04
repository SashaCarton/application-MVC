<?php

function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = User::GetByEmail($email);
        if ($user && password_verify($password, $user->getPassword())) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            header('Location: index.php');
            exit();
        } else {
            $error = "Identifiants invalides.";
            require 'views/login.php';
        }
    }
}