<?php
class User
{
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
            die("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
            return null;
        }
    }
}