-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 30 mai 2023 à 16:07
-- Version du serveur :  5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quiz`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_50D0C6061E27F6BF` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `content`, `is_correct`) VALUES
(4, 3, 'tue un processus', 0),
(5, 3, 'arrête le script', 1),
(6, 3, 'sort d\'une boucle', 0),
(7, 3, 'bypasse une erreur', 0),
(8, 4, 'input type=\"reset\"', 1),
(9, 4, 'input type =\"\"', 0),
(10, 4, 'input type =\"clear\"', 0),
(11, 5, 'une erreur', 0),
(12, 5, 'qcmquiz', 0),
(13, 5, '7', 1),
(14, 5, '6', 0),
(15, 6, 'une erreur', 0),
(16, 6, '0,5', 1),
(17, 6, 'racine carrée de 0,5', 0),
(18, 7, 'CD', 1),
(19, 7, 'BCDE', 0),
(20, 7, 'CDE', 0),
(21, 7, 'BCD', 0),
(22, 8, 'log(Bonjour);', 0),
(23, 8, 'prompt(Bonjour);', 0),
(24, 8, 'console.log(\"Bonjour\");', 1),
(25, 9, 'Des technologies qui reposent sur l\'utilisation d\'algorithmes visant à simuler l\'intelligence humaine.', 1),
(26, 9, 'Des robots dotés d’une conscience et capables d’être autonomes.', 0),
(27, 10, 'Xavier Niel et Mounir Mahjoubi', 0),
(28, 10, 'John McCarthy et Marvin Lee Minsky', 1),
(29, 10, 'Elon Musk et Steve Jobs', 0),
(30, 11, 'Pour se faire livrer des courses, rendre des décisions de justice, pour le décompte électoral.', 0),
(31, 11, 'Dans la télémédecine, la conduite autonome, la traduction automatique.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230525090936', '2023-05-25 09:09:44', 97),
('DoctrineMigrations\\Version20230525092404', '2023-05-25 09:24:08', 197),
('DoctrineMigrations\\Version20230525093745', '2023-05-25 09:37:48', 199),
('DoctrineMigrations\\Version20230527095233', '2023-05-27 09:52:40', 104),
('DoctrineMigrations\\Version20230527203206', '2023-05-27 20:32:14', 781),
('DoctrineMigrations\\Version20230529101421', '2023-05-29 10:14:31', 948),
('DoctrineMigrations\\Version20230529144558', '2023-05-29 14:46:03', 1360);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494E853CD175` (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `quiz_id`, `content`) VALUES
(3, 13, 'Que fait die() ?'),
(4, 13, 'Quel bouton permet d\'effacer tous les champs d\'un formulaire ?'),
(5, 13, 'strlen(\"QCMQUIZ\") renvoie'),
(6, 14, 'Que retourne Math.min(Math.E , Math.SQRT1_2 , 0.5) ?'),
(7, 14, 'Que renvoie ch1.substring(2,4) si ch1 =\"ABCDEF\" ?'),
(8, 14, 'Comment afficher \"Bonjour\" sur la console ?'),
(9, 15, 'Quelle est la définition de l’intelligence artificielle ?'),
(10, 15, 'Qui sont les pionniers de l’intelligence artificielle ?'),
(11, 15, 'Quels sont des usages concrets de l\'IA ?');

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id`, `titre`, `description`, `image`, `updated_at`) VALUES
(13, 'PHP EXAM', 'QCM sur PHP avec des réponses pour la préparation des entretiens d\'embauche, des tests en ligne, aux examens et aux certifications.', 'pexels-pixabay-270360.jpg', '2023-05-29 15:08:25'),
(14, 'Quiz JavaScript', 'Le JavaScript est un langage interprété par le navigateur grâce à un « moteur JavaScript » (programme intégré au navigateur qui exécute le code). Il est très étroitement lié  au HTML et CSS,', 'pexels-realtoughcandycom-11035380.jpg', '2023-05-29 15:12:55'),
(15, 'Quiz. L\'intelligence artificielle', 'Qu\'est-ce que l\'intelligence artificielle ? Quels sont ses usages ? Qu\'énoncent les lois d\'Asimov ? 10 questions pour tester vos connaissances sur l\'intelligence artificielle !', 'pexels-alex-knight-2599244.jpg', '2023-05-29 15:22:59');

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

DROP TABLE IF EXISTS `score`;
CREATE TABLE IF NOT EXISTS `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_32993751A76ED395` (`user_id`),
  KEY `IDX_32993751853CD175` (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'anas@gmail.com', '[\"ROLE_ETUDIANT\"]', '$2y$13$/T8gJav5L/tnqJNhlUP31u3x/EW0o1qHMwTk.mChk/nz7rsTlsaCa'),
(2, 'info@upf.ac.ma', '[\"ROLE_ADMIN\"]', '$2y$13$qmHM99pqaT5fIp/vwa9yjO6IeDAgCbiDSPZYXpnLDz4aocldkAGry'),
(6, 'anaslahmidi@gmail.com', '[\"ROLE_ETUDIANT\"]', '$2y$13$hkYBLqzV/moqaNuNjhlLs.gCLX6g5i.5UIZwTELUXEHG8tVsPKiGy'),
(7, 'lina@gmail.com', '[\"ROLE_ETUDIANT\"]', '$2y$13$ar/1rQ1spOcEm1mM8jzmAOqunGbOdJE5NonvCJyIcVhA79jZXO6fK');

-- --------------------------------------------------------

--
-- Structure de la table `user_quiz`
--

DROP TABLE IF EXISTS `user_quiz`;
CREATE TABLE IF NOT EXISTS `user_quiz` (
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`quiz_id`),
  KEY `IDX_DE93B65BA76ED395` (`user_id`),
  KEY `IDX_DE93B65B853CD175` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `FK_50D0C6061E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494E853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `FK_32993751853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`),
  ADD CONSTRAINT `FK_32993751A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_quiz`
--
ALTER TABLE `user_quiz`
  ADD CONSTRAINT `FK_DE93B65B853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DE93B65BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
