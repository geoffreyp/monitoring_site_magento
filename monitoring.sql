-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Mer 07 Décembre 2016 à 16:51
-- Version du serveur :  5.6.33
-- Version de PHP :  7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `monitoring`
--

-- --------------------------------------------------------

--
-- Structure de la table `commit`
--

CREATE TABLE `commit` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `commentaire` varchar(250) DEFAULT NULL,
  `date_cree` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `group`
--

INSERT INTO `group` (`id`, `name`) VALUES
(3, 'Manager'),
(4, 'Developer');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `importance` int(1) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `priorite`
--

CREATE TABLE `priorite` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `priorite`
--

INSERT INTO `priorite` (`id`, `name`) VALUES
(3, 'Low'),
(4, 'Normal'),
(5, 'High'),
(6, 'Urgent'),
(7, 'Immediate');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `ssh_url` varchar(250) DEFAULT NULL,
  `http_url` varchar(250) DEFAULT NULL,
  `web_url` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `statut`
--

INSERT INTO `statut` (`id`, `name`) VALUES
(1, 'New'),
(2, 'Assigned'),
(3, 'Resolved'),
(4, 'Approved'),
(5, 'Closed'),
(6, 'Rejected'),
(7, 'Blocked'),
(8, 'In Progress');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `statut_id` int(11) NOT NULL,
  `priorite_id` int(11) NOT NULL,
  `tracker_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date_cree` varchar(50) NOT NULL,
  `date_fin` varchar(50) DEFAULT NULL,
  `date_modif` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ticket`
--

INSERT INTO `ticket` (`id`, `subject`, `description`, `statut_id`, `priorite_id`, `tracker_id`, `user_id`, `project_id`, `date_cree`, `date_fin`, `date_modif`) VALUES
(618598, 'Première demande', 'Ceci est la première demande', 1, 4, 4, 56780, 43188, '2016-12-05T21:41:09Z', NULL, '2016-12-06T09:33:03Z'),
(618599, 'Deuxième demande', '', 1, 4, 4, 56780, 43188, '2016-12-05T21:41:50Z', NULL, '2016-12-05T21:41:50Z'),
(618770, 'Urgence, le site ne répond plus. ', '', 1, 7, 4, 56780, 43188, '2016-12-06T09:33:44Z', NULL, '2016-12-06T09:33:44Z'),
(618772, 'Problème tunnel de commande', 'Les belges ne peuvent pas commander.', 5, 6, 4, 56780, 43188, '2016-12-06T09:34:46Z', '2016-12-07T08:23:04Z', '2016-12-07T08:23:04Z'),
(618866, 'Issue tes', '', 1, 6, 4, 58454, 43188, '2016-12-06T12:44:10Z', NULL, '2016-12-06T12:44:10Z'),
(618890, 'low ticket', '', 1, 3, 4, 58454, 43188, '2016-12-06T14:03:14Z', NULL, '2016-12-07T08:24:14Z'),
(618892, 'testjojo', '', 5, 4, 4, 58454, 43188, '2016-12-06T14:10:15Z', '2016-12-06T14:10:15Z', '2016-12-06T14:10:15Z'),
(618913, 'testjojo2', '', 5, 4, 4, 58454, 43188, '2016-12-06T15:12:02Z', '2016-12-06T15:12:02Z', '2016-12-06T15:12:02Z'),
(618941, 'Test Nb Demande / groupe', '', 1, 5, 4, 58454, 43188, '2016-12-06T17:18:43Z', NULL, '2016-12-06T17:18:43Z'),
(619078, 'Test Demande', '', 1, 4, 4, 58454, 43188, '2016-12-07T08:14:34Z', NULL, '2016-12-07T08:14:34Z'),
(619096, 'Test status 1', '', 7, 4, 4, 58454, 43188, '2016-12-07T09:07:19Z', NULL, '2016-12-07T09:07:19Z'),
(619098, 'Test status 2', '', 1, 4, 4, 58454, 43188, '2016-12-07T09:08:11Z', NULL, '2016-12-07T09:08:11Z'),
(619099, 'Test status 3', '', 2, 4, 4, 58454, 43188, '2016-12-07T09:08:43Z', NULL, '2016-12-07T09:08:43Z'),
(619100, 'Test status 4', '', 8, 4, 4, 58454, 43188, '2016-12-07T09:09:22Z', NULL, '2016-12-07T09:09:22Z'),
(619102, 'Test status 5', '', 3, 4, 4, 58454, 43188, '2016-12-07T09:22:09Z', NULL, '2016-12-07T09:22:09Z'),
(619104, 'Test status 6', '', 4, 4, 4, 58454, 43188, '2016-12-07T09:22:37Z', NULL, '2016-12-07T09:22:37Z'),
(619105, 'Test status 7', '', 6, 4, 4, 58454, 43188, '2016-12-07T09:24:20Z', '2016-12-07T09:24:20Z', '2016-12-07T09:24:20Z'),
(619119, 'testFeature', '', 1, 4, 2, 58454, 43188, '2016-12-07T10:12:36Z', NULL, '2016-12-07T10:12:36Z'),
(619120, 'TestBug', '', 1, 4, 1, 58454, 43188, '2016-12-07T10:13:01Z', NULL, '2016-12-07T10:13:01Z'),
(619121, 'testSupport', '', 1, 4, 3, 58454, 43188, '2016-12-07T10:13:25Z', NULL, '2016-12-07T10:13:25Z'),
(619216, 'Urgent appelez les pompiers', '', 1, 7, 4, 58454, 43188, '2016-12-07T12:36:08Z', NULL, '2016-12-07T12:36:08Z');

-- --------------------------------------------------------

--
-- Structure de la table `tracker`
--

CREATE TABLE `tracker` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tracker`
--

INSERT INTO `tracker` (`id`, `name`) VALUES
(1, 'Bug'),
(2, 'Feature'),
(3, 'Support'),
(4, 'Task');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `name`, `group_id`) VALUES
(56780, 'Tony Smagghe', 3),
(58454, 'firstline i2l', 4),
(58455, 'Jérôme Buisine', 4),
(58457, 'Thomas Caron', 4);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commit`
--
ALTER TABLE `commit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `priorite`
--
ALTER TABLE `priorite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tracker`
--
ALTER TABLE `tracker`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;