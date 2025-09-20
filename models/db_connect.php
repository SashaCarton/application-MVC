<?php
function connection()
{
    $host = 'db';  // Nom du service Docker
    $dbname = 'mediatheque';
    $username = 'root';
    $password = 'rootpassword';  // Mot de passe du docker-compose

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}