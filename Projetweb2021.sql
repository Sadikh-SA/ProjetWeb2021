-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 13 mai 2021 à 00:16
-- Version du serveur :  8.0.23-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetweb2021`
--

-- --------------------------------------------------------

--
-- Structure de la table `Chapitre`
--

CREATE TABLE `Chapitre` (
  `id` int NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `videos` varchar(255) DEFAULT NULL,
  `fichiers` varchar(255) DEFAULT NULL,
  `questionnaire` varchar(255) DEFAULT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idCours` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Chapitre`
--

INSERT INTO `Chapitre` (`id`, `titre`, `description`, `videos`, `fichiers`, `questionnaire`, `dateCreation`, `idCours`) VALUES
(1, 'web 2.0', 'Chapitre sur les webs', 'videoTest.webm', 'courstest.pdf', 'qcmtest.xml', '2021-04-28 20:33:27', 3),
(2, 'chapitre test2', 'tdrbhjn,k;lm:azsdcfvbn,;:cfvh b,lm;ùm:ùxdcfgvhbjnk,l;m', 'Tuto.mp4', 'xpath.pdf', 'qcmtest.xml', '2021-04-28 22:51:22', 1),
(3, 'Chapitre testteur', 'Descritpion hshggd', 'videoTest.webm', 'courstest.pdf', 'qcmtest.xml', '2021-05-11 17:14:40', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Cours`
--

CREATE TABLE `Cours` (
  `id` int NOT NULL,
  `nom` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idFormation` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Cours`
--

INSERT INTO `Cours` (`id`, `nom`, `description`, `image`, `dateCreation`, `idFormation`) VALUES
(1, 'PostgreSQL', 'PostgreSQL est un système de gestion de base de données relationnelle et objet. C\'est un outil libre disponible selon les termes d\'une licence de type BSD.', 'postgresql.png', '2021-04-10 15:26:45', 1),
(2, 'React', 'Ceci est la description du cours Réactjs', 'react.png', '2021-04-10 15:47:37', 1),
(3, 'C#', 'C# est un langage de programmation orientée objet, commercialisé par Microsoft depuis 2002 et destiné à développer sur la plateforme Microsoft .NET.', 'CSharp.jpeg', '2021-04-10 17:26:39', 1),
(4, 'SCRUM AGILE', 'Scrum est un framework ou cadre de développement de produits logiciels complexes. Il est défini par ses créateurs comme un cadre de travail', 'agile.jpeg', '2021-04-28 19:13:25', 2),
(7, 'Cours nominal', 'Description du cours nominal', 'jquery.jpeg', '2021-05-12 04:38:03', 1),
(8, 'cours', 'description', 'avatar.png', '2021-05-12 08:59:32', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Discussion`
--

CREATE TABLE `Discussion` (
  `id` int NOT NULL,
  `idCours` int NOT NULL,
  `idUtilisateur` int NOT NULL,
  `message` varchar(255) NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Discussion`
--

INSERT INTO `Discussion` (`id`, `idCours`, `idUtilisateur`, `message`, `dateCreation`) VALUES
(1, 1, 1, '                                 aazertyuiokjhgvcfxdyfchv buhogy', '2021-05-12 03:32:17'),
(2, 1, 1, '                                 test nominal\r\n', '2021-05-12 04:39:30'),
(3, 1, 1, '                                 ma question', '2021-05-12 09:01:56');

-- --------------------------------------------------------

--
-- Structure de la table `Formation`
--

CREATE TABLE `Formation` (
  `id` int NOT NULL,
  `titre` varchar(250) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dateCreation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Formation`
--

INSERT INTO `Formation` (`id`, `titre`, `description`, `dateCreation`) VALUES
(1, 'Informatique', 'Formations sur les TICS', '2021-03-20 16:32:17'),
(2, 'Marketing', 'Description de Marketing', '2021-03-20 16:32:17');

-- --------------------------------------------------------

--
-- Structure de la table `Forum`
--

CREATE TABLE `Forum` (
  `id` int NOT NULL,
  `idCours` int NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Niveau`
--

CREATE TABLE `Niveau` (
  `id` int NOT NULL,
  `pourcentage` int NOT NULL,
  `idUtilisateur` int NOT NULL,
  `idChapitre` int NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(255) NOT NULL,
  `dateCreation` datetime NOT NULL,
  `idFormation` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`id`, `nom`, `prenom`, `mail`, `role`, `type`, `password`, `dateCreation`, `idFormation`) VALUES
(1, 'GUEYE', 'Ababacar Sadikh', 'ababacar-sadikh_gueye@etu.u-bourgogne.fr', 'Admin', 1, 'Sadikh', '2021-03-16 22:36:02', NULL),
(2, 'Baldé', 'Abdoul Gadiry', 'abdoul-gadiry_balde@etu.u-bourgogne.fr', 'Admin', 1, 'Gadiry', '2021-03-16 22:37:12', NULL),
(3, 'Gueye', 'Abou', 'abougueye96@yahoo.fr', 'User', 1, 'Sadikh', '2021-03-16 22:38:44', 1),
(4, 'Moimeme', 'Moimeme', 'Moimeme@gmail.com', 'User', 1, 'Moimeme', '2021-03-17 12:41:03', 2),
(5, 'Seck', 'Seynabou', 'seyzi@gmail.com', 'User', 1, 'Nabou', '2021-03-17 17:47:21', 2),
(6, 'azerty', 'azerty', 'azerty@gmail.com', 'User', 1, 'Moimeme', '2021-03-20 20:39:29', 1),
(7, 'GUEYE', 'Awa', 'awagueye98@gmail.com', 'User', 1, 'Moimeme', '2021-03-21 20:17:26', 2),
(8, 'Test', 'Test', 'test@gmail.com', 'User', 1, 'Sadikh', '2021-05-12 04:45:49', 1),
(9, 'GUEYE', 'Ababacar', 'sadikh@gmail.com', 'User', 1, 'Sadikh', '2021-05-12 08:57:38', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Chapitre`
--
ALTER TABLE `Chapitre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCours` (`idCours`);

--
-- Index pour la table `Cours`
--
ALTER TABLE `Cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idFormation` (`idFormation`);

--
-- Index pour la table `Discussion`
--
ALTER TABLE `Discussion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUtilisateur` (`idUtilisateur`),
  ADD KEY `idCours` (`idCours`);

--
-- Index pour la table `Formation`
--
ALTER TABLE `Formation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Forum`
--
ALTER TABLE `Forum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCours` (`idCours`);

--
-- Index pour la table `Niveau`
--
ALTER TABLE `Niveau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_niveau_users` (`idUtilisateur`),
  ADD KEY `idChapitre` (`idChapitre`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `idFormation` (`idFormation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Chapitre`
--
ALTER TABLE `Chapitre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Cours`
--
ALTER TABLE `Cours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Discussion`
--
ALTER TABLE `Discussion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Formation`
--
ALTER TABLE `Formation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Forum`
--
ALTER TABLE `Forum`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Niveau`
--
ALTER TABLE `Niveau`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Chapitre`
--
ALTER TABLE `Chapitre`
  ADD CONSTRAINT `Chapitre_ibfk_1` FOREIGN KEY (`idCours`) REFERENCES `Cours` (`id`);

--
-- Contraintes pour la table `Cours`
--
ALTER TABLE `Cours`
  ADD CONSTRAINT `Cours_ibfk_1` FOREIGN KEY (`idFormation`) REFERENCES `Formation` (`id`);

--
-- Contraintes pour la table `Discussion`
--
ALTER TABLE `Discussion`
  ADD CONSTRAINT `Discussion_ibfk_2` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`id`),
  ADD CONSTRAINT `Discussion_ibfk_3` FOREIGN KEY (`idCours`) REFERENCES `Cours` (`id`);

--
-- Contraintes pour la table `Forum`
--
ALTER TABLE `Forum`
  ADD CONSTRAINT `Forum_ibfk_1` FOREIGN KEY (`idCours`) REFERENCES `Cours` (`id`);

--
-- Contraintes pour la table `Niveau`
--
ALTER TABLE `Niveau`
  ADD CONSTRAINT `fk_niveau_users` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`id`),
  ADD CONSTRAINT `Niveau_ibfk_1` FOREIGN KEY (`idChapitre`) REFERENCES `Chapitre` (`id`);

--
-- Contraintes pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD CONSTRAINT `Utilisateur_ibfk_1` FOREIGN KEY (`idFormation`) REFERENCES `Formation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
