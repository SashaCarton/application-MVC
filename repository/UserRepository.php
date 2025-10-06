<?php
namespace Repository;

require_once __DIR__ . '/../models/db_connect.php';
require_once __DIR__ . '/../models/User.php';

use PDO;
use PDOException;

class UserRepository
{
    private static function getConnection(): PDO
    {
        return connection();
    }

    /**
     * Retourne un tableau d'instances User
     * @return User[]
     */
    public static function findAll(): array
    {
        $db = self::getConnection();
        $stmt = $db->query('SELECT * FROM users');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            $users[] = new \User($row['id'], $row['username'], $row['email'], $row['password']);
        }

        return $users;
    }

    /**
     * Retourne une instance User ou null
     */
    public static function findById(int $id): ?\User
    {
        $db = self::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new \User($row['id'], $row['username'], $row['email'], $row['password']);
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

    public static function getByEmail(string $email): ?\User
    {
        $db = self::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new \User($row['id'], $row['username'], $row['email'], $row['password']);
    }

    public static function findByUsername(string $username): ?\User
    {
        $db = self::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new \User($row['id'], $row['username'], $row['email'], $row['password']);
    }

    public static function authenticate(string $username, string $password): ?\User
    {
        $user = self::findByUsername($username);

        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }
}