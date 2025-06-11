-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 11 juin 2025 à 01:56
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionstagiare`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `email`, `password`, `created_at`) VALUES
(1, 'Admin', 'System', 'admin@epg.ma', 'admin123', '2025-06-10 23:53:02');

-- --------------------------------------------------------

--
-- Structure de la table `avancements`
--

CREATE TABLE `avancements` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `fichier` varchar(255) DEFAULT NULL,
  `stagiaire_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avancements`
--

INSERT INTO `avancements` (`id`, `titre`, `description`, `fichier`, `stagiaire_id`, `created_at`) VALUES
(1, 'Début du projet', 'Nous avons terminé l’analyse des besoins et commencé la conception.', 'gestion.rar', 1, '2025-06-10 23:10:39'),
(2, 'base de donner', 'l', '', 1, '2025-06-10 23:18:48');

-- --------------------------------------------------------

--
-- Structure de la table `encadrants`
--

CREATE TABLE `encadrants` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `poste` varchar(100) DEFAULT NULL,
  `departement` varchar(100) DEFAULT NULL,
  `role` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `encadrants`
--

INSERT INTO `encadrants` (`id`, `nom`, `prenom`, `email`, `telephone`, `poste`, `departement`, `role`) VALUES
(1, 'Benali', 'Said', 's.benali@societe.com', '0612345678', 'Chef de Projet', 'Informatique', 'Encadre les stagiaires sur les projets web'),
(2, 'Lamrani', 'Fatima', 'f.lamrani@societe.com', '0623456789', 'Ingénieur Réseaux', 'Infrastructure', 'Responsable du suivi technique des stagiaires'),
(3, 'Raji', 'Omar', 'o.raji@societe.com', '0634567890', 'Data Analyst', 'Analyse de données', 'Supervise les missions liées à la BI'),
(4, 'El Alami', 'Nadia', 'n.elalami@societe.com', '0645678901', 'RH', 'Ressources Humaines', 'S’occupe de l’accueil et du suivi administratif'),
(5, 'Toumi', 'Youssef', 'y.toumi@societe.com', '0656789012', 'Développeur Full Stack', 'Développement', 'Encadre les projets de développement PHP et JS');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `reponse` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id`, `question`, `reponse`) VALUES
(1, 'Comment s\'inscrire pour un stage ?', 'Connectez-vous à votre espace étudiant et suivez les étapes.'),
(2, 'Quelle est la durée minimale d\'un stage ?', '2 semaines (observation), 1 mois (technique), 3 mois (fin d\'études).'),
(3, 'Comment sont évalués les stagiaires ?', 'Sur la base du rapport, soutenance et appréciation de l\'encadrant.');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expires_at`) VALUES
(3, 'hanan@gmail.com', '0b0e3b06d1cf81f38432e95df8da239d13e48f18e84286fe2a5b49da64041a29', '2025-05-13 18:47:54'),
(9, 'nada.oujg@gmail.com', '0adad6cb6accf10c64d718e1a51c4f83b737e925b2843d688539b56aa7da618c', '2025-05-15 17:03:44');

-- --------------------------------------------------------

--
-- Structure de la table `stages`
--

CREATE TABLE `stages` (
  `id` int(11) NOT NULL,
  `icone` varchar(100) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stages`
--

INSERT INTO `stages` (`id`, `icone`, `titre`, `description`) VALUES
(1, 'fas fa-eye', 'Stage d\'observation', 'Permet aux étudiants de découvrir un environnement professionnel réel sans intervention active.'),
(2, 'fas fa-tools', 'Stage technique', 'Mise en pratique des compétences techniques acquises pendant la formation.'),
(3, 'fas fa-graduation-cap', 'Stage de fin d\'études', 'Projet complet avec rapport et soutenance.');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaires`
--

CREATE TABLE `stagiaires` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mot_de_passe` varchar(150) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `genre` enum('Homme','Femme') DEFAULT 'Homme',
  `filiere` varchar(100) DEFAULT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `etablissement` varchar(150) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `sujet_stage` text DEFAULT NULL,
  `statut` enum('en cours','terminé') DEFAULT 'en cours',
  `date_ajout` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stagiaires`
--

INSERT INTO `stagiaires` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `telephone`, `adresse`, `date_naissance`, `genre`, `filiere`, `niveau`, `etablissement`, `date_debut`, `date_fin`, `sujet_stage`, `statut`, `date_ajout`) VALUES
(1, 'oujghou', 'nada', 'hidayanada83@gmail.com', '$2y$10$q2y1LisanTeOntgEZxRiKOs9.U6hVqwjJoNh7tJpA0uqjLhOpjLQm', '0621284678', 'errachidia', '2005-03-20', 'Femme', 'MCW', 'bac+2', 'BTS', '2025-02-02', '2025-05-05', 'PFE', 'terminé', '2025-05-09 14:38:45'),
(2, 'oudirro', 'hanan', 'hanan@gmail.com', '$2y$10$GmyuufaY.0QeLzhgjjbB6eKPN9VgRaZp0Mv/rWIcK8QWfKPMNX51u', '0225467812', 'tounfite', '2005-11-08', 'Femme', 'MCW', 'bac+2', 'FST', '2025-05-12', '2025-06-12', 'PFE', 'en cours', '2025-05-12 13:28:29'),
(3, 'wassim', 'waasim', 'wasim@gmail.com', '$2y$10$6YJ.1G9JACrPyeHiVnXKdeYvDebo4K8X/Qp42knRi8gOiQbFT3zl2', '0645789632', 'fes', '2004-12-28', 'Homme', 'PME', 'bac+1', 'BTS', '2025-02-23', '2025-05-28', 'STAGE Technique', 'terminé', '2025-05-23 00:18:59'),
(4, 'khadija', 'khadija', 'khadija@gmail.com', '$2y$10$H5dsv3XsAcTJ.fbv3Pcb2enTQBfqxJYYsmYOf8AvHFzFbNaWJ/ACa', '0654789612', 'errachidia', '2005-08-11', 'Femme', 'SI', 'bac+2', 'BTS', '2025-04-02', '2025-07-02', 'PFE', 'en cours', '2025-06-02 10:19:00'),
(5, 'tt', 'amine', 'amine@gmail.com', '$2y$10$8wxI20cQNtLCFLFW2H5.U.qp6b156YJVEm/ZpMMpgDVBGR6TwVKWe', '0625467812', 'fes', '2003-05-25', 'Homme', 'MCW', 'bac+3', 'EST', '2025-06-05', '2025-07-07', 'PFE', 'en cours', '2025-06-04 00:09:38');

-- --------------------------------------------------------

--
-- Structure de la table `statistiques`
--

CREATE TABLE `statistiques` (
  `id` int(11) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `valeur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `statistiques`
--

INSERT INTO `statistiques` (`id`, `label`, `valeur`) VALUES
(1, 'Stagiaires Formés', '500+'),
(2, 'Entreprises Partenaires', '50+'),
(3, 'Taux de Satisfaction', '95%'),
(4, 'Encadrants Experts', '100+');

-- --------------------------------------------------------

--
-- Structure de la table `temoignages`
--

CREATE TABLE `temoignages` (
  `id` int(11) NOT NULL,
  `texte` text DEFAULT NULL,
  `auteur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `temoignages`
--

INSERT INTO `temoignages` (`id`, `texte`, `auteur`) VALUES
(1, 'Une expérience enrichissante qui m\'a permis de mettre en pratique mes connaissances.', 'Ahmed B., Génie Civil'),
(2, 'Le suivi personnalisé a été déterminant dans la réussite de mon stage.', 'Sarah M., Génie Industriel');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `avancements`
--
ALTER TABLE `avancements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `encadrants`
--
ALTER TABLE `encadrants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `statistiques`
--
ALTER TABLE `statistiques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `temoignages`
--
ALTER TABLE `temoignages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `avancements`
--
ALTER TABLE `avancements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `encadrants`
--
ALTER TABLE `encadrants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `stages`
--
ALTER TABLE `stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `statistiques`
--
ALTER TABLE `statistiques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `temoignages`
--
ALTER TABLE `temoignages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
