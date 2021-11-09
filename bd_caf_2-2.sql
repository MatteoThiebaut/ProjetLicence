-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 09 nov. 2021 à 08:22
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_caf_2`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `chemin` varchar(50) NOT NULL,
  `domaine` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `obligatoire`
--

CREATE TABLE `obligatoire` (
  `id_user` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `inscription` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `qcm`
--

CREATE TABLE `qcm` (
  `id` int(11) NOT NULL,
  `id_cours` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `id_qcm` int(11) NOT NULL,
  `question` varchar(250) NOT NULL,
  `rep_correcte` varchar(250) NOT NULL,
  `rep_2` varchar(250) NOT NULL,
  `rep_3` varchar(250) NOT NULL,
  `rep_4` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_qcm` int(11) NOT NULL,
  `date_eval` date NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `profil` varchar(32) NOT NULL,
  `empreinte` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `profil`, `empreinte`, `email`) VALUES
(1, 'ju', 'admin', 'ruwoBc8dXvAX.', 'justin@admin.fr'),
(4, 'bukvbiu', 'eleve', 'ruB5nygX2Xnns', 'igi');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `obligatoire`
--
ALTER TABLE `obligatoire`
  ADD KEY `fk_id_user` (`id_user`),
  ADD KEY `fk_id_cours` (`id_cours`);

--
-- Index pour la table `qcm`
--
ALTER TABLE `qcm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_cours_quizz` (`id_cours`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_qcm` (`id_qcm`);

--
-- Index pour la table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_user_score` (`id_user`),
  ADD KEY `fk_id_qcm_score` (`id_qcm`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `qcm`
--
ALTER TABLE `qcm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `obligatoire`
--
ALTER TABLE `obligatoire`
  ADD CONSTRAINT `fk_id_cours` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `qcm`
--
ALTER TABLE `qcm`
  ADD CONSTRAINT `fk_id_cours_quizz` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_id_qcm` FOREIGN KEY (`id_qcm`) REFERENCES `qcm` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `fk_id_qcm_score` FOREIGN KEY (`id_qcm`) REFERENCES `qcm` (`id`),
  ADD CONSTRAINT `fk_id_user_score` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
