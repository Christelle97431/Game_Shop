-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 08 jan. 2023 à 09:04
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `my_shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(1, 'Jeux d\'ambiance', NULL),
(2, 'Jeux de stratégie', NULL),
(3, 'Jeux juniors', NULL),
(4, 'Jeux classiques', NULL),
(5, 'Adresse, mémoire et rapidité', 1),
(6, 'Bluff, hasard et intuition', 1),
(7, 'Défis, énigmes et quizz', 1),
(8, 'Délires et rigolades', 1),
(9, 'Aventure, course et simulation', 2),
(10, 'Gestion et Développement', 2),
(11, 'Guerres et combats', 2),
(12, 'Réflexion, énigmes et casse-têtes', 2),
(13, 'Jeux de dés', 4),
(14, 'Jeux de cartes', 4);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `description` varchar(1024) DEFAULT NULL,
  `picture` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category_id`, `description`, `picture`) VALUES
(1, 'Jeu de 78 cartes Tarot', 8, 14, 'Jeu de 78 Cartes Tarot - Ducale\r\nTarot 78 cartes Ducale Ecopack', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Tarot.JPG'),
(2, 'Jeu de Belote', 5, 14, 'Jeu de 32 cartes Belote - Grimaud Expert', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Belote.JPG'),
(3, 'Les Cinq Rois', 15, 13, 'Soyez fin et rusé pour gagner avec malice...!\r\nLes Cinq Rois est un jeu de cartes inspiré du rami pour 1 à 7 joueurs.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Cinq%20Rois.JPG'),
(4, 'Yahtzee Classique', 18, 13, 'Relevez le défi !', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Yatzee.JPG'),
(5, 'Yam', 18, 13, 'L\'incontournable jeu de dés avec ses nombreuses variantes.\r\nLe Yam est un jeu de dés amusant pour toute la famille. Jouez aux dés - Soyez futés !', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Yam.JPG'),
(6, 'Flamecraft', 81, 11, 'Saurez-vous enchanter la ville avec vos dragons ?\r\n\r\nFlamecraft - Édition Deluxe est une jeu de stratégie et de plateau pour 1 à 5 joueurs.\r\n\r\nCette boite Deluxe contient du matériel supplémentaire.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Flamecraft.JPG'),
(7, 'V Sabotage', 57, 11, 'La victoire repose sur vous...\r\n\r\nV-Sabotage (ex V-Commandos) est un jeu de stratégie et de combat pour 1 à 4 joueurs qui se joue en mode coopératif.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/V_Sabotage.JPG'),
(8, 'Le trône de Fer', 90, 11, 'Boite de base pour 1 joueur...\r\n\r\nLannister est une boite de base contenant tout le nécessaire pour 1 joueur dans le cadre d\'une partie du jeu de figurines Le Trône de Fer.\r\n\r\nPour jouer, il est nécessaire de posséder 2 boites de base (1 pour chaque joueur).', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Trone_Fer.JPG'),
(9, 'Saladin', 27, 10, 'Au coeur des combats des Croisés...\r\n\r\nSaladin est un jeu d\'affrontement et de stratégie pour deux joueurs.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Saladin.JPG'),
(10, 'Jurassic World', 35, 10, 'Construisez avec vos amis le plus grand et le plus incroyable parc de dinosaures au monde...\r\n\r\nJurassic World : Le jeu de société est un jeu de plateau et de stratégie coopératif pour 2 à 6 joueurs.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Jurassic.JPG'),
(11, 'Carnegie', 67, 10, 'Ferez-vous aussi bien que le célèbre industriel écossais du XIXe siècle..?\r\n\r\nCarnegie est un jeu de plateau et de stratégie pour 1 à 4 joueurs Experts.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Carnegie.JPG'),
(12, 'Unicorns', 23, 9, 'Bienvenue dans le monde merveilleux des licornes !\r\n\r\nUnicorns est un jeu de cartes et de stratégie pour 2 à 5 joueurs.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Unicorns.JPG'),
(13, '1911 : Amundsen VS Scott', 23, 9, 'Laisserez-vous votre nom dans l\'histoire...\r\n\r\n1911 : Amundsen vs Scott est un jeu de cartes et de course pour 2 joueurs qui vous faire revivre l\'épopée de 2 explorateurs dans une course vers le Pôle Sud.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/1911.JPG'),
(14, 'JuDuKu', 27, 8, 'Humour noir et gages délirants s\'invitent en soirée...\r\n\r\nJuduku - Révélations Explosives, c\'est 480 nouvelles cartes pleines d\'humour noir et très osé pour pimenter vos soirées et révéler les pires pensées de tes ami(e)s !', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Juduku.JPG'),
(15, 'ça Suffit !', 12, 8, 'La revanche des cancres...!\r\n\r\nÇa Suffit ! est un jeu de cartes et d\'ambiance délirant pour 4 à 8 joueurs.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Ca_suffit.JPG'),
(16, 'Exploding Minions', 22, 8, 'Un bon minion est un minion dynamité...\r\n\r\nExploding Minions est un jeu de cartes et d\'ambiance délirant et explosif qui s\'inscrit dans l\'univers de l\'incontournable Exploding Kitten.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Minions.JPG'),
(17, 'Mortum', 42, 7, 'Enquêtez au coeur des mystères et légendes médiévales...\r\n\r\nMortum : Médiéval Détective est un jeu d\'aventures et d\'enquêtes pour 1 à 6 joueurs.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Mortum.JPG'),
(18, 'Infernal Wagon', 14, 7, 'Le jeu de course coopératif et survolté...\r\n\r\nInfernal Wagon est un jeu d\'ambiance coopératif qui vous propose un défi haletant en 7 minutes chrono pour 2 à 5 joueurs.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Infernal_wagon.JPG'),
(19, 'Little Secret', 21, 6, 'Et si vous étiez l\'intrus... depuis le début !\r\n\r\nLittle Secret est un jeu de bluff et de déduction pour à partir de 4 joueurs.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Little_secret.JPG'),
(20, 'Cabo', 12, 6, 'Retrouverez-vous la licorne mythique Cabo ?\r\n\r\nCabo est un jeu de cartes et de bluff rapide pour 2 à 5 joueurs.\r\n\r\nAvec 2 exemplaires du jeu, vous pouvez jouer jusqu\'à 6 joueurs.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Cabot.JPG'),
(21, 'Dollars Wanted', 10, 6, 'Faites vos plans pour dévaliser la banque !\r\n\r\nDollars Wanted est un jeu de bluff simple mais terriblement efficace !', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Dollars_Wanted.JPG'),
(22, 'Perudo Jumbo', 27, 6, 'Le Perudo pour 10 joueurs...\r\n\r\nPerudo Jumbo est un jeu de dés et de bluff pour 2 à 10 joueurs.\r\n\r\nVersion jumbo (jusqu\'à 10 joueurs) du jeu de dés Perudo + de nouvelles variantes.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Perudo_Jumbo.JPG'),
(23, 'Poulpyz', 17, 5, 'Donnez des bras et des tentacules à ces êtres tout mignons !\r\nPoulpyz est un jeu d\'observation et de rapidité accessible dès 5 ans...', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Poulpy.JPG'),
(24, 'Topic', 17, 5, 'Soyez rapide pour associer thème et syllabes...\r\nTopic est un jeu d\'ambiance, de rapidité et d\'association d\'idées pour 2 à 6 joueurs.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Topic.JPG'),
(25, 'Bistro Pot Pourri', 33, 5, 'Obtiendrez-vous cette satanée étoile...?\r\nBistro Pot Pourri est un jeu d\'ambiance pour 3 à 5 joueurs.', 'http://localhost/C-RDG-114-REM-1-1-myshop-christelle.de-roffignac/src/img/Pot_Pourri.JPG');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `admin` tinyint(4) DEFAULT NULL,
  `json` char(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `admin`, `json`, `created_at`) VALUES
(1, 'Test', '123*', 'test@gmail.com', 1, 'test@gmail.com63ba85d2603bc5.68476889', '2023-01-08'),
(10, 'Velit sit omnis eni', '$2y$10$3zeCB8NiBliL06EwL0OaYeHj.LvHhoj1ie1hN6kYE8XH40XUXJS/q', 'mail1@gmail.com', 0, NULL, '2023-01-08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
