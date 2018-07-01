-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 01 juil. 2018 à 11:48
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `easyoffice`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis_membre`
--

CREATE TABLE `avis_membre` (
  `id` int(11) NOT NULL,
  `id_membre_id` int(11) NOT NULL,
  `note_membre` int(11) NOT NULL,
  `commentaire_membre` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_commentaire_membre` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avis_salle`
--

CREATE TABLE `avis_salle` (
  `id` int(11) NOT NULL,
  `id_membre_id` int(11) NOT NULL,
  `id_salle_id` int(11) NOT NULL,
  `note_salle` int(11) NOT NULL,
  `commentaire_salle` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_commentaire_salle` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_salle`
--

CREATE TABLE `categorie_salle` (
  `id` int(11) NOT NULL,
  `libelle_categorie_salle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_salle`
--

INSERT INTO `categorie_salle` (`id`, `libelle_categorie_salle`) VALUES
(1, 'Stockage'),
(2, 'Séminaire / Conférence'),
(3, 'Formation'),
(4, 'Entretien'),
(5, 'Réunion'),
(6, 'Evènement');

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `id` int(11) NOT NULL,
  `libelle_equipement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`id`, `libelle_equipement`) VALUES
(1, 'électricité'),
(2, 'video-projecteur'),
(3, 'rangement'),
(4, 'bureau'),
(5, 'frigo'),
(6, 'ménage inclus');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id` int(11) NOT NULL,
  `id_membre_id` int(11) NOT NULL,
  `id_salle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `indisponible`
--

CREATE TABLE `indisponible` (
  `id` int(11) NOT NULL,
  `id_salle_id` int(11) NOT NULL,
  `id_membre_id` int(11) NOT NULL,
  `jour_indisponible` datetime NOT NULL,
  `statut_indisponible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `indisponible`
--

INSERT INTO `indisponible` (`id`, `id_salle_id`, `id_membre_id`, `jour_indisponible`, `statut_indisponible`) VALUES
(1, 5, 11, '2018-07-01 00:00:00', 1),
(2, 5, 11, '2018-07-07 00:00:00', 1),
(3, 6, 11, '2018-07-09 00:00:00', 1),
(4, 6, 11, '2018-07-13 00:00:00', 1),
(5, 8, 11, '2018-07-15 00:00:00', 1),
(6, 7, 11, '2018-07-20 00:00:00', 1),
(7, 7, 11, '2018-07-21 00:00:00', 1),
(8, 9, 11, '2018-07-23 00:00:00', 1),
(9, 11, 11, '2018-07-06 00:00:00', 1),
(10, 10, 11, '2018-07-16 00:00:00', 1),
(11, 5, 11, '2018-07-06 00:00:00', 1),
(12, 5, 11, '2018-07-08 00:00:00', 1),
(13, 5, 11, '2018-07-15 00:00:00', 1),
(14, 11, 11, '2018-07-18 00:00:00', 1),
(15, 11, 11, '2018-07-09 00:00:00', 1),
(16, 10, 11, '2018-07-06 00:00:00', 1),
(17, 13, 11, '2018-07-07 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `id_statut_membre_id` int(11) NOT NULL,
  `nom_membre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_membre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_de_societe_membre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siret_membre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tva_membre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_de_naissance` datetime NOT NULL,
  `sexe_membre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_membre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp_membre` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville_membre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_membre` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_membre` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_membre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_enregistrement_membre` datetime NOT NULL,
  `info_bancaire_membre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_membre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `id_statut_membre_id`, `nom_membre`, `prenom_membre`, `nom_de_societe_membre`, `siret_membre`, `tva_membre`, `date_de_naissance`, `sexe_membre`, `adresse_membre`, `cp_membre`, `ville_membre`, `telephone_membre`, `email_membre`, `password_membre`, `date_enregistrement_membre`, `info_bancaire_membre`, `photo_membre`, `is_active`, `roles`) VALUES
(11, 2, 'Lisa', 'Lisa', 'Lisa', '1234', 'fr1234', '2020-01-01 00:00:00', 'f', '1 rue des Aires', '34000', 'Montpellier', '0606060606', 'test@test.fr', '$2y$14$ofZIpz02ZD41BHbgN6eomuotD4iZraGFCi2f7xytcSBbc.38Mwq/W', '2018-06-27 19:57:20', 'CB', '04bc4a5d41c6233966784aeaaf2190b3.jpeg', 1, 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(13, 1, 'Toto', 'Toto', 'Toto', '1233', 'FR1234', '2013-01-01 00:00:00', 'f', 'rue du toto', '34000', 'Montpellier', '0909090909', 'toto@toto.fr', '$2y$14$aj9aVZ2jAGIPuwrkNasDKehM3WNKdVwG/Ju8m5q2na.mM/lws2udC', '2018-06-28 12:31:22', 'CB', '904f066624133d210ba6a663c4b92042.png', 1, 'a:1:{i:0;s:9:\"ROLE_USER\";}');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20180625080028'),
('20180627104141'),
('20180627172654'),
('20180627172852'),
('20180627173003'),
('20180627173224');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `id_salle_id` int(11) NOT NULL,
  `lien_photo_default` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lien_photo_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `id_salle_id`, `lien_photo_default`, `lien_photo_details`) VALUES
(2, 6, 'corum.jpg', 'bureau.jpg'),
(3, 7, 'loc.jpg', 'office.jpg'),
(4, 8, 'drop.jpg', 'conference.jpg'),
(6, 5, 'cafe_leon.jpg', 'bureau.jpg'),
(7, 5, 'cafe_leon.jpg', 'reunion.jpg'),
(8, 5, 'cafe_leon.jpg', 'photo.jpg'),
(10, 5, 'cafe_leon.jpg', 'seminaire.jpg'),
(11, 5, 'cafe_leon.jpg', 'office.jpg'),
(12, 5, 'cafe_leon.jpg', 'conference.jpg'),
(13, 6, 'corum.jpg', 'reunion.jpg'),
(14, 6, 'corum.jpg', 'photo.jpg'),
(15, 7, 'seminaire.jpg', 'photo.jpg'),
(16, 9, 'formation.jpg', 'corum.jpg'),
(17, 10, 'reunion.jpg', 'conference.jpg'),
(18, 11, 'photo.jpg', 'conference.jpg'),
(19, 12, 'stockage.jpg', 'conference.jpg'),
(20, 13, 'expositions.jpg', 'photo.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `id_membre_id` int(11) NOT NULL,
  `id_salle_id` int(11) NOT NULL,
  `etat_produit` int(11) NOT NULL,
  `message_produit` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit_indisponible`
--

CREATE TABLE `produit_indisponible` (
  `produit_id` int(11) NOT NULL,
  `indisponible_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `id_membre_id` int(11) NOT NULL,
  `id_categorie_salle_id` int(11) NOT NULL,
  `reference_salle` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_salle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_salle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp_salle` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville_salle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surface_salle` int(11) NOT NULL,
  `description_salle` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nbr_piece_salle` int(11) NOT NULL,
  `capacite_salle` int(11) NOT NULL,
  `prix_salle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `id_membre_id`, `id_categorie_salle_id`, `reference_salle`, `nom_salle`, `adresse_salle`, `cp_salle`, `ville_salle`, `surface_salle`, `description_salle`, `nbr_piece_salle`, `capacite_salle`, `prix_salle`) VALUES
(5, 11, 2, 'Café Léon5507', 'Café Léon', '12 Rue du Plan d\'Agde', '34000', 'Montpellier', 100, 'Lorem Ipsum', 3, 50, 150),
(6, 11, 2, 'Corum7971', 'Corum', 'Place Charles de Gaulle', '34000', 'Montpellier', 2000, 'Lorem Lorem', 50, 10000, 4000),
(7, 11, 2, 'Salle Guillaume de Nogaret5792', 'Salle Guillaume de Nogaret', 'Espace Pitot, Place du Professeur Mirouze,', '34000', 'Montpellier', 50, 'Lorem Ipsum 2', 6, 100, 500),
(8, 11, 6, 'Le Drop621', 'Le Drop', 'Stade Kaufmann Chemin du Pont des Iles', '30000', 'Nîmes', 200, 'Lorem Ipsum description', 3, 150, 450),
(9, 11, 6, 'Keep Cool1335', 'Keep Cool', '659 Route de Jonquières', '84100', 'Orange', 150, 'Description', 6, 250, 400),
(10, 11, 2, 'Opéra, salle Saint Florent6345', 'Opéra, salle Saint Florent', '37-39 Cours Aristide Briand,', '84100', 'Orange', 1000, 'Description', 15, 2000, 1500),
(11, 11, 3, 'Espace de l\'Ouest Lyonnais3497', 'Espace de l\'Ouest Lyonnais', '6 Rue Nicolas Sicard', '69005', 'Lyon', 70, 'Description de la salle', 3, 30, 80),
(12, 11, 1, 'Salle municipale du Tenchadou4', 'Salle municipale du Tenchadou', '1 Quai François Vical', '34250', 'Palavas-les-Flots', 500, 'Description de la salle', 7, 10, 150),
(13, 11, 4, 'Salle Bleue - Salle des Exposi', 'Salle Bleue - Salle des Expositions', 'Avenue de l\'Abbé Brocardi', '34250', 'Palavas-les-Flots', 40, 'Description de la salle des expositions', 1, 7, 40);

-- --------------------------------------------------------

--
-- Structure de la table `salle_equipement`
--

CREATE TABLE `salle_equipement` (
  `salle_id` int(11) NOT NULL,
  `equipement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salle_equipement`
--

INSERT INTO `salle_equipement` (`salle_id`, `equipement_id`) VALUES
(13, 2),
(13, 5);

-- --------------------------------------------------------

--
-- Structure de la table `statut_membre`
--

CREATE TABLE `statut_membre` (
  `id` int(11) NOT NULL,
  `libelle_statut_membre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_membre`
--

INSERT INTO `statut_membre` (`id`, `libelle_statut_membre`) VALUES
(1, 'Locataire'),
(2, 'Locataire / Propriétaire');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis_membre`
--
ALTER TABLE `avis_membre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_417E6F93EAAC4B6D` (`id_membre_id`);

--
-- Index pour la table `avis_salle`
--
ALTER TABLE `avis_salle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_395FFF22EAAC4B6D` (`id_membre_id`),
  ADD KEY `IDX_395FFF228CEBACA0` (`id_salle_id`);

--
-- Index pour la table `categorie_salle`
--
ALTER TABLE `categorie_salle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8933C432EAAC4B6D` (`id_membre_id`),
  ADD KEY `IDX_8933C4328CEBACA0` (`id_salle_id`);

--
-- Index pour la table `indisponible`
--
ALTER TABLE `indisponible`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CBA9A7D8CEBACA0` (`id_salle_id`),
  ADD KEY `IDX_CBA9A7DEAAC4B6D` (`id_membre_id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F6B4FB298B2E28D9` (`email_membre`),
  ADD KEY `IDX_F6B4FB2928BD3759` (`id_statut_membre_id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_14B784188CEBACA0` (`id_salle_id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29A5EC27EAAC4B6D` (`id_membre_id`),
  ADD KEY `IDX_29A5EC278CEBACA0` (`id_salle_id`);

--
-- Index pour la table `produit_indisponible`
--
ALTER TABLE `produit_indisponible`
  ADD PRIMARY KEY (`produit_id`,`indisponible_id`),
  ADD KEY `IDX_E611C500F347EFB` (`produit_id`),
  ADD KEY `IDX_E611C5009A72063D` (`indisponible_id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4E977E5CEAAC4B6D` (`id_membre_id`),
  ADD KEY `IDX_4E977E5C6795B3F0` (`id_categorie_salle_id`);

--
-- Index pour la table `salle_equipement`
--
ALTER TABLE `salle_equipement`
  ADD PRIMARY KEY (`salle_id`,`equipement_id`),
  ADD KEY `IDX_D338336BDC304035` (`salle_id`),
  ADD KEY `IDX_D338336B806F0F5C` (`equipement_id`);

--
-- Index pour la table `statut_membre`
--
ALTER TABLE `statut_membre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis_membre`
--
ALTER TABLE `avis_membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `avis_salle`
--
ALTER TABLE `avis_salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie_salle`
--
ALTER TABLE `categorie_salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `indisponible`
--
ALTER TABLE `indisponible`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `statut_membre`
--
ALTER TABLE `statut_membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis_membre`
--
ALTER TABLE `avis_membre`
  ADD CONSTRAINT `FK_417E6F93EAAC4B6D` FOREIGN KEY (`id_membre_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `avis_salle`
--
ALTER TABLE `avis_salle`
  ADD CONSTRAINT `FK_395FFF228CEBACA0` FOREIGN KEY (`id_salle_id`) REFERENCES `salle` (`id`),
  ADD CONSTRAINT `FK_395FFF22EAAC4B6D` FOREIGN KEY (`id_membre_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `FK_8933C4328CEBACA0` FOREIGN KEY (`id_salle_id`) REFERENCES `salle` (`id`),
  ADD CONSTRAINT `FK_8933C432EAAC4B6D` FOREIGN KEY (`id_membre_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `indisponible`
--
ALTER TABLE `indisponible`
  ADD CONSTRAINT `FK_CBA9A7D8CEBACA0` FOREIGN KEY (`id_salle_id`) REFERENCES `salle` (`id`),
  ADD CONSTRAINT `FK_CBA9A7DEAAC4B6D` FOREIGN KEY (`id_membre_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `FK_F6B4FB2928BD3759` FOREIGN KEY (`id_statut_membre_id`) REFERENCES `statut_membre` (`id`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `FK_14B784188CEBACA0` FOREIGN KEY (`id_salle_id`) REFERENCES `salle` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC278CEBACA0` FOREIGN KEY (`id_salle_id`) REFERENCES `salle` (`id`),
  ADD CONSTRAINT `FK_29A5EC27EAAC4B6D` FOREIGN KEY (`id_membre_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `produit_indisponible`
--
ALTER TABLE `produit_indisponible`
  ADD CONSTRAINT `FK_E611C5009A72063D` FOREIGN KEY (`indisponible_id`) REFERENCES `indisponible` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E611C500F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `FK_4E977E5C6795B3F0` FOREIGN KEY (`id_categorie_salle_id`) REFERENCES `categorie_salle` (`id`),
  ADD CONSTRAINT `FK_4E977E5CEAAC4B6D` FOREIGN KEY (`id_membre_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `salle_equipement`
--
ALTER TABLE `salle_equipement`
  ADD CONSTRAINT `FK_D338336B806F0F5C` FOREIGN KEY (`equipement_id`) REFERENCES `equipement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D338336BDC304035` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
