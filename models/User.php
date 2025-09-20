<?php
require_once 'db_connect.php';

class User
{
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct($id, $username, $email, $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public static function create($username, $email, $password)
    {
        try {
            $db = connection();

            $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

            $hashedPassword = password_hash($password, PASSWORD_ARGON2I);

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            $user_id = $db->lastInsertId();

            return new User($user_id, $username, $email, $hashedPassword);
        } catch (PDOException $e) {
            // Gérer l'erreur
            error_log("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
            return null;
        }
    }
}