CREATE DATABASE mediatheque;
USE mediatheque;

-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des médias génériques
CREATE TABLE medias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('book', 'movie', 'album') NOT NULL,
    titre VARCHAR(255) NOT NULL,
    auteur VARCHAR(255) NOT NULL,
    disponible BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Spécifique aux livres
CREATE TABLE books (
    media_id INT PRIMARY KEY,
    pageNumber INT,
    FOREIGN KEY (media_id) REFERENCES medias(id) ON DELETE CASCADE
);

-- Spécifique aux films
CREATE TABLE movies (
    media_id INT PRIMARY KEY,
    duration DOUBLE,
    genre ENUM('Action','Comedie','Drame','Science-Fiction','Autre') NOT NULL,
    FOREIGN KEY (media_id) REFERENCES medias(id) ON DELETE CASCADE
);

-- Spécifique aux albums
CREATE TABLE albums (
    media_id INT PRIMARY KEY,
    songNumber INT,
    editor VARCHAR(255),
    FOREIGN KEY (media_id) REFERENCES medias(id) ON DELETE CASCADE
);

-- Table des emprunts
CREATE TABLE emprunts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    media_id INT NOT NULL,
    date_emprunt DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_retour DATETIME NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (media_id) REFERENCES medias(id) ON DELETE CASCADE
);