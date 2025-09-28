
INSERT IGNORE INTO medias (titre, auteur, type, date_publication, statut, page_number) VALUES
-- Classiques de la littérature
('Le Seigneur des Anneaux', 'J.R.R. Tolkien', 'Book', '1954-07-29', 'disponible', 1216),
('1984', 'George Orwell', 'Book', '1949-06-08', 'emprunte', 328),
('Le Petit Prince', 'Antoine de Saint-Exupéry', 'Book', '1943-04-06', 'disponible', 96),
('L\'Étranger', 'Albert Camus', 'Book', '1942-05-19', 'emprunte', 186),
('L\'Odyssée', 'Homère', 'Book', '1900-01-01', 'disponible', 374),

-- Littérature contemporaine
('Harry Potter à l\'école des sorciers', 'J.K. Rowling', 'Book', '1997-06-26', 'disponible', 320),
('Dune', 'Frank Herbert', 'Book', '1965-08-01', 'disponible', 688),
('Le Nom de la Rose', 'Umberto Eco', 'Book', '1980-09-01', 'emprunte', 640),
('Cent ans de solitude', 'Gabriel García Márquez', 'Book', '1967-05-30', 'disponible', 448),
('Pride and Prejudice', 'Jane Austen', 'Book', '1813-01-28', 'disponible', 432),

-- Science-fiction et fantaisie
('Fondation', 'Isaac Asimov', 'Book', '1951-05-01', 'disponible', 244),
('Le Guide du voyageur galactique', 'Douglas Adams', 'Book', '1979-10-12', 'emprunte', 224),
('Neuromancien', 'William Gibson', 'Book', '1984-07-01', 'disponible', 271),

-- Romans français
('Les Misérables', 'Victor Hugo', 'Book', '1862-06-30', 'disponible', 1488),
('Madame Bovary', 'Gustave Flaubert', 'Book', '1857-04-01', 'emprunte', 374);

-- ==================================================
-- JEU D'ESSAI - FILMS (Movies)
-- ==================================================

INSERT IGNORE INTO medias (titre, auteur, type, date_publication, statut, duration, genre) VALUES
-- Science-fiction
('Inception', 'Christopher Nolan', 'Movie', '2010-07-16', 'disponible', 148, 'Science-Fiction'),
('Interstellar', 'Christopher Nolan', 'Movie', '2014-11-07', 'emprunte', 169, 'Science-Fiction'),
('Blade Runner', 'Ridley Scott', 'Movie', '1982-06-25', 'disponible', 117, 'Science-Fiction'),
('Matrix', 'Lana et Lilly Wachowski', 'Movie', '1999-03-31', 'disponible', 136, 'Science-Fiction'),

-- Action
('The Dark Knight', 'Christopher Nolan', 'Movie', '2008-07-18', 'emprunte', 152, 'Action'),
('Mad Max: Fury Road', 'George Miller', 'Movie', '2015-05-15', 'disponible', 120, 'Action'),
('Die Hard', 'John McTiernan', 'Movie', '1988-07-20', 'disponible', 132, 'Action'),

-- Drame
('Le Parrain', 'Francis Ford Coppola', 'Movie', '1972-03-24', 'emprunte', 175, 'Drame'),
('La Vita è Bella', 'Roberto Benigni', 'Movie', '1997-12-20', 'disponible', 116, 'Drame'),
('Forrest Gump', 'Robert Zemeckis', 'Movie', '1994-07-06', 'disponible', 142, 'Drame'),

-- Romance
('Amélie', 'Jean-Pierre Jeunet', 'Movie', '2001-04-25', 'disponible', 122, 'Romance'),
('Casablanca', 'Michael Curtiz', 'Movie', '1942-11-26', 'emprunte', 102, 'Romance'),
('Titanic', 'James Cameron', 'Movie', '1997-12-19', 'disponible', 195, 'Romance'),

-- Animation
('Spirited Away', 'Hayao Miyazaki', 'Movie', '2001-07-20', 'disponible', 125, 'Animation'),
('Le Roi Lion', 'Roger Allers', 'Movie', '1994-06-24', 'emprunte', 88, 'Animation'),
('Toy Story', 'John Lasseter', 'Movie', '1995-11-22', 'disponible', 81, 'Animation'),

-- Fantastique
('The Lord of the Rings', 'Peter Jackson', 'Movie', '2001-12-19', 'disponible', 178, 'Fantastique'),
('Harry Potter à l\'école des sorciers', 'Chris Columbus', 'Movie', '2001-11-16', 'emprunte', 152, 'Fantastique'),

-- Thriller
('Pulp Fiction', 'Quentin Tarantino', 'Movie', '1994-10-14', 'disponible', 154, 'Thriller'),
('Seven', 'David Fincher', 'Movie', '1995-09-22', 'disponible', 127, 'Thriller'),

-- Horreur
('The Shining', 'Stanley Kubrick', 'Movie', '1980-05-23', 'disponible', 146, 'Horreur'),
('Alien', 'Ridley Scott', 'Movie', '1979-05-25', 'emprunte', 117, 'Horreur'),

-- Comédie
('Groundhog Day', 'Harold Ramis', 'Movie', '1993-02-12', 'disponible', 101, 'Comédie'),
('The Grand Budapest Hotel', 'Wes Anderson', 'Movie', '2014-03-28', 'disponible', 99, 'Comédie');

-- ==================================================
-- JEU D'ESSAI - ALBUMS (Albums)
-- ==================================================

INSERT IGNORE INTO medias (titre, auteur, type, date_publication, statut, track_number, record_label) VALUES
-- Rock classique
('The Dark Side of the Moon', 'Pink Floyd', 'Album', '1973-03-01', 'emprunte', 10, 'Harvest Records'),
('Abbey Road', 'The Beatles', 'Album', '1969-09-26', 'disponible', 17, 'Apple Records'),
('The Wall', 'Pink Floyd', 'Album', '1979-11-30', 'disponible', 26, 'Harvest Records'),
('Sgt. Pepper\'s Lonely Hearts Club Band', 'The Beatles', 'Album', '1967-06-01', 'emprunte', 13, 'Parlophone'),

-- Rock alternatif/Grunge
('OK Computer', 'Radiohead', 'Album', '1997-06-16', 'emprunte', 12, 'Parlophone'),
('Nevermind', 'Nirvana', 'Album', '1991-09-24', 'disponible', 12, 'DGC Records'),
('Ten', 'Pearl Jam', 'Album', '1991-08-27', 'disponible', 11, 'Epic Records'),

-- Pop/Soul
('Thriller', 'Michael Jackson', 'Album', '1982-11-30', 'disponible', 9, 'Epic Records'),
('Back to Black', 'Amy Winehouse', 'Album', '2006-10-27', 'disponible', 11, 'Island Records'),
('21', 'Adele', 'Album', '2011-01-24', 'emprunte', 11, 'XL Recordings'),

-- Electronic/Dance
('Random Access Memories', 'Daft Punk', 'Album', '2013-05-17', 'disponible', 13, 'Columbia Records'),
('Discovery', 'Daft Punk', 'Album', '2001-02-26', 'disponible', 14, 'Virgin Records'),
('Selected Ambient Works 85-92', 'Aphex Twin', 'Album', '1992-11-09', 'emprunte', 13, 'R&S Records'),

-- Jazz
('Kind of Blue', 'Miles Davis', 'Album', '1959-08-17', 'emprunte', 5, 'Columbia Records'),
('A Love Supreme', 'John Coltrane', 'Album', '1965-01-01', 'disponible', 4, 'Impulse! Records'),

-- Rock classique américain
('Born to Run', 'Bruce Springsteen', 'Album', '1975-08-25', 'emprunte', 8, 'Columbia Records'),
('Rumours', 'Fleetwood Mac', 'Album', '1977-02-04', 'disponible', 11, 'Warner Bros Records'),
('Hotel California', 'Eagles', 'Album', '1976-12-08', 'disponible', 9, 'Asylum Records'),

-- Hip-Hop
('The Chronic', 'Dr. Dre', 'Album', '1992-12-15', 'disponible', 16, 'Death Row Records'),
('Illmatic', 'Nas', 'Album', '1994-04-19', 'emprunte', 10, 'Columbia Records'),

-- Musique française
('Saez', 'Damien Saez', 'Album', '2001-11-05', 'disponible', 12, 'Wagram Music'),
('Les Enfoirés dans l\'espace', 'Les Enfoirés', 'Album', '2009-03-09', 'disponible', 15, 'Columbia Records');

-- ==================================================
-- VUES ET STATISTIQUES UTILES
-- ==================================================

-- Vue pour les statistiques par type
CREATE OR REPLACE VIEW vue_stats_par_type AS
SELECT 
    type,
    COUNT(*) as total,
    SUM(CASE WHEN statut = 'disponible' THEN 1 ELSE 0 END) as disponibles,
    SUM(CASE WHEN statut = 'emprunte' THEN 1 ELSE 0 END) as empruntes,
    ROUND((SUM(CASE WHEN statut = 'disponible' THEN 1 ELSE 0 END) / COUNT(*)) * 100, 2) as pourcentage_disponible
FROM medias 
GROUP BY type;

-- Vue pour les statistiques par genre (films)
CREATE OR REPLACE VIEW vue_stats_films_par_genre AS
SELECT 
    genre,
    COUNT(*) as total,
    SUM(CASE WHEN statut = 'disponible' THEN 1 ELSE 0 END) as disponibles,
    AVG(duration) as duree_moyenne
FROM medias 
WHERE type = 'Movie' AND genre IS NOT NULL
GROUP BY genre
ORDER BY total DESC;

-- Vue pour les auteurs les plus représentés
CREATE OR REPLACE VIEW vue_auteurs_populaires AS
SELECT 
    auteur,
    type,
    COUNT(*) as nombre_oeuvres,
    SUM(CASE WHEN statut = 'disponible' THEN 1 ELSE 0 END) as disponibles
FROM medias 
GROUP BY auteur, type
HAVING COUNT(*) > 1
ORDER BY nombre_oeuvres DESC;

-- ==================================================
-- REQUÊTES DE VÉRIFICATION
-- ==================================================

-- Affichage des statistiques générales
SELECT 'STATISTIQUES GÉNÉRALES' as info;
SELECT 
    COUNT(*) as total_medias,
    SUM(CASE WHEN statut = 'disponible' THEN 1 ELSE 0 END) as disponibles,
    SUM(CASE WHEN statut = 'emprunte' THEN 1 ELSE 0 END) as empruntes
FROM medias;

-- Statistiques par type
SELECT 'STATISTIQUES PAR TYPE' as info;
SELECT * FROM vue_stats_par_type;

-- Top 5 des genres de films
SELECT 'TOP 5 GENRES DE FILMS' as info;
SELECT * FROM vue_stats_films_par_genre LIMIT 5;

-- Auteurs avec plusieurs œuvres
SELECT 'AUTEURS AVEC PLUSIEURS ŒUVRES' as info;
SELECT * FROM vue_auteurs_populaires LIMIT 10;

-- Vérification des données insérées
SELECT 'VÉRIFICATION DES INSERTIONS' as info;
SELECT 
    'Livres' as type, COUNT(*) as count FROM medias WHERE type = 'Book'
UNION ALL
SELECT 
    'Films' as type, COUNT(*) as count FROM medias WHERE type = 'Movie'
UNION ALL
SELECT 
    'Albums' as type, COUNT(*) as count FROM medias WHERE type = 'Album'
UNION ALL
SELECT 
    'Utilisateurs' as type, COUNT(*) as count FROM users;

-- ==================================================
-- FIN DU SCRIPT
-- ==================================================
SELECT 'JEU D\'ESSAI CRÉÉ AVEC SUCCÈS !' as message;