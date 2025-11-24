-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : lun. 24 nov. 2025 à 12:26
-- Version du serveur : 11.3.2-MariaDB
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `emusic`
--

-- --------------------------------------------------------

--
-- Structure de la table `accessoire`
--

DROP TABLE IF EXISTS `accessoire`;
CREATE TABLE IF NOT EXISTS `accessoire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instrument_id` int(11) DEFAULT NULL,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8FD026ACF11D9C` (`instrument_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `accessoire`
--

INSERT INTO `accessoire` (`id`, `instrument_id`, `libelle`) VALUES
(1, 1, 'Banquette de piano'),
(2, 2, 'Housse de guitare'),
(3, 2, 'Jeu de cordes de rechange'),
(4, 3, 'Bec de saxophone'),
(5, 3, 'Boîte d\'anches'),
(6, 5, 'Paire de baguettes');

-- --------------------------------------------------------

--
-- Structure de la table `classe_instrument`
--

DROP TABLE IF EXISTS `classe_instrument`;
CREATE TABLE IF NOT EXISTS `classe_instrument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `classe_instrument`
--

INSERT INTO `classe_instrument` (`id`, `libelle`) VALUES
(1, 'Vents'),
(2, 'Cordes'),
(3, 'Percussions'),
(4, 'Claviers');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `email`, `message`) VALUES
(1, 'Julien Leblanc', 'j.leblanc@email.com', 'Bonjour, proposez-vous des cours de ukulélé ?'),
(2, 'Alice Moreau', 'a.moreau@email.com', 'Quels sont les tarifs pour les cours de piano individuels ?');

-- --------------------------------------------------------

--
-- Structure de la table `contrat_pret`
--

DROP TABLE IF EXISTS `contrat_pret`;
CREATE TABLE IF NOT EXISTS `contrat_pret` (
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
  KEY `IDX_1FB84C67CF11D9C` (`instrument_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrat_pret`
--

INSERT INTO `contrat_pret` (`id`, `eleve_id`, `instrument_id`, `date_debut`, `date_fin`, `attestation_assurance`, `etat_detaille_debut`, `etat_detaille_retour`) VALUES
(1, 2, 2, '2025-09-10', '2026-06-25', 'assurance_martin_2025.pdf', 'Neuf', 'TBD'),
(2, 3, 4, '2025-09-12', '2026-06-25', 'assurance_petit_2025.pdf', 'Bon état, légère éraflure', 'TBD');

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`id`, `nom`) VALUES
(1, 'Noir laqué'),
(2, 'Bois naturel'),
(3, 'Argenté'),
(4, 'Rouge vif');

-- --------------------------------------------------------

--
-- Structure de la table `couleur_instrument`
--

DROP TABLE IF EXISTS `couleur_instrument`;
CREATE TABLE IF NOT EXISTS `couleur_instrument` (
  `couleur_id` int(11) NOT NULL,
  `instrument_id` int(11) NOT NULL,
  PRIMARY KEY (`couleur_id`,`instrument_id`),
  KEY `IDX_2E62255DC31BA576` (`couleur_id`),
  KEY `IDX_2E62255DCF11D9C` (`instrument_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `couleur_instrument`
--

INSERT INTO `couleur_instrument` (`couleur_id`, `instrument_id`) VALUES
(1, 1),
(2, 4),
(3, 3),
(4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
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
  KEY `IDX_FDCA8C9C220C6AD0` (`jour_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `type_id`, `type_instrument_id`, `professeur_id`, `jour_id`, `libelle`, `age_mini`, `heure_debut`, `heure_fin`, `nb_places`, `age_maxi`) VALUES
(1, 2, 1, 1, 1, 'Piano Individuel Lundi', 7, '2025-11-17 14:00:00', '15:00:00', 1, 99),
(2, 1, 2, 2, 2, 'Guitare Collectif Ados', 12, '2025-11-18 17:00:00', '18:00:00', 8, 17),
(3, 1, 6, 3, 3, 'Atelier Batterie', 10, '2025-11-19 16:00:00', '17:30:00', 5, 15),
(4, 2, 4, 3, 5, 'Flûte Individuel Vendredi', 8, '2025-11-21 11:00:00', '12:00:00', 1, 99);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20251112105522', '2025-11-12 10:55:27', 18440);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
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
  UNIQUE KEY `UNIQ_ECA105F7A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `user_id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 4, 'Durand', 'Léo', 10, 'Rue de la Gare', 75010, 'Paris', 612345678, 'leo.durand@example.com'),
(2, 5, 'Martin', 'Clara', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789, 'clara.martin@example.com'),
(3, 7, 'Petit', 'Lucie', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890, 'lucie.petit@example.com'),
(4, 10, 'sdfsdf', 'sdfsdf', 12, 'rue de pierre ', 78500, 'villepaint', 850505055, 'adm@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `eleve_id` int(11) DEFAULT NULL,
  `date_inscription` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E90F6D67ECF78B0` (`cours_id`),
  KEY `IDX_5E90F6D6A6CC7B2` (`eleve_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id`, `cours_id`, `eleve_id`, `date_inscription`) VALUES
(1, 2, 1, '2025-09-02'),
(2, 1, 2, '2025-09-03'),
(3, 3, 3, '2025-09-04'),
(4, 2, 2, '2025-09-05'),
(5, 1, 4, '2025-11-24'),
(6, 1, 4, '2025-11-24'),
(7, 2, 4, '2025-11-24'),
(8, 3, 4, '2025-11-24'),
(9, 1, 4, '2025-11-24'),
(10, 1, 4, '2025-11-24'),
(11, 3, 4, '2025-11-24'),
(12, 1, 4, '2025-11-24'),
(13, 3, 4, '2025-11-24'),
(14, 1, 4, '2025-11-24'),
(15, 3, 4, '2025-11-24'),
(16, 1, 4, '2025-11-24'),
(17, 3, 4, '2025-11-24'),
(18, 1, 4, '2025-11-24'),
(19, 2, 4, '2025-11-24'),
(20, 4, 4, '2025-11-24');

-- --------------------------------------------------------

--
-- Structure de la table `instrument`
--

DROP TABLE IF EXISTS `instrument`;
CREATE TABLE IF NOT EXISTS `instrument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marque_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `num_serie` int(11) NOT NULL,
  `date_achat` date NOT NULL,
  `prix_achat` double NOT NULL,
  `utilisation` varchar(50) NOT NULL,
  `chemin_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3CBF69DD4827B9B2` (`marque_id`),
  KEY `IDX_3CBF69DDC54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `instrument`
--

INSERT INTO `instrument` (`id`, `marque_id`, `type_id`, `num_serie`, `date_achat`, `prix_achat`, `utilisation`, `chemin_image`) VALUES
(1, 1, 1, 123456, '2020-05-10', 1200, 'École', 'piano_yamaha_1.jpg'),
(2, 2, 7, 789012, '2021-09-15', 800, 'Prêt', 'fender_strat_1.jpg'),
(3, 5, 5, 345678, '2019-02-20', 2500, 'École', 'selmer_saxo_1.jpg'),
(4, 1, 3, 901234, '2022-01-30', 450, 'Prêt', 'yamaha_violon_1.jpg'),
(5, 4, 6, 567890, '2021-11-05', 1500, 'École', 'roland_td17_1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `intervention`
--

DROP TABLE IF EXISTS `intervention`;
CREATE TABLE IF NOT EXISTS `intervention` (
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
  KEY `IDX_D11814ABCF11D9C` (`instrument_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `intervention`
--

INSERT INTO `intervention` (`id`, `professionnel_id`, `instrument_id`, `date_debut`, `date_fin`, `description`, `prix`, `quotite`) VALUES
(1, 2, 1, '2025-09-01', '2025-09-01', 'Accordage annuel piano salle 1', 120, 100),
(2, 1, 4, '2025-10-15', '2025-10-17', 'Réglage chevalet violon prêt n°4', 75, 100),
(3, 3, 3, '2025-11-03', '2025-11-05', 'Remplacement tampons saxophone Selmer', 180, 100);

-- --------------------------------------------------------

--
-- Structure de la table `jour`
--

DROP TABLE IF EXISTS `jour`;
CREATE TABLE IF NOT EXISTS `jour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `jour`
--

INSERT INTO `jour` (`id`, `libelle`) VALUES
(1, 'Lundi'),
(2, 'Mardi'),
(3, 'Mercredi'),
(4, 'Jeudi'),
(5, 'Vendredi'),
(6, 'Samedi');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `libelle`) VALUES
(1, 'Yamaha'),
(2, 'Fender'),
(3, 'Gibson'),
(4, 'Roland'),
(5, 'Selmer');

-- --------------------------------------------------------

--
-- Structure de la table `metier`
--

DROP TABLE IF EXISTS `metier`;
CREATE TABLE IF NOT EXISTS `metier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `metier`
--

INSERT INTO `metier` (`id`, `libelle`) VALUES
(1, 'Luthier'),
(2, 'Accordeur'),
(3, 'Réparateur instruments à vent');

-- --------------------------------------------------------

--
-- Structure de la table `metier_professionnel`
--

DROP TABLE IF EXISTS `metier_professionnel`;
CREATE TABLE IF NOT EXISTS `metier_professionnel` (
  `metier_id` int(11) NOT NULL,
  `professionnel_id` int(11) NOT NULL,
  PRIMARY KEY (`metier_id`,`professionnel_id`),
  KEY `IDX_FA14296CED16FA20` (`metier_id`),
  KEY `IDX_FA14296C8A49CC82` (`professionnel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `metier_professionnel`
--

INSERT INTO `metier_professionnel` (`metier_id`, `professionnel_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `paiment`
--

DROP TABLE IF EXISTS `paiment`;
CREATE TABLE IF NOT EXISTS `paiment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inscription_id` int(11) DEFAULT NULL,
  `eleve_id` int(11) DEFAULT NULL,
  `quotient_id` int(11) DEFAULT NULL,
  `montant` double NOT NULL,
  `date_paiment` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DC8138F5DAC5993` (`inscription_id`),
  KEY `IDX_DC8138FA6CC7B2` (`eleve_id`),
  KEY `IDX_DC8138FF2C3D606` (`quotient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiment`
--

INSERT INTO `paiment` (`id`, `inscription_id`, `eleve_id`, `quotient_id`, `montant`, `date_paiment`) VALUES
(12, 18, 4, 2, 96, '2025-11-24'),
(13, 19, 4, 2, 48, '2025-11-24'),
(14, 20, 4, 2, 96, '2025-11-24');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 'Dupont', 'Jean-Pierre', 15, 'Rue des Arts', 75001, 'Paris', 611223344, 'jp.dupont@emusic.com'),
(2, 'Durant', 'Marie', 22, 'Boulevard de la Musique', 69002, 'Lyon', 622334455, 'm.durant@emusic.com'),
(3, 'Petit', 'Luc', 8, 'Avenue Mozart', 13001, 'Marseille', 633445566, 'l.petit@emusic.com');

-- --------------------------------------------------------

--
-- Structure de la table `professeur_type_instrument`
--

DROP TABLE IF EXISTS `professeur_type_instrument`;
CREATE TABLE IF NOT EXISTS `professeur_type_instrument` (
  `professeur_id` int(11) NOT NULL,
  `type_instrument_id` int(11) NOT NULL,
  PRIMARY KEY (`professeur_id`,`type_instrument_id`),
  KEY `IDX_1E1989D6BAB22EE9` (`professeur_id`),
  KEY `IDX_1E1989D67C1CAAA9` (`type_instrument_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `professeur_type_instrument`
--

INSERT INTO `professeur_type_instrument` (`professeur_id`, `type_instrument_id`) VALUES
(1, 1),
(2, 2),
(2, 7),
(3, 4),
(3, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `professionnel`
--

DROP TABLE IF EXISTS `professionnel`;
CREATE TABLE IF NOT EXISTS `professionnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `num_rue` int(11) NOT NULL,
  `rue` varchar(50) NOT NULL,
  `copos` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `mail` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `professionnel`
--

INSERT INTO `professionnel` (`id`, `nom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 'Lutherie & Co', 12, 'Rue des Luthiers', 75005, 'Paris', '0145678901', 'contact@lutherieco.com'),
(2, 'Piano Service', 30, 'Avenue des Claviers', 69003, 'Lyon', '0478901234', 'info@pianoservice.fr'),
(3, 'Vent-Debout', 5, 'Place du Mistral', 13002, 'Marseille', '0491234567', 'reparation@ventdebout.com');

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

DROP TABLE IF EXISTS `responsable`;
CREATE TABLE IF NOT EXISTS `responsable` (
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
  KEY `IDX_52520D07F2C3D606` (`quotient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `responsable`
--

INSERT INTO `responsable` (`id`, `quotient_id`, `user_id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 3, 2, 'Durand', 'Paul', 10, 'Rue de la Gare', 75010, 'Paris', 612345678, 'parent.durand@example.com'),
(2, 5, 3, 'Martin', 'Sophie', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789, 'parent.martin@example.com'),
(3, 1, 6, 'Petit', 'Marc', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890, 'parent.petit@example.com'),
(4, 2, 11, 'Cam', 'mi', 14, 'rue des lilas', 61250, 'conde sur sarthe ', 761704334, 'cam@gmail.com'),
(5, NULL, 12, 'Pierre', 'Pierre', 14, 'rue des lilas', 61250, 'Conde ', 461704334, 'Pierre@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `responsable_eleve`
--

DROP TABLE IF EXISTS `responsable_eleve`;
CREATE TABLE IF NOT EXISTS `responsable_eleve` (
  `responsable_id` int(11) NOT NULL,
  `eleve_id` int(11) NOT NULL,
  PRIMARY KEY (`responsable_id`,`eleve_id`),
  KEY `IDX_8D30209553C59D72` (`responsable_id`),
  KEY `IDX_8D302095A6CC7B2` (`eleve_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `responsable_eleve`
--

INSERT INTO `responsable_eleve` (`responsable_id`, `eleve_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

DROP TABLE IF EXISTS `tarif`;
CREATE TABLE IF NOT EXISTS `tarif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `montant` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E7189C9C54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id`, `type_id`, `montant`) VALUES
(1, 1, 350),
(2, 2, 550);

-- --------------------------------------------------------

--
-- Structure de la table `tarif_cours`
--

DROP TABLE IF EXISTS `tarif_cours`;
CREATE TABLE IF NOT EXISTS `tarif_cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tranche_quotient_id_id` int(11) DEFAULT NULL,
  `cours_id_id` int(11) DEFAULT NULL,
  `prix_facture` decimal(20,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_24FE176C1FCAE54` (`tranche_quotient_id_id`),
  KEY `IDX_24FE176C4F221781` (`cours_id_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tarif_cours`
--

INSERT INTO `tarif_cours` (`id`, `tranche_quotient_id_id`, `cours_id_id`, `prix_facture`) VALUES
(1, NULL, 2, 417),
(2, NULL, 1, 209),
(3, 1, 2, 60),
(4, 1, 1, 30),
(5, 2, 2, 96),
(6, 2, 1, 48),
(7, 3, 2, 126),
(8, 3, 1, 63),
(9, 4, 2, 192),
(10, 4, 1, 96),
(11, 5, 2, 282),
(12, 5, 1, 141),
(13, 6, 2, 330),
(14, 6, 1, 165);

-- --------------------------------------------------------

--
-- Structure de la table `tranche_quotient`
--

DROP TABLE IF EXISTS `tranche_quotient`;
CREATE TABLE IF NOT EXISTS `tranche_quotient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `quotient_min` int(11) NOT NULL,
  `quotient_max` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tranche_quotient`
--

INSERT INTO `tranche_quotient` (`id`, `libelle`, `quotient_min`, `quotient_max`) VALUES
(1, '0 à 250', 0, 250),
(2, '251 à 425', 251, 425),
(3, '426 à 680', 426, 680),
(4, '681 à 935', 681, 935),
(5, '936 à 1800', 936, 1800),
(6, '1801 et supérieur', 1801, 999999);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `nom`) VALUES
(1, 'Collectif'),
(2, 'Individuel');

-- --------------------------------------------------------

--
-- Structure de la table `type_instrument`
--

DROP TABLE IF EXISTS `type_instrument`;
CREATE TABLE IF NOT EXISTS `type_instrument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe_instrument_id` int(11) DEFAULT NULL,
  `classeinstrument_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_21BCBFF8CE879FB1` (`classe_instrument_id`),
  KEY `IDX_21BCBFF8F7D7F589` (`classeinstrument_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_instrument`
--

INSERT INTO `type_instrument` (`id`, `classe_instrument_id`, `classeinstrument_id`, `libelle`) VALUES
(1, NULL, 4, 'Piano'),
(2, NULL, 2, 'Guitare Classique'),
(3, NULL, 2, 'Violon'),
(4, NULL, 1, 'Flûte traversière'),
(5, NULL, 1, 'Saxophone'),
(6, NULL, 3, 'Batterie'),
(7, NULL, 2, 'Guitare Électrique');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`) VALUES
(1, 'admin@emusic.com', '[\"ROLE_ADMIN\"]', '$2y$13$yourhashedpassword', 'Admin', 'Root', 1, NULL, NULL, NULL, NULL),
(2, 'parent.durand@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Durand', 'Paul', 10, NULL, NULL, NULL, NULL),
(3, 'parent.martin@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Martin', 'Sophie', 20, NULL, NULL, NULL, NULL),
(4, 'eleve.durand@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Durand', 'Leo', 10, NULL, NULL, NULL, NULL),
(5, 'eleve.martin@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Martin', 'Clara', 20, NULL, NULL, NULL, NULL),
(6, 'parent.petit@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Petit', 'Marc', 30, NULL, NULL, NULL, NULL),
(7, 'eleve.petit@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Petit', 'Lucie', 30, NULL, NULL, NULL, NULL),
(10, 'adm@gmail.com', '[\"ROLE_ELEVE\"]', '$2y$13$TkX3x0K7MiG.zX.dAvsZiOmWeNx2kkK9i0TI7zy2UwOHkplN5lI1S', 'sdfsdf', 'sdfsdf', NULL, NULL, NULL, NULL, NULL),
(11, 'cam@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$acvRTCgkZ/kNSfGbDChswetf53d2bjSwNVXdqBtqEJFn2Zcec64gi', 'Cam', 'mi', NULL, NULL, NULL, NULL, NULL),
(12, 'Pierre@gmail.com', '[\"ROLE_RESPONSABLE\"]', '$2y$13$jhBUURux8TjWV.sh7uPr9uLSXA1SxO0dfw9V0MeZzhks8k6ECKLru', 'Pierre', 'Pierre', NULL, NULL, NULL, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accessoire`
--
ALTER TABLE `accessoire`
  ADD CONSTRAINT `FK_8FD026ACF11D9C` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`);

--
-- Contraintes pour la table `contrat_pret`
--
ALTER TABLE `contrat_pret`
  ADD CONSTRAINT `FK_1FB84C67A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `FK_1FB84C67CF11D9C` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`);

--
-- Contraintes pour la table `couleur_instrument`
--
ALTER TABLE `couleur_instrument`
  ADD CONSTRAINT `FK_2E62255DC31BA576` FOREIGN KEY (`couleur_id`) REFERENCES `couleur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2E62255DCF11D9C` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_FDCA8C9C220C6AD0` FOREIGN KEY (`jour_id`) REFERENCES `jour` (`id`),
  ADD CONSTRAINT `FK_FDCA8C9C7C1CAAA9` FOREIGN KEY (`type_instrument_id`) REFERENCES `type_instrument` (`id`),
  ADD CONSTRAINT `FK_FDCA8C9CBAB22EE9` FOREIGN KEY (`professeur_id`) REFERENCES `professeur` (`id`),
  ADD CONSTRAINT `FK_FDCA8C9CC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `FK_ECA105F7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `FK_5E90F6D67ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  ADD CONSTRAINT `FK_5E90F6D6A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`);

--
-- Contraintes pour la table `instrument`
--
ALTER TABLE `instrument`
  ADD CONSTRAINT `FK_3CBF69DD4827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`),
  ADD CONSTRAINT `FK_3CBF69DDC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type_instrument` (`id`);

--
-- Contraintes pour la table `intervention`
--
ALTER TABLE `intervention`
  ADD CONSTRAINT `FK_D11814AB8A49CC82` FOREIGN KEY (`professionnel_id`) REFERENCES `professionnel` (`id`),
  ADD CONSTRAINT `FK_D11814ABCF11D9C` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`);

--
-- Contraintes pour la table `metier_professionnel`
--
ALTER TABLE `metier_professionnel`
  ADD CONSTRAINT `FK_FA14296C8A49CC82` FOREIGN KEY (`professionnel_id`) REFERENCES `professionnel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FA14296CED16FA20` FOREIGN KEY (`metier_id`) REFERENCES `metier` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paiment`
--
ALTER TABLE `paiment`
  ADD CONSTRAINT `FK_DC8138F5DAC5993` FOREIGN KEY (`inscription_id`) REFERENCES `inscription` (`id`),
  ADD CONSTRAINT `FK_DC8138FA6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `FK_DC8138FF2C3D606` FOREIGN KEY (`quotient_id`) REFERENCES `tranche_quotient` (`id`);

--
-- Contraintes pour la table `professeur_type_instrument`
--
ALTER TABLE `professeur_type_instrument`
  ADD CONSTRAINT `FK_1E1989D67C1CAAA9` FOREIGN KEY (`type_instrument_id`) REFERENCES `type_instrument` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1E1989D6BAB22EE9` FOREIGN KEY (`professeur_id`) REFERENCES `professeur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD CONSTRAINT `FK_52520D07A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_52520D07F2C3D606` FOREIGN KEY (`quotient_id`) REFERENCES `tranche_quotient` (`id`);

--
-- Contraintes pour la table `responsable_eleve`
--
ALTER TABLE `responsable_eleve`
  ADD CONSTRAINT `FK_8D30209553C59D72` FOREIGN KEY (`responsable_id`) REFERENCES `responsable` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8D302095A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `FK_E7189C9C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `tarif_cours`
--
ALTER TABLE `tarif_cours`
  ADD CONSTRAINT `FK_24FE176C1FCAE54` FOREIGN KEY (`tranche_quotient_id_id`) REFERENCES `tranche_quotient` (`id`),
  ADD CONSTRAINT `FK_24FE176C4F221781` FOREIGN KEY (`cours_id_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `type_instrument`
--
ALTER TABLE `type_instrument`
  ADD CONSTRAINT `FK_21BCBFF8CE879FB1` FOREIGN KEY (`classe_instrument_id`) REFERENCES `type_instrument` (`id`),
  ADD CONSTRAINT `FK_21BCBFF8F7D7F589` FOREIGN KEY (`classeinstrument_id`) REFERENCES `classe_instrument` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
