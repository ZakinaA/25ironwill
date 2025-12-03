-- DÉSACTIVATION SÉCURITÉ ET CONFIGURATION
SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

-- ============================================================
-- 1. SUPPRESSION DES TABLES EXISTANTES (NETTOYAGE)
-- ============================================================
DROP TABLE IF EXISTS `paiment`;
DROP TABLE IF EXISTS `inscription`;
DROP TABLE IF EXISTS `contrat_pret`;
DROP TABLE IF EXISTS `intervention`;
DROP TABLE IF EXISTS `tarif_cours`;
DROP TABLE IF EXISTS `tarif`;
DROP TABLE IF EXISTS `responsable_eleve`;
DROP TABLE IF EXISTS `responsable`;
DROP TABLE IF EXISTS `eleve`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `metier_professionnel`;
DROP TABLE IF EXISTS `professionnel`;
DROP TABLE IF EXISTS `professeur_type_instrument`;
DROP TABLE IF EXISTS `professeur`;
DROP TABLE IF EXISTS `cours`;
DROP TABLE IF EXISTS `couleur_instrument`;
DROP TABLE IF EXISTS `accessoire`;
DROP TABLE IF EXISTS `instrument`;
DROP TABLE IF EXISTS `type_instrument`;
DROP TABLE IF EXISTS `type`;
DROP TABLE IF EXISTS `tranche_quotient`;
DROP TABLE IF EXISTS `metier`;
DROP TABLE IF EXISTS `marque`;
DROP TABLE IF EXISTS `jour`;
DROP TABLE IF EXISTS `couleur`;
DROP TABLE IF EXISTS `contact_cours`;
DROP TABLE IF EXISTS `contact`;
DROP TABLE IF EXISTS `classe_instrument`;

-- ============================================================
-- 2. CRÉATION DE LA STRUCTURE (LES TABLES)
-- ============================================================

CREATE TABLE `classe_instrument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `marque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `metier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tranche_quotient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `quotient_min` int(11) NOT NULL,
  `quotient_max` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `professeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `num_rue` int(11) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `copos` int(11) NOT NULL,
  `ville` varchar(70) NOT NULL,
  `tel` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `professionnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `num_rue` int(11) NOT NULL,
  `rue` varchar(50) NOT NULL,
  `copos` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `mail` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `metier_professionnel` (
  `metier_id` int(11) NOT NULL,
  `professionnel_id` int(11) NOT NULL,
  PRIMARY KEY (`metier_id`,`professionnel_id`),
  KEY `IDX_FA14296CED16FA20` (`metier_id`),
  KEY `IDX_FA14296C8A49CC82` (`professionnel_id`),
  CONSTRAINT `FK_FA14296C8A49CC82` FOREIGN KEY (`professionnel_id`) REFERENCES `professionnel` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_FA14296CED16FA20` FOREIGN KEY (`metier_id`) REFERENCES `metier` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `num_rue` int(11) DEFAULT NULL,
  `rue` varchar(255) DEFAULT NULL,
  `copos` int(11) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `responsable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotient_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `num_rue` int(11) NOT NULL,
  `rue` varchar(40) NOT NULL,
  `copos` int(11) NOT NULL,
  `ville` varchar(40) NOT NULL,
  `tel` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_52520D07A76ED395` (`user_id`),
  KEY `IDX_52520D07F2C3D606` (`quotient_id`),
  CONSTRAINT `FK_52520D07A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_52520D07F2C3D606` FOREIGN KEY (`quotient_id`) REFERENCES `tranche_quotient` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `num_rue` int(11) NOT NULL,
  `rue` varchar(30) DEFAULT NULL,
  `copos` int(11) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `tel` int(11) NOT NULL,
  `mail` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_ECA105F7A76ED395` (`user_id`),
  CONSTRAINT `FK_ECA105F7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `responsable_eleve` (
  `responsable_id` int(11) NOT NULL,
  `eleve_id` int(11) NOT NULL,
  PRIMARY KEY (`responsable_id`,`eleve_id`),
  KEY `IDX_8D30209553C59D72` (`responsable_id`),
  KEY `IDX_8D302095A6CC7B2` (`eleve_id`),
  CONSTRAINT `FK_8D30209553C59D72` FOREIGN KEY (`responsable_id`) REFERENCES `responsable` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_8D302095A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `type_instrument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe_instrument_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_21BCBFF8CE879FB1` (`classe_instrument_id`),
  CONSTRAINT `FK_21BCBFF8CE879FB1` FOREIGN KEY (`classe_instrument_id`) REFERENCES `type_instrument` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `instrument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marque_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `num_serie` varchar(255) NOT NULL,
  `date_achat` date NOT NULL,
  `prix_achat` double NOT NULL,
  `utilisation` varchar(50) NOT NULL,
  `chemin_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3CBF69DD4827B9B2` (`marque_id`),
  KEY `IDX_3CBF69DDC54C8C93` (`type_id`),
  CONSTRAINT `FK_3CBF69DD4827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`),
  CONSTRAINT `FK_3CBF69DDC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type_instrument` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `accessoire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instrument_id` int(11) DEFAULT NULL,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8FD026ACF11D9C` (`instrument_id`),
  CONSTRAINT `FK_8FD026ACF11D9C` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `couleur_instrument` (
  `couleur_id` int(11) NOT NULL,
  `instrument_id` int(11) NOT NULL,
  PRIMARY KEY (`couleur_id`,`instrument_id`),
  KEY `IDX_2E62255DC31BA576` (`couleur_id`),
  KEY `IDX_2E62255DCF11D9C` (`instrument_id`),
  CONSTRAINT `FK_2E62255DC31BA576` FOREIGN KEY (`couleur_id`) REFERENCES `couleur` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2E62255DCF11D9C` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `type_instrument_id` int(11) DEFAULT NULL,
  `professeur_id` int(11) DEFAULT NULL,
  `jour_id` int(11) DEFAULT NULL,
  `libelle` varchar(128) NOT NULL,
  `age_mini` int(11) NOT NULL,
  `heure_debut` datetime NOT NULL,
  `heure_fin` time NOT NULL,
  `nb_places` int(11) NOT NULL,
  `age_maxi` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FDCA8C9CC54C8C93` (`type_id`),
  KEY `IDX_FDCA8C9C7C1CAAA9` (`type_instrument_id`),
  KEY `IDX_FDCA8C9CBAB22EE9` (`professeur_id`),
  KEY `IDX_FDCA8C9C220C6AD0` (`jour_id`),
  CONSTRAINT `FK_FDCA8C9C220C6AD0` FOREIGN KEY (`jour_id`) REFERENCES `jour` (`id`),
  CONSTRAINT `FK_FDCA8C9C7C1CAAA9` FOREIGN KEY (`type_instrument_id`) REFERENCES `type_instrument` (`id`),
  CONSTRAINT `FK_FDCA8C9CBAB22EE9` FOREIGN KEY (`professeur_id`) REFERENCES `professeur` (`id`),
  CONSTRAINT `FK_FDCA8C9CC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `professeur_type_instrument` (
  `professeur_id` int(11) NOT NULL,
  `type_instrument_id` int(11) NOT NULL,
  PRIMARY KEY (`professeur_id`,`type_instrument_id`),
  KEY `IDX_1E1989D6BAB22EE9` (`professeur_id`),
  KEY `IDX_1E1989D67C1CAAA9` (`type_instrument_id`),
  CONSTRAINT `FK_1E1989D67C1CAAA9` FOREIGN KEY (`type_instrument_id`) REFERENCES `type_instrument` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1E1989D6BAB22EE9` FOREIGN KEY (`professeur_id`) REFERENCES `professeur` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contact_cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(4096) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tarif_cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tranche_quotient_id_id` int(11) DEFAULT NULL,
  `cours_id_id` int(11) DEFAULT NULL,
  `prix_facture` decimal(20,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_24FE176C1FCAE54` (`tranche_quotient_id_id`),
  KEY `IDX_24FE176C4F221781` (`cours_id_id`),
  CONSTRAINT `FK_24FE176C1FCAE54` FOREIGN KEY (`tranche_quotient_id_id`) REFERENCES `tranche_quotient` (`id`),
  CONSTRAINT `FK_24FE176C4F221781` FOREIGN KEY (`cours_id_id`) REFERENCES `type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `intervention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `professionnel_id` int(11) DEFAULT NULL,
  `instrument_id` int(11) DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` double NOT NULL,
  `quotite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D11814AB8A49CC82` (`professionnel_id`),
  KEY `IDX_D11814ABCF11D9C` (`instrument_id`),
  CONSTRAINT `FK_D11814AB8A49CC82` FOREIGN KEY (`professionnel_id`) REFERENCES `professionnel` (`id`),
  CONSTRAINT `FK_D11814ABCF11D9C` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contrat_pret` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eleve_id` int(11) DEFAULT NULL,
  `instrument_id` int(11) DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `attestation_assurance` varchar(255) NOT NULL,
  `etat_detaille_debut` varchar(50) NOT NULL,
  `etat_detaille_retour` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1FB84C67A6CC7B2` (`eleve_id`),
  KEY `IDX_1FB84C67CF11D9C` (`instrument_id`),
  CONSTRAINT `FK_1FB84C67A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  CONSTRAINT `FK_1FB84C67CF11D9C` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `inscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `eleve_id` int(11) DEFAULT NULL,
  `date_inscription` date NOT NULL,
  `montant_du` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E90F6D67ECF78B0` (`cours_id`),
  KEY `IDX_5E90F6D6A6CC7B2` (`eleve_id`),
  CONSTRAINT `FK_5E90F6D67ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  CONSTRAINT `FK_5E90F6D6A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `paiment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inscription_id` int(11) DEFAULT NULL,
  `eleve_id` int(11) DEFAULT NULL,
  `quotient_id` int(11) DEFAULT NULL,
  `montant` double NOT NULL,
  `date_paiment` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DC8138F5DAC5993` (`inscription_id`),
  KEY `IDX_DC8138FA6CC7B2` (`eleve_id`),
  KEY `IDX_DC8138FF2C3D606` (`quotient_id`),
  CONSTRAINT `FK_DC8138F5DAC5993` FOREIGN KEY (`inscription_id`) REFERENCES `inscription` (`id`),
  CONSTRAINT `FK_DC8138FA6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  CONSTRAINT `FK_DC8138FF2C3D606` FOREIGN KEY (`quotient_id`) REFERENCES `tranche_quotient` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 3. INSERTION DES DONNÉES (MASSIF + INITIAL)
-- ============================================================

INSERT INTO `classe_instrument` (`id`, `libelle`) VALUES
(1, 'Vents'), (2, 'Cordes'), (3, 'Percussions'), (4, 'Claviers');

INSERT INTO `couleur` (`id`, `nom`) VALUES
(1, 'Noir laqué'), (2, 'Bois naturel'), (3, 'Argenté'), (4, 'Rouge vif');

INSERT INTO `jour` (`id`, `libelle`) VALUES
(1, 'Lundi'), (2, 'Mardi'), (3, 'Mercredi'), (4, 'Jeudi'), (5, 'Vendredi'), (6, 'Samedi');

INSERT INTO `marque` (`id`, `libelle`) VALUES
(1, 'Yamaha'), (2, 'Fender'), (3, 'Gibson'), (4, 'Roland'), (5, 'Selmer');

INSERT INTO `metier` (`id`, `libelle`) VALUES
(1, 'Luthier'), (2, 'Accordeur'), (3, 'Réparateur instruments à vent');

INSERT INTO `tranche_quotient` (`id`, `libelle`, `quotient_min`, `quotient_max`) VALUES
(1, '0 à 250', 0, 250), (2, '251 à 425', 251, 425), (3, '426 à 680', 426, 680),
(4, '681 à 935', 681, 935), (5, '936 à 1800', 936, 1800), (6, '1801 et supérieur', 1801, 999999);

INSERT INTO `type` (`id`, `nom`) VALUES (1, 'Collectif'), (2, 'Individuel');

INSERT INTO `professeur` (`id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 'Dupont', 'Jean-Pierre', 15, 'Rue des Arts', 75001, 'Paris', 611223344, 'jp.dupont@emusic.com'),
(2, 'Durant', 'Marie', 22, 'Boulevard de la Musique', 69002, 'Lyon', 622334455, 'm.durant@emusic.com'),
(3, 'Petit', 'Luc', 8, 'Avenue Mozart', 13001, 'Marseille', 633445566, 'l.petit@emusic.com');

INSERT INTO `professionnel` (`id`, `nom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 'Lutherie & Co', 12, 'Rue des Luthiers', 75005, 'Paris', '0145678901', 'contact@lutherieco.com'),
(2, 'Piano Service', 30, 'Avenue des Claviers', 69003, 'Lyon', '0478901234', 'info@pianoservice.fr'),
(3, 'Vent-Debout', 5, 'Place du Mistral', 13002, 'Marseille', '0491234567', 'reparation@ventdebout.com');

INSERT INTO `metier_professionnel` (`metier_id`, `professionnel_id`) VALUES
(1, 1), (2, 2), (3, 3);

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`) VALUES
(1, 'admin@emusic.com', '["ROLE_ADMIN"]', '$2y$13$yourhashedpassword', 'Admin', 'Root', 1, 'Rue de l\'Admin', 75000, 'Paris', 101010101),
(2, 'parent.durand@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Durand', 'Paul', 10, 'Rue de la Gare', 75010, 'Paris', 612345678),
(3, 'parent.martin@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Martin', 'Sophie', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789),
(4, 'eleve.durand@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Durand', 'Leo', 10, 'Rue de la Gare', 75010, 'Paris', 612345678),
(5, 'eleve.martin@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Martin', 'Clara', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789),
(6, 'parent.petit@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Petit', 'Marc', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890),
(7, 'eleve.petit@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Petit', 'Lucie', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890),
(8, 'adm@gmail.com', '["ROLE_ADMIN"]', '$2y$13$TkX3x0K7MiG.zX.dAvsZiOmWeNx2kkK9i0TI7zy2UwOHkplN5lI1S', 'sdfsdf', 'sdfsdf', 12, 'rue de pierre ', 78500, 'villepaint', 850505055),
(9, 'cam@gmail.com', '["ROLE_ELEVE"]', '$2y$13$acvRTCgkZ/kNSfGbDChswetf53d2bjSwNVXdqBtqEJFn2Zcec64gi', 'Cam', 'mi', 14, 'rue des lilas', 61250, 'conde sur sarthe ', 761704334),
(10, 'Pierre@gmail.com', '["ROLE_RESPONSABLE"]', '$2y$13$yourhashedpassword', 'Pierre', 'Pierre', 14, 'rue des lilas', 61250, 'Conde ', 461704334),
(11, '1@gmail.com', '["ROLE_ADMIN"]', '$2y$13$yourhashedpassword', '1', '1', NULL, NULL, NULL, NULL, NULL),
(12, 'claude@gmail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Jean', 'Claude', NULL, NULL, NULL, NULL, NULL),
(13, 'Jean@gmail.com', '["ROLE_RESPONSABLE"]', '$2y$13$yourhashedpassword', 'Jean', 'Dominique', NULL, NULL, NULL, NULL, NULL),
(30, 'parent.dupuis@mail.com', '["ROLE_RESPONSABLE"]', '$2y$13$yourhashedpassword', 'Dupuis', 'Michel', 10, 'Rue des Fleurs', 14000, 'Caen', 601010101),
(31, 'eleve.dupuis1@mail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Dupuis', 'Léa', 10, 'Rue des Fleurs', 14000, 'Caen', 601010101),
(32, 'eleve.dupuis2@mail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Dupuis', 'Théo', 10, 'Rue des Fleurs', 14000, 'Caen', 601010101),
(33, 'parent.leroy@mail.com', '["ROLE_RESPONSABLE"]', '$2y$13$yourhashedpassword', 'Leroy', 'Isabelle', 5, 'Av. de la Côte', 14500, 'Ouistreham', 602020202),
(34, 'eleve.leroy1@mail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Leroy', 'Arthur', 5, 'Av. de la Côte', 14500, 'Ouistreham', 602020202),
(35, 'parent.morel@mail.com', '["ROLE_RESPONSABLE"]', '$2y$13$yourhashedpassword', 'Morel', 'Julien', 12, 'Bd Maréchal', 14000, 'Caen', 603030303),
(36, 'eleve.morel1@mail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Morel', 'Chloé', 12, 'Bd Maréchal', 14000, 'Caen', 603030303),
(37, 'eleve.morel2@mail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Morel', 'Maxime', 12, 'Bd Maréchal', 14000, 'Caen', 603030303),
(38, 'parent.fournier@mail.com', '["ROLE_RESPONSABLE"]', '$2y$13$yourhashedpassword', 'Fournier', 'Sarah', 88, 'Rue Verte', 14200, 'Hérouville', 604040404),
(39, 'eleve.fournier1@mail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Fournier', 'Zoé', 88, 'Rue Verte', 14200, 'Hérouville', 604040404),
(40, 'parent.girard@mail.com', '["ROLE_RESPONSABLE"]', '$2y$13$yourhashedpassword', 'Girard', 'Alain', 3, 'Impasse Bleue', 14000, 'Caen', 605050505),
(41, 'eleve.girard1@mail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Girard', 'Paul', 3, 'Impasse Bleue', 14000, 'Caen', 605050505),
(42, 'eleve.girard2@mail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Girard', 'Alice', 3, 'Impasse Bleue', 14000, 'Caen', 605050505),
(43, 'parent.rousseau@mail.com', '["ROLE_RESPONSABLE"]', '$2y$13$yourhashedpassword', 'Rousseau', 'Claire', 45, 'Rue St Jean', 14000, 'Caen', 606060606),
(44, 'eleve.rousseau1@mail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Rousseau', 'Hugo', 45, 'Rue St Jean', 14000, 'Caen', 606060606),
(45, 'parent.blanc@mail.com', '["ROLE_RESPONSABLE"]', '$2y$13$yourhashedpassword', 'Blanc', 'Eric', 2, 'Rue du Port', 14000, 'Caen', 607070707),
(46, 'eleve.blanc1@mail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Blanc', 'Nathan', 2, 'Rue du Port', 14000, 'Caen', 607070707),
(47, 'parent.garnier@mail.com', '["ROLE_RESPONSABLE"]', '$2y$13$yourhashedpassword', 'Garnier', 'Sophie', 77, 'Av. Paix', 14200, 'Hérouville', 608080808),
(48, 'eleve.garnier1@mail.com', '["ROLE_ELEVE"]', '$2y$13$yourhashedpassword', 'Garnier', 'Jules', 77, 'Av. Paix', 14200, 'Hérouville', 608080808);

INSERT INTO `responsable` (`id`, `quotient_id`, `user_id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 3, 2, 'Durand', 'Paul', 10, 'Rue de la Gare', 75010, 'Paris', 612345678, 'parent.durand@example.com'),
(2, 5, 3, 'Martin', 'Sophie', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789, 'parent.martin@example.com'),
(3, 1, 6, 'Petit', 'Marc', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890, 'parent.petit@example.com'),
(4, 2, 9, 'Cam', 'mi', 14, 'rue des lilas', 61250, 'conde sur sarthe', 761704334, 'cam@gmail.com'),
(5, 4, 10, 'Pierre', 'Pierre', 14, 'rue des lilas', 61250, 'Conde ', 461704334, 'Pierre@gmail.com'),
(6, 2, 13, 'Jean', 'Dominique', 45, 'rue des lilas', 14000, 'caen', 608521522, 'Jean@gmail.com'),
(20, 1, 30, 'Dupuis', 'Michel', 10, 'Rue des Fleurs', 14000, 'Caen', 601010101, 'parent.dupuis@mail.com'),
(21, 6, 33, 'Leroy', 'Isabelle', 5, 'Av. de la Côte', 14500, 'Ouistreham', 602020202, 'parent.leroy@mail.com'),
(22, 3, 35, 'Morel', 'Julien', 12, 'Bd Maréchal', 14000, 'Caen', 603030303, 'parent.morel@mail.com'),
(23, 2, 38, 'Fournier', 'Sarah', 88, 'Rue Verte', 14200, 'Hérouville', 604040404, 'parent.fournier@mail.com'),
(24, 5, 40, 'Girard', 'Alain', 3, 'Impasse Bleue', 14000, 'Caen', 605050505, 'parent.girard@mail.com'),
(25, 4, 43, 'Rousseau', 'Claire', 45, 'Rue St Jean', 14000, 'Caen', 606060606, 'parent.rousseau@mail.com'),
(26, 1, 45, 'Blanc', 'Eric', 2, 'Rue du Port', 14000, 'Caen', 607070707, 'parent.blanc@mail.com'),
(27, 6, 47, 'Garnier', 'Sophie', 77, 'Av. Paix', 14200, 'Hérouville', 608080808, 'parent.garnier@mail.com');

INSERT INTO `eleve` (`id`, `user_id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 4, 'Durand', 'Léo', 10, 'Rue de la Gare', 75010, 'Paris', 612345678, 'leo.durand@example.com'),
(2, 5, 'Martin', 'Clara', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789, 'clara.martin@example.com'),
(3, 7, 'Petit', 'Lucie', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890, 'lucie.petit@example.com'),
(4, 8, 'sdfsdf', 'sdfsdf', 12, 'rue de pierre ', 78500, 'villepaint', 850505055, 'adm@gmail.com'),
(5, 11, '1', '1', 14, 'rue', 14444, 'caen', 608789544, '1@gmail.com'),
(6, 12, 'Jean', 'Claude', 45, 'rue des lilas', 45646, 'Caen', 685956242, 'claude@gmail.com'),
(20, 31, 'Dupuis', 'Léa', 10, 'Rue des Fleurs', 14000, 'Caen', 601010101, 'eleve.dupuis1@mail.com'),
(21, 32, 'Dupuis', 'Théo', 10, 'Rue des Fleurs', 14000, 'Caen', 601010101, 'eleve.dupuis2@mail.com'),
(22, 34, 'Leroy', 'Arthur', 5, 'Av. de la Côte', 14500, 'Ouistreham', 602020202, 'eleve.leroy1@mail.com'),
(23, 36, 'Morel', 'Chloé', 12, 'Bd Maréchal', 14000, 'Caen', 603030303, 'eleve.morel1@mail.com'),
(24, 37, 'Morel', 'Maxime', 12, 'Bd Maréchal', 14000, 'Caen', 603030303, 'eleve.morel2@mail.com'),
(25, 39, 'Fournier', 'Zoé', 88, 'Rue Verte', 14200, 'Hérouville', 604040404, 'eleve.fournier1@mail.com'),
(26, 41, 'Girard', 'Paul', 3, 'Impasse Bleue', 14000, 'Caen', 605050505, 'eleve.girard1@mail.com'),
(27, 42, 'Girard', 'Alice', 3, 'Impasse Bleue', 14000, 'Caen', 605050505, 'eleve.girard2@mail.com'),
(28, 44, 'Rousseau', 'Hugo', 45, 'Rue St Jean', 14000, 'Caen', 606060606, 'eleve.rousseau1@mail.com'),
(29, 46, 'Blanc', 'Nathan', 2, 'Rue du Port', 14000, 'Caen', 607070707, 'eleve.blanc1@mail.com'),
(30, 48, 'Garnier', 'Jules', 77, 'Av. Paix', 14200, 'Hérouville', 608080808, 'eleve.garnier1@mail.com');

INSERT INTO `responsable_eleve` (`responsable_id`, `eleve_id`) VALUES
(1, 1), (2, 2), (2, 5), (3, 3), (6, 6),
(20, 20), (20, 21), (21, 22), (22, 23), (22, 24),
(23, 25), (24, 26), (24, 27), (25, 28), (26, 29), (27, 30);

INSERT INTO `type_instrument` (`id`, `classe_instrument_id`, `libelle`) VALUES
(1, 4, 'Piano'), (2, 2, 'Guitare Classique'), (3, 2, 'Violon'),
(4, 1, 'Flûte traversière'), (5, 1, 'Saxophone'), (6, 3, 'Batterie'),
(7, 2, 'Guitare Électrique');

INSERT INTO `instrument` (`id`, `marque_id`, `type_id`, `num_serie`, `date_achat`, `prix_achat`, `utilisation`, `chemin_image`) VALUES
(1, 1, 1, '1234568888', '2026-05-10', 1200, 'École', 'piano_yamaha_1.jpg'),
(2, 2, 7, '789012', '2021-09-15', 800, 'Prêt', 'fender_strat_1.jpg'),
(3, 5, 5, '345678', '2019-02-20', 2500, 'École', 'selmer_saxo_1.jpg'),
(4, 1, 3, '901234', '2022-01-30', 450, 'Prêt', 'yamaha_violon_1.jpg'),
(5, 4, 6, '567890', '2021-11-05', 1500, 'École', 'roland_td17_1.jpg'),
(6, 1, 4, 'gtregegegegergegegrerge', '6666-06-06', 5555454455454, 'Cours', '692db98de8ef4.png'),
(10, 3, 7, 'GIB-SG-2022', '2022-06-15', 1400, 'Cours', 'gibson_sg.jpg'),
(11, 1, 6, 'YAM-DRUM-55', '2023-01-20', 800, 'École', 'yamaha_stage_custom.jpg'),
(12, 5, 5, 'SELMER-SAX-88', '2020-11-10', 2100, 'Prêt', 'selmer_alto.jpg');

INSERT INTO `accessoire` (`id`, `instrument_id`, `libelle`) VALUES
(1, 1, 'Banquette de piano'), (2, 2, 'Housse de guitare'), (3, 2, 'Jeu de cordes de rechange'),
(4, 3, 'Bec de saxophone'), (5, 3, 'Boîte d\'anches'), (6, 5, 'Paire de baguettes');

INSERT INTO `couleur_instrument` (`couleur_id`, `instrument_id`) VALUES
(1, 1), (2, 4), (3, 3), (4, 2);

INSERT INTO `cours` (`id`, `type_id`, `type_instrument_id`, `professeur_id`, `jour_id`, `libelle`, `age_mini`, `heure_debut`, `heure_fin`, `nb_places`, `age_maxi`) VALUES
(1, 2, 1, 1, 1, 'Piano Individuel ', 7, '2025-11-17 14:00:00', '15:00:00', 1, 99),
(2, 1, 2, 2, 2, 'Guitare Collectif Ados', 12, '2025-11-18 17:00:00', '18:00:00', 8, 17),
(3, 1, 6, 3, 3, 'Atelier Batterie', 10, '2025-11-19 16:00:00', '17:30:00', 5, 15),
(4, 2, 4, 3, 5, 'Flûte Individuel ', 8, '2025-11-21 11:00:00', '12:00:00', 1, 99),
(10, 1, 7, 2, 3, 'Groupe Rock (Guitare Élec)', 14, '2025-11-19 18:00:00', '19:30:00', 5, 20),
(11, 2, 6, 3, 6, 'Batterie Débutant', 7, '2025-11-22 10:00:00', '10:30:00', 1, 99),
(12, 1, 5, 3, 4, 'Ensemble Saxophones', 10, '2025-11-20 17:30:00', '19:00:00', 10, 70);

INSERT INTO `professeur_type_instrument` (`professeur_id`, `type_instrument_id`) VALUES
(1, 1), (2, 2), (2, 7), (3, 4), (3, 5), (3, 6);

INSERT INTO `contact` (`id`, `nom`, `email`, `message`) VALUES
(1, 'Julien Leblanc', 'j.leblanc@email.com', 'Bonjour, proposez-vous des cours de ukulélé ?'),
(2, 'Alice Moreau', 'a.moreau@email.com', 'Quels sont les tarifs pour les cours de piano individuels ?');

INSERT INTO `contact_cours` (`id`, `nom`, `email`, `message`) VALUES
(6, 'Camille Noel', 'fjfgjjfg@gmail.com', 'Bonjour je vous contact car je voudrais faire parti de cours de violon le lundi a 18h j\'attend votre retour bien a vous.'),
(7, 'Jean Claud', 'claud@gmail.com', 'Bonjour je voudrais m\'inscrire en cours de guitare j\'attend votre rejour cordialement.');

INSERT INTO `tarif_cours` (`id`, `tranche_quotient_id_id`, `cours_id_id`, `prix_facture`) VALUES
(1, NULL, 2, 417), (2, NULL, 1, 209), (3, 1, 2, 60), (4, 1, 1, 30),
(5, 2, 2, 96), (6, 2, 1, 48), (7, 3, 2, 126), (8, 3, 1, 63),
(9, 4, 2, 192), (10, 4, 1, 96), (11, 5, 2, 282), (12, 5, 1, 141),
(13, 6, 2, 330), (14, 6, 1, 165);

INSERT INTO `intervention` (`id`, `professionnel_id`, `instrument_id`, `date_debut`, `date_fin`, `description`, `prix`, `quotite`) VALUES
(1, 2, 1, '2025-09-01', '2025-09-01', 'Accordage annuel piano salle 1', 120, 100),
(2, 1, 4, '2025-10-15', '2025-10-17', 'Réglage chevalet violon prêt n°4', 75, 100),
(3, 3, 3, '2025-11-03', '2025-11-05', 'Remplacement tampons saxophone Selmer', 180, 100),
(10, 1, 10, '2025-08-20', '2025-08-25', 'Réglage manche Gibson', 50, 100);

INSERT INTO `contrat_pret` (`id`, `eleve_id`, `instrument_id`, `date_debut`, `date_fin`, `attestation_assurance`, `etat_detaille_debut`, `etat_detaille_retour`) VALUES
(1, 2, 2, '2025-09-10', '2026-06-25', 'assurance_martin_2025.pdf', 'Neuf', 'TBD'),
(2, 3, 4, '2025-09-12', '2026-06-25', 'assurance_petit_2025.pdf', 'Bon état, légère éraflure', 'TBD'),
(3, 2, 3, '2025-11-26', '2025-11-28', '473545115-612846651145561-1294806717506769151-n-6926ca909aa15.jpg', 'Neuf', 'TBD'),
(4, 2, 3, '2025-11-26', '2025-11-29', '473545115-612846651145561-1294806717506769151-n-6926cad78db99.jpg', 'Neufsdd', 'TBD'),
(5, 1, 1, '2025-11-26', '2026-11-25', 'B3-TD01-DWVA-Session2-6926cd8dbbf74.pdf', 'Sans defaut majeur', 'TBD'),
(10, 20, 12, '2025-09-15', '2026-06-30', 'assurance_bernard_saxo.pdf', 'Excellent état', 'TBD');

INSERT INTO `inscription` (`id`, `cours_id`, `eleve_id`, `date_inscription`, `montant_du`) VALUES
(1, 2, 1, '2025-09-02', NULL), (18, 1, 4, '2025-11-24', NULL), (19, 2, 4, '2025-11-24', NULL),
(20, 4, 4, '2025-11-24', NULL), (21, 1, 1, '2025-11-24', NULL), (22, 2, 1, '2025-11-24', NULL),
(23, 3, 1, '2025-11-24', NULL), (24, 4, 1, '2025-11-24', NULL), (25, 1, 1, '2025-11-24', NULL),
(26, 3, 1, '2025-11-24', NULL), (27, 1, 3, '2025-11-24', NULL), (28, 2, 3, '2025-11-24', NULL),
(29, 4, 3, '2025-11-24', NULL), (30, 1, 2, '2025-12-01', NULL), (31, 2, 2, '2025-12-01', NULL),
(32, 3, 2, '2025-12-01', NULL), (33, 4, 2, '2025-12-01', NULL), (34, 1, 3, '2025-12-03', NULL),
(35, 2, 3, '2025-12-03', NULL), (36, 3, 3, '2025-12-03', NULL), (37, 4, 3, '2025-12-03', NULL),
(38, 1, 5, '2025-12-03', NULL), (39, 2, 6, '2025-12-03', NULL),
(50, 1, 20, '2025-09-01', NULL), (51, 2, 21, '2025-09-01', NULL), (52, 4, 22, '2025-09-02', NULL),
(53, 3, 23, '2025-09-03', NULL), (54, 1, 24, '2025-09-03', NULL), (55, 2, 25, '2025-09-04', NULL),
(56, 4, 26, '2025-09-05', NULL), (57, 1, 27, '2025-09-05', NULL), (58, 3, 28, '2025-09-06', NULL),
(59, 2, 29, '2025-09-07', NULL), (60, 1, 30, '2025-09-08', NULL);

INSERT INTO `paiment` (`id`, `inscription_id`, `eleve_id`, `quotient_id`, `montant`, `date_paiment`) VALUES
(1, 18, 4, 2, 96, '2025-11-24'), (2, 31, 4, 2, 48, '2025-11-24'), (3, 20, 4, 2, 96, '2025-11-24'),
(4, 21, 1, 3, 126, '2025-11-24'), (5, 22, 1, 3, 63, '2025-11-24'), (6, 23, 1, 3, 63, '2025-11-24'),
(7, 24, 1, 3, 126, '2025-11-24'), (8, 25, 1, 3, 126, '2025-11-24'), (9, 26, 1, 3, 63, '2025-11-24'),
(10, 27, 3, 1, 60, '2025-11-24'), (11, 28, 3, 1, 30, '2025-11-24'), (12, 29, 3, 1, 60, '2025-11-24'),
(13, 30, 2, 5, 282, '2025-12-01'), (14, 31, 2, 5, 141, '2025-12-01'), (15, 32, 2, 5, 141, '2025-12-01'),
(16, 33, 2, 5, 282, '2025-12-01'), (17, 34, 3, 1, 60, '2025-12-03'), (18, 35, 3, 1, 30, '2025-12-03'),
(19, 36, 3, 1, 30, '2025-12-03'), (20, 37, 3, 1, 60, '2025-12-03'), (21, 38, 5, 5, 282, '2025-12-03'),
(22, 39, 6, NULL, 0, '2025-12-03'), (23, 39, 6, NULL, 280, '2020-01-01'),
(24, 18, 4, 2, 96, '2026-01-05'), (25, 20, 4, 2, 96, '2026-01-05'), (26, 31, 4, 2, 48, '2026-01-15'),
(27, 21, 1, 3, 126, '2026-01-10'), (28, 22, 1, 3, 63, '2026-02-10'), (29, 23, 1, 3, 63, '2026-02-10'),
(30, 24, 1, 3, 126, '2026-03-05'), (31, 25, 1, 3, 126, '2026-01-24'), (32, 26, 1, 3, 63, '2026-01-24'),
(33, 27, 3, 1, 60, '2026-01-03'), (34, 28, 3, 1, 30, '2026-02-03'), (35, 29, 3, 1, 60, '2026-03-03'),
(36, 34, 3, 1, 60, '2026-01-15'), (37, 35, 3, 1, 30, '2026-02-15'), (38, 36, 3, 1, 30, '2026-02-15'),
(39, 37, 3, 1, 60, '2026-03-15'), (40, 30, 2, 5, 282, '2026-01-01'), (41, 31, 2, 5, 141, '2026-01-01'),
(42, 32, 2, 5, 141, '2026-02-01'), (43, 33, 2, 5, 282, '2026-02-01'), (44, 18, 4, 2, 96, '2025-10-15'),
(45, 21, 1, 3, 126, '2025-10-20'), (46, 38, 5, 5, 282, '2026-01-10'), (47, 38, 5, 5, 141, '2026-02-10'),
(48, 38, 5, 5, 141, '2026-03-10'), (49, 39, 6, NULL, 50, '2025-12-20'), (50, 39, 6, NULL, 50, '2026-01-20'),
(100, 50, 20, 1, 30, '2025-10-01'), (101, 50, 20, 1, 30, '2025-11-01'), (102, 51, 21, 1, 30, '2025-10-01'),
(103, 52, 22, 6, 110, '2025-09-15'), (104, 52, 22, 6, 110, '2025-10-15'), (105, 52, 22, 6, 110, '2025-11-15'),
(106, 53, 23, 3, 63, '2025-09-20'), (107, 54, 24, 3, 63, '2025-09-20'), (108, 54, 24, 3, 63, '2025-10-20'),
(109, 55, 25, 2, 24, '2025-10-05'), (110, 55, 25, 2, 24, '2025-11-05'), (111, 56, 26, 5, 141, '2025-09-10'),
(112, 56, 26, 5, 141, '2025-10-10'), (113, 57, 27, 5, 141, '2025-09-10'), (114, 57, 27, 5, 141, '2025-10-10'),
(115, 58, 28, 4, 32, '2025-10-02'), (116, 58, 28, 4, 32, '2025-11-02'), (117, 58, 28, 4, 32, '2025-12-02'),
(118, 59, 29, 1, 15, '2025-10-05'), (119, 59, 29, 1, 15, '2025-11-05'), (120, 60, 30, 6, 165, '2025-09-15'),
(121, 60, 30, 6, 165, '2025-10-15');

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;