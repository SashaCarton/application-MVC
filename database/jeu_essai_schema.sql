-- ==================================================
-- JEU D'ESSAI POUR SCHEMA.SQL
-- ==================================================
-- Données de test pour le schéma avec tables séparées

-- Assurer qu'on utilise la bonne base de données
USE mediatheque;

-- ==================================================
-- JEU D'ESSAI - UTILISATEURS
-- ==================================================

-- ==================================================
-- JEU D'ESSAI - LIVRES
-- ==================================================

-- Insertion des médias livres
INSERT IGNORE INTO medias (type, titre, auteur, disponible) VALUES
('book', 'Le Seigneur des Anneaux', 'J.R.R. Tolkien', TRUE),
('book', '1984', 'George Orwell', FALSE),
('book', 'Le Petit Prince', 'Antoine de Saint-Exupéry', TRUE),
('book', 'Harry Potter à l\'école des sorciers', 'J.K. Rowling', TRUE),
('book', 'L\'Étranger', 'Albert Camus', FALSE),
('book', 'Dune', 'Frank Herbert', TRUE),
('book', 'Le Nom de la Rose', 'Umberto Eco', TRUE),
('book', 'Cent ans de solitude', 'Gabriel García Márquez', FALSE),
('book', 'Les Misérables', 'Victor Hugo', TRUE),
('book', 'Madame Bovary', 'Gustave Flaubert', TRUE),
('book', 'Pride and Prejudice', 'Jane Austen', FALSE),
('book', 'Fondation', 'Isaac Asimov', TRUE),
('book', 'Le Guide du voyageur galactique', 'Douglas Adams', TRUE),
('book', 'Neuromancien', 'William Gibson', FALSE),
('book', 'L\'Odyssée', 'Homère', TRUE);

-- Insertion des détails spécifiques aux livres
INSERT IGNORE INTO books (media_id, pageNumber) VALUES
((SELECT id FROM medias WHERE titre = 'Le Seigneur des Anneaux' AND type = 'book'), 1216),
((SELECT id FROM medias WHERE titre = '1984' AND type = 'book'), 328),
((SELECT id FROM medias WHERE titre = 'Le Petit Prince' AND type = 'book'), 96),
((SELECT id FROM medias WHERE titre = 'Harry Potter à l\'école des sorciers' AND type = 'book'), 320),
((SELECT id FROM medias WHERE titre = 'L\'Étranger' AND type = 'book'), 186),
((SELECT id FROM medias WHERE titre = 'Dune' AND type = 'book'), 688),
((SELECT id FROM medias WHERE titre = 'Le Nom de la Rose' AND type = 'book'), 640),
((SELECT id FROM medias WHERE titre = 'Cent ans de solitude' AND type = 'book'), 448),
((SELECT id FROM medias WHERE titre = 'Les Misérables' AND type = 'book'), 1488),
((SELECT id FROM medias WHERE titre = 'Madame Bovary' AND type = 'book'), 374),
((SELECT id FROM medias WHERE titre = 'Pride and Prejudice' AND type = 'book'), 432),
((SELECT id FROM medias WHERE titre = 'Fondation' AND type = 'book'), 244),
((SELECT id FROM medias WHERE titre = 'Le Guide du voyageur galactique' AND type = 'book'), 224),
((SELECT id FROM medias WHERE titre = 'Neuromancien' AND type = 'book'), 271),
((SELECT id FROM medias WHERE titre = 'L\'Odyssée' AND type = 'book'), 374);

-- ==================================================
-- JEU D'ESSAI - FILMS
-- ==================================================

-- Insertion des médias films
INSERT IGNORE INTO medias (type, titre, auteur, disponible) VALUES
('movie', 'Inception', 'Christopher Nolan', TRUE),
('movie', 'The Dark Knight', 'Christopher Nolan', FALSE),
('movie', 'Amélie', 'Jean-Pierre Jeunet', TRUE),
('movie', 'Pulp Fiction', 'Quentin Tarantino', TRUE),
('movie', 'Le Parrain', 'Francis Ford Coppola', FALSE),
('movie', 'Spirited Away', 'Hayao Miyazaki', TRUE),
('movie', 'The Shining', 'Stanley Kubrick', TRUE),
('movie', 'Casablanca', 'Michael Curtiz', FALSE),
('movie', 'Mad Max: Fury Road', 'George Miller', TRUE),
('movie', 'La Vita è Bella', 'Roberto Benigni', TRUE),
('movie', 'Interstellar', 'Christopher Nolan', FALSE),
('movie', 'Matrix', 'Lana et Lilly Wachowski', TRUE),
('movie', 'Blade Runner', 'Ridley Scott', TRUE),
('movie', 'Forrest Gump', 'Robert Zemeckis', FALSE),
('movie', 'Titanic', 'James Cameron', TRUE);

-- Insertion des détails spécifiques aux films
INSERT IGNORE INTO movies (media_id, duration, genre) VALUES
((SELECT id FROM medias WHERE titre = 'Inception' AND type = 'movie'), 148, 'Science-Fiction'),
((SELECT id FROM medias WHERE titre = 'The Dark Knight' AND type = 'movie'), 152, 'Action'),
((SELECT id FROM medias WHERE titre = 'Amélie' AND type = 'movie'), 122, 'Comédie'),
((SELECT id FROM medias WHERE titre = 'Pulp Fiction' AND type = 'movie'), 154, 'Action'),
((SELECT id FROM medias WHERE titre = 'Le Parrain' AND type = 'movie'), 175, 'Drame'),
((SELECT id FROM medias WHERE titre = 'Spirited Away' AND type = 'movie'), 125, 'Autre'),
((SELECT id FROM medias WHERE titre = 'The Shining' AND type = 'movie'), 146, 'Autre'),
((SELECT id FROM medias WHERE titre = 'Casablanca' AND type = 'movie'), 102, 'Drame'),
((SELECT id FROM medias WHERE titre = 'Mad Max: Fury Road' AND type = 'movie'), 120, 'Action'),
((SELECT id FROM medias WHERE titre = 'La Vita è Bella' AND type = 'movie'), 116, 'Drame'),
((SELECT id FROM medias WHERE titre = 'Interstellar' AND type = 'movie'), 169, 'Science-Fiction'),
((SELECT id FROM medias WHERE titre = 'Matrix' AND type = 'movie'), 136, 'Science-Fiction'),
((SELECT id FROM medias WHERE titre = 'Blade Runner' AND type = 'movie'), 117, 'Science-Fiction'),
((SELECT id FROM medias WHERE titre = 'Forrest Gump' AND type = 'movie'), 142, 'Drame'),
((SELECT id FROM medias WHERE titre = 'Titanic' AND type = 'movie'), 195, 'Drame');

-- ==================================================
-- JEU D'ESSAI - ALBUMS
-- ==================================================

-- Insertion des médias albums
INSERT IGNORE INTO medias (type, titre, auteur, disponible) VALUES
('album', 'Random Access Memories', 'Daft Punk', TRUE),
('album', 'The Dark Side of the Moon', 'Pink Floyd', FALSE),
('album', 'Thriller', 'Michael Jackson', TRUE),
('album', 'Abbey Road', 'The Beatles', TRUE),
('album', 'OK Computer', 'Radiohead', FALSE),
('album', 'Nevermind', 'Nirvana', TRUE),
('album', 'Back to Black', 'Amy Winehouse', TRUE),
('album', 'Kind of Blue', 'Miles Davis', FALSE),
('album', 'The Wall', 'Pink Floyd', TRUE),
('album', 'Rumours', 'Fleetwood Mac', TRUE),
('album', 'Born to Run', 'Bruce Springsteen', FALSE),
('album', 'Discovery', 'Daft Punk', TRUE),
('album', '21', 'Adele', TRUE),
('album', 'Ten', 'Pearl Jam', FALSE),
('album', 'Hotel California', 'Eagles', TRUE);

-- Insertion des détails spécifiques aux albums
INSERT IGNORE INTO albums (media_id, songNumber, editor) VALUES
((SELECT id FROM medias WHERE titre = 'Random Access Memories' AND type = 'album'), 13, 'Columbia Records'),
((SELECT id FROM medias WHERE titre = 'The Dark Side of the Moon' AND type = 'album'), 10, 'Harvest Records'),
((SELECT id FROM medias WHERE titre = 'Thriller' AND type = 'album'), 9, 'Epic Records'),
((SELECT id FROM medias WHERE titre = 'Abbey Road' AND type = 'album'), 17, 'Apple Records'),
((SELECT id FROM medias WHERE titre = 'OK Computer' AND type = 'album'), 12, 'Parlophone'),
((SELECT id FROM medias WHERE titre = 'Nevermind' AND type = 'album'), 12, 'DGC Records'),
((SELECT id FROM medias WHERE titre = 'Back to Black' AND type = 'album'), 11, 'Island Records'),
((SELECT id FROM medias WHERE titre = 'Kind of Blue' AND type = 'album'), 5, 'Columbia Records'),
((SELECT id FROM medias WHERE titre = 'The Wall' AND type = 'album'), 26, 'Harvest Records'),
((SELECT id FROM medias WHERE titre = 'Rumours' AND type = 'album'), 11, 'Warner Bros Records'),
((SELECT id FROM medias WHERE titre = 'Born to Run' AND type = 'album'), 8, 'Columbia Records'),
((SELECT id FROM medias WHERE titre = 'Discovery' AND type = 'album'), 14, 'Virgin Records'),
((SELECT id FROM medias WHERE titre = '21' AND type = 'album'), 11, 'XL Recordings'),
((SELECT id FROM medias WHERE titre = 'Ten' AND type = 'album'), 11, 'Epic Records'),
((SELECT id FROM medias WHERE titre = 'Hotel California' AND type = 'album'), 9, 'Asylum Records');

-- ==================================================
-- JEU D'ESSAI - EMPRUNTS
-- ==================================================

-- Quelques emprunts en cours
INSERT IGNORE INTO emprunts (user_id, media_id, date_emprunt) VALUES
((SELECT id FROM users WHERE username = 'lecteur1'), (SELECT id FROM medias WHERE titre = '1984'), '2025-09-15 10:30:00'),
((SELECT id FROM users WHERE username = 'cinephile'), (SELECT id FROM medias WHERE titre = 'The Dark Knight'), '2025-09-18 14:20:00'),
((SELECT id FROM users WHERE username = 'melomane'), (SELECT id FROM medias WHERE titre = 'The Dark Side of the Moon'), '2025-09-10 09:15:00'),
((SELECT id FROM users WHERE username = 'lecteur1'), (SELECT id FROM medias WHERE titre = 'L\'Étranger'), '2025-09-12 16:45:00'),
((SELECT id FROM users WHERE username = 'cinephile'), (SELECT id FROM medias WHERE titre = 'Le Parrain'), '2025-09-19 11:00:00');

-- Quelques emprunts rendus (avec date de retour)
INSERT IGNORE INTO emprunts (user_id, media_id, date_emprunt, date_retour) VALUES
((SELECT id FROM users WHERE username = 'lecteur1'), (SELECT id FROM medias WHERE titre = 'Le Petit Prince'), '2025-09-01 09:00:00', '2025-09-08 17:30:00'),
((SELECT id FROM users WHERE username = 'melomane'), (SELECT id FROM medias WHERE titre = 'Thriller'), '2025-08-25 14:00:00', '2025-09-05 10:15:00'),
((SELECT id FROM users WHERE username = 'cinephile'), (SELECT id FROM medias WHERE titre = 'Inception'), '2025-08-20 16:30:00', '2025-08-30 12:00:00'),
((SELECT id FROM users WHERE username = 'lecteur1'), (SELECT id FROM medias WHERE titre = 'Dune'), '2025-08-15 11:45:00', '2025-09-01 14:20:00'),
((SELECT id FROM users WHERE username = 'melomane'), (SELECT id FROM medias WHERE titre = 'Abbey Road'), '2025-08-10 13:30:00', '2025-08-25 16:45:00');

-- ==================================================
-- REQUÊTES DE VÉRIFICATION
-- ==================================================

-- Statistiques générales
SELECT 'STATISTIQUES GÉNÉRALES' as info;
SELECT 
    type,
    COUNT(*) as total,
    SUM(disponible) as disponibles,
    COUNT(*) - SUM(disponible) as empruntes
FROM medias 
GROUP BY type;

-- Emprunts en cours
SELECT 'EMPRUNTS EN COURS' as info;
SELECT 
    u.username,
    m.type,
    m.titre,
    m.auteur,
    e.date_emprunt
FROM emprunts e
JOIN users u ON e.user_id = u.id
JOIN medias m ON e.media_id = m.id
WHERE e.date_retour IS NULL
ORDER BY e.date_emprunt DESC;

-- Livres les plus volumineux
SELECT 'LIVRES LES PLUS VOLUMINEUX' as info;
SELECT 
    m.titre,
    m.auteur,
    b.pageNumber,
    CASE WHEN m.disponible THEN 'Disponible' ELSE 'Emprunté' END as statut
FROM medias m
JOIN books b ON m.id = b.media_id
ORDER BY b.pageNumber DESC
LIMIT 5;

-- Films par genre
SELECT 'FILMS PAR GENRE' as info;
SELECT 
    mv.genre,
    COUNT(*) as nombre_films,
    AVG(mv.duration) as duree_moyenne
FROM medias m
JOIN movies mv ON m.id = mv.media_id
GROUP BY mv.genre
ORDER BY nombre_films DESC;

-- Albums par nombre de pistes
SELECT 'ALBUMS PAR NOMBRE DE PISTES' as info;
SELECT 
    m.titre,
    m.auteur,
    a.songNumber,
    a.editor,
    CASE WHEN m.disponible THEN 'Disponible' ELSE 'Emprunté' END as statut
FROM medias m
JOIN albums a ON m.id = a.media_id
ORDER BY a.songNumber DESC
LIMIT 5;

-- Vérification des totaux
SELECT 'VÉRIFICATION DES TOTAUX' as info;
SELECT 
    'Utilisateurs' as type, COUNT(*) as count FROM users
UNION ALL
SELECT 
    'Médias total' as type, COUNT(*) as count FROM medias
UNION ALL
SELECT 
    'Livres' as type, COUNT(*) as count FROM books
UNION ALL
SELECT 
    'Films' as type, COUNT(*) as count FROM movies
UNION ALL
SELECT 
    'Albums' as type, COUNT(*) as count FROM albums
UNION ALL
SELECT 
    'Emprunts total' as type, COUNT(*) as count FROM emprunts
UNION ALL
SELECT 
    'Emprunts en cours' as type, COUNT(*) as count FROM emprunts WHERE date_retour IS NULL;

-- ==================================================
-- FIN DU JEU D'ESSAI
-- ==================================================
SELECT 'JEU D\'ESSAI POUR SCHEMA.SQL CRÉÉ AVEC SUCCÈS !' as message;
SELECT 'Vous pouvez maintenant tester l\'application avec ces données.' as info;