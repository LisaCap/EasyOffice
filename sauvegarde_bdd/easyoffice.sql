-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 27 juin 2018 à 17:08
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.3

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

--
-- Déchargement des données de la table `categorie_salle`
--

INSERT INTO `categorie_salle` (`id`, `libelle_categorie_salle`) VALUES
(1, 'Stockage'),
(2, 'Séminaire / Conférence');

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`id`, `libelle_equipement`) VALUES
(1, 'Frigo'),
(2, 'Electricité');

--
-- Déchargement des données de la table `indisponible`
--

INSERT INTO `indisponible` (`id`, `id_salle_id`, `id_membre_id`, `jour_indisponible`, `statut_indisponible`) VALUES
(1, 1, 1, '2018-01-01 00:00:00', 1),
(2, 2, 2, '2020-01-01 00:00:00', 1),
(3, 3, 2, '2019-01-01 00:00:00', 1),
(4, 2, 2, '2020-05-06 00:00:00', 1),
(5, 1, 2, '2021-11-10 00:00:00', 1);

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `id_statut_membre_id`, `nom_membre`, `prenom_membre`, `nom_de_societe_membre`, `siret_membre`, `tva_membre`, `date_de_naissance`, `sexe_membre`, `adresse_membre`, `cp_membre`, `ville_membre`, `telephone_membre`, `email_membre`, `password_membre`, `date_enregistrement_membre`, `info_bancaire_membre`, `photo_membre`, `is_active`, `roles`) VALUES
(1, 1, 'admin', 'admin', 'admin', '123', 'fr34123456789', '2013-01-01 00:00:00', 'f', '1000', '34000', 'Montpellier', '0606060606', 'capellelisa@yahoo.fr', '$2y$14$J8iTVLS0EgoWyIvbo6QxSeyCtpf0tdUU0BriYvcrJXaIhdJLR2CNy', '2018-06-20 10:27:42', 'CB', '7238fcc5092a9dd9f6dce06d777c7dfc.jpeg', 1, 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(2, 2, 'test', 'test', 'test', '1234', 'fr34123456789', '2019-01-01 00:00:00', 'h', '1000', '34000', 'Montpellier', '0606060606', 'test@test.fr', '$2y$14$cJP/wm5cPEiM5JCQVF7TFO.itPN2.WWuQVH.eAmU3mQmVKIZtEXDG', '2018-06-20 12:56:51', 'CB', '602559190c667f2ebd76b5115525243e.jpeg', 1, 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(4, 1, 'toto', 'toto', 'toto', '1234', 'fr34123456789', '2013-01-01 00:00:00', 'f', '1000', '34000', 'Montpellier', '0606060606', 'toto@toto.fr', '$2y$14$Skw9X1ekfvF8HZfbloACPODR8uuUOlA0dGEpaFFwz9xHEoOigrKFa', '2018-06-20 14:59:19', 'CB', 'fd6eb194d39be5cfe92b70d36b21bbbc.jpeg', 1, 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(5, 3, 'Titi', 'Titi', 'Titi', '1234', 'fr34123456789', '2015-01-01 00:00:00', 'h', '1000', '34000', 'Montpellier', '0606060606', 'titi@titi.fr', '$2y$14$GbMh7e1JOUKu/vYahv7LjOKkztYYYG6BcirxMkRtt9KKi44js.ogO', '2018-06-21 15:01:39', 'CB', 'bda2619740b91beeaecf13b872ade694.jpeg', 1, 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(6, 3, 'tutu', 'tutu', 'tutu', '1234', 'fr34123456789', '2019-01-01 00:00:00', 'f', '1000', '34000', 'Montpellier', '0606060606', 'tutu@tutu.fr', '$2y$14$7P5CMl1aTXs0mNyZJ5KcuuaC7ibsk0cr8YyZQxzgYQDtKMFGn1hJS', '2018-06-21 16:07:55', 'CB', '1e96c70c889ab459ed3c6729a44a60df.jpeg', 1, 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(7, 2, 'truc', 'truc', 'truc', '123456', 'fr34123456789', '2013-01-01 00:00:00', 'h', '1000', '34000', 'Montpellier', '0606060606', 'truc@truc.fr', '$2y$14$pSWIKJhQc9NZePxF62qrsOjjYRKefQ2c6Cl8.kVq8pKSeUQbHw4TW', '2018-06-22 16:15:57', 'CB', '7c75c8c6969a66ef14ea061c9a9b6ae4.jpeg', 1, 'a:1:{i:0;s:9:\"ROLE_USER\";}');

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20180619150726'),
('20180620081836'),
('20180620103826'),
('20180625080028'),
('20180627104141');

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `id_salle_id`, `lien_photo_default`, `lien_photo_details`) VALUES
(1, 1, 'salle_joubert.jpg', ''),
(2, 2, 'salle_joubert_2.jpg', ''),
(3, 3, 'salle_joubert_3.jpg', ''),
(4, 4, 'salle_joubert_4.jpg', ''),
(5, 5, 'salle_joubert_5.jpg', ''),
(6, 6, 'lorem.jpg', '');

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `id_membre_id`, `id_categorie_salle_id`, `reference_salle`, `nom_salle`, `adresse_salle`, `cp_salle`, `ville_salle`, `surface_salle`, `description_salle`, `nbr_piece_salle`, `capacite_salle`, `prix_salle`) VALUES
(1, 1, 1, '123', 'Toto', '12 Rue du Plan d\'Agde', '34000', 'Montpellier', 40, 'lorem toto', 2, 15, 30),
(2, 5, 2, '12345', 'Joubert', '1744 Avenue Albert Einstein', '34000', 'Montpellier', 40, 'lorem ipsuuuum', 2, 15, 30),
(3, 2, 2, 'Salle 22186', 'Salle 2', '1000', '30000', 'Nimes', 30, 'jrgeo^hbijot', 2, 10, 50),
(4, 4, 1, '12345', 'Noel', '1744 Avenue Albert Einstein', '34000', 'Orange', 40, 'lorem ipsuuuum', 2, 15, 30),
(5, 1, 1, '123', 'Tutu', '12 Rue du Plan d\'Agde', '34000', 'Montpellier', 40, 'lorem', 2, 15, 30),
(6, 2, 1, 'Salle 49467', 'Salle 4', '2000', '30000', 'Nîmes', 100, 'Lorem lorem', 6, 30, 20);

--
-- Déchargement des données de la table `salle_equipement`
--

INSERT INTO `salle_equipement` (`salle_id`, `equipement_id`) VALUES
(3, 1),
(3, 2),
(6, 1),
(6, 2);

--
-- Déchargement des données de la table `statut_membre`
--

INSERT INTO `statut_membre` (`id`, `libelle_statut_membre`) VALUES
(1, 'Locataire'),
(2, 'Propriétaire'),
(3, 'Locataire / Propriétaire');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
