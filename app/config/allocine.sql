-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : bdd:3306
-- Généré le : mer. 12 nov. 2025 à 23:06
-- Version du serveur : 8.0.44
-- Version de PHP : 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `allocine`
--

-- --------------------------------------------------------

--
-- Structure de la table `Diffusion`
--

CREATE TABLE `Diffusion` (
  `id` int NOT NULL,
  `film_id` int NOT NULL,
  `date_diffusion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Diffusion`
--

INSERT INTO `Diffusion` (`id`, `film_id`, `date_diffusion`) VALUES
(1, 1, '2025-01-05'),
(2, 1, '2025-03-15'),
(3, 2, '2025-02-10'),
(4, 3, '2025-04-22'),
(5, 4, '2025-05-18'),
(6, 5, '2025-06-25'),
(7, 6, '2025-07-01'),
(8, 7, '2025-07-15'),
(9, 8, '2025-08-10'),
(10, 9, '2025-08-25'),
(11, 10, '2025-09-12'),
(12, 11, '2025-09-25'),
(13, 12, '2025-10-05'),
(14, 13, '2025-10-18'),
(15, 14, '2025-11-01'),
(16, 15, '2025-11-12'),
(17, 16, '2025-11-20'),
(18, 17, '2025-11-25'),
(19, 18, '2025-12-01'),
(20, 19, '2025-12-10');

-- --------------------------------------------------------

--
-- Structure de la table `Film`
--

CREATE TABLE `Film` (
  `id` int NOT NULL,
  `titre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_sortie` date DEFAULT NULL,
  `genre` enum('Action','Comédie','Drame','Science-fiction','Horreur','Thriller','Animation','Aventure','Romance','Documentaire') DEFAULT NULL,
  `realisateur` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `synopsis` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Film`
--

INSERT INTO `Film` (`id`, `titre`, `date_sortie`, `genre`, `realisateur`, `cover`, `synopsis`) VALUES
(1, 'Inception', '2010-07-16', 'Science-fiction', 'Christopher Nolan', 'https://image.tmdb.org/t/p/w500/edv5CZvWj09upOsy2Y6IwDhK8bt.jpg', 'Un voleur d\'informations pénètre les rêves de ses cibles pour dérober leurs secrets. Mais sa dernière mission l’entraîne dans un monde où réalité et rêve se confondent.'),
(2, 'Le Seigneur des Anneaux', '2001-12-19', 'Aventure', 'Peter Jackson', 'https://image.tmdb.org/t/p/w500/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg', 'Un jeune hobbit, Frodon, hérite d’un anneau maléfique et part dans une quête épique pour le détruire avant qu’il ne tombe entre de mauvaises mains.'),
(3, 'Titanic', '1997-12-19', 'Romance', 'James Cameron', 'https://image.tmdb.org/t/p/w500/9xjZS2rlVxm8SFx8kPC3aIGCOYQ.jpg', 'À bord du paquebot légendaire, Jack et Rose vivent une histoire d’amour tragique alors que le Titanic sombre dans l’océan.'),
(4, 'Avatar', '2009-12-18', 'Science-fiction', 'James Cameron', 'https://image.tmdb.org/t/p/w500/kyeqWdyUXW608qlYkRqosgbbJyK.jpg', 'Sur Pandora, un soldat humain découvre la beauté d’un monde étranger et se rallie à ses habitants pour défendre leur planète.'),
(5, 'Gladiator', '2000-05-05', 'Action', 'Ridley Scott', 'https://image.tmdb.org/t/p/w500/ty8TGRuvJLPUmAR1H1nRIsgwvim.jpg', 'Un général trahi devient esclave, puis gladiateur, et cherche à se venger de l’empereur qui a détruit sa famille.'),
(6, 'The Dark Knight', '2008-07-18', 'Action', 'Christopher Nolan', 'https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg', 'Batman affronte le Joker, un criminel imprévisible qui pousse Gotham au bord du chaos.'),
(7, 'Le Roi Lion', '1994-06-24', 'Animation', 'Roger Allers', 'https://image.tmdb.org/t/p/w500/sKCr78MXSLixwmZ8DyJLrpMsd15.jpg', 'Le jeune lion Simba doit reprendre sa place de roi après avoir fui le royaume suite à la mort de son père.'),
(8, 'Forrest Gump', '1994-07-06', 'Drame', 'Robert Zemeckis', 'https://image.tmdb.org/t/p/w500/arw2vcBveWOVZr6pxd9XTd1TdQa.jpg', 'Forrest, un homme simple d’esprit mais au grand cœur, traverse les décennies en influençant sans le vouloir l’histoire des États-Unis.'),
(9, 'Interstellar', '2014-11-07', 'Science-fiction', 'Christopher Nolan', 'https://image.tmdb.org/t/p/w500/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg', 'Des astronautes voyagent à travers un trou de ver pour trouver une nouvelle planète habitable et sauver l’humanité.'),
(10, 'Jurassic Park', '1993-06-11', 'Aventure', 'Steven Spielberg', 'https://image.tmdb.org/t/p/w500/c414cDeQ9b6qLPLeKmiJuLDUREJ.jpg', 'Des scientifiques recréent des dinosaures à partir d’ADN fossile, mais le rêve tourne au cauchemar lorsque les créatures s’échappent.'),
(11, 'Pulp Fiction', '1994-10-14', 'Thriller', 'Quentin Tarantino', 'https://image.tmdb.org/t/p/w500/dM2w364MScsjFf8pfMbaWUcWrR.jpg', 'Des histoires entrelacées de gangsters, de boxeurs et de truands s’entremêlent dans un Los Angeles aussi absurde que violent.'),
(12, 'Matrix', '1999-03-31', 'Science-fiction', 'Wachowski', 'https://image.tmdb.org/t/p/w500/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg', 'Un informaticien découvre que le monde qu’il connaît n’est qu’une simulation créée par des machines pour asservir l’humanité.'),
(13, 'Les Indestructibles', '2004-11-05', 'Animation', 'Brad Bird', 'https://image.tmdb.org/t/p/w500/gspdaJ9o5gEONr9v7PLJ9Gk4b3P.jpg', 'Une famille de super-héros tente de vivre une vie normale tout en affrontant un ennemi redoutable.'),
(14, 'Shrek', '2001-05-18', 'Comédie', 'Andrew Adamson', 'https://image.tmdb.org/t/p/w500/2yYP0PQjG8zVqturh1BAqu2Tixl.jpg', 'Un ogre grognon part sauver une princesse, et découvre l’amour et l’amitié sur le chemin.'),
(15, 'La La Land', '2016-12-09', 'Romance', 'Damien Chazelle', 'https://image.tmdb.org/t/p/w500/uDO8zWDhfWwoFdKS4fzkUJt0Rf0.jpg', 'Un pianiste de jazz et une actrice en devenir tombent amoureux à Los Angeles, mais leurs rêves les éloignent.'),
(16, 'Coco', '2017-11-22', 'Animation', 'Lee Unkrich', 'https://image.tmdb.org/t/p/w500/gGEsBPAijhVUFoiNpgZXqRVWJt2.jpg', 'Un jeune garçon passionné de musique voyage au Pays des Morts pour découvrir la vérité sur sa famille.'),
(17, 'Parasite', '2019-05-30', 'Thriller', 'Bong Joon-ho', 'https://image.tmdb.org/t/p/w500/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg', 'Une famille pauvre s’infiltre dans la maison d’une famille riche, jusqu’à ce que les choses dégénèrent.'),
(18, 'Dune', '2021-09-15', 'Science-fiction', 'Denis Villeneuve', 'https://image.tmdb.org/t/p/w500/d5NXSklXo0qyIYkgV94XAgMIckC.jpg', 'Le jeune Paul Atréides découvre son destin sur la planète désertique Arrakis, source de la substance la plus précieuse de l’univers.'),
(19, 'Joker', '2019-10-04', 'Drame', 'Todd Phillips', 'https://image.tmdb.org/t/p/w500/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg', 'Arthur Fleck, un comédien raté, sombre peu à peu dans la folie et devient le criminel connu sous le nom de Joker.'),
(20, 'Top Gun: Maverick', '2022-05-27', 'Action', 'Joseph Kosinski', 'https://image.tmdb.org/t/p/w500/62HCnUTziyWcpDaBO2i1DX17ljH.jpg', 'Le pilote d’élite Maverick reprend du service pour former une nouvelle génération d’aviateurs et affronter son passé.');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `role`) VALUES
(1, 'amaury', '$2y$10$Rx/Dk6muNHcooRvdBzh7MesYqvVFeX3TyQRzTss0ZOroZ9SPYjRK2', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Diffusion`
--
ALTER TABLE `Diffusion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `film_id` (`film_id`);

--
-- Index pour la table `Film`
--
ALTER TABLE `Film`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Diffusion`
--
ALTER TABLE `Diffusion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `Film`
--
ALTER TABLE `Film`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Diffusion`
--
ALTER TABLE `Diffusion`
  ADD CONSTRAINT `Diffusion_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `Film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
