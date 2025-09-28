<?php
namespace Repository;
require_once __DIR__ . '/../models/db_connect.php';
use PDO;
use PDOException;

class UserRepository
{
    private static function getConnection(): PDO
    {
        return connection();
    }

    public static function findAll(): array
    {
        $db = self::getConnection();
        $stmt = $db->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id): ?array
    {
        $db = self::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public static function create(array $data): bool
    {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
            return $stmt->execute([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);
        } catch (PDOException $e) {
            // Log l'erreur pour le débogage
            error_log('Erreur lors de la création de l\'utilisateur: ' . $e->getMessage());
            return false;
        }
    }

    public static function update(int $id, array $data): bool
    {
        $db = self::getConnection();
        $stmt = $db->prepare('UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id');
        return $stmt->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'id' => $id
        ]);
    }

    public static function delete(int $id): bool
    {
        $db = self::getConnection();
        $stmt = $db->prepare('DELETE FROM users WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public static function getByEmail(string $email): ?array
    {
        $db = self::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public static function findByUsername(string $username): ?array
    {
        $db = self::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

    public static function authenticate(string $username, string $password): ?array
    {
        $user = self::findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }
}