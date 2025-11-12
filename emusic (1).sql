SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Vider les tables dans l'ordre inverse des dépendances (si elles existent)
--
SET FOREIGN_KEY_CHECKS=0;
TRUNCATE TABLE `paiment`;
TRUNCATE TABLE `inscription`;
TRUNCATE TABLE `intervention`;
TRUNCATE TABLE `couleur_instrument`;
TRUNCATE TABLE `contrat_pret`;
TRUNCATE TABLE `accessoire`;
TRUNCATE TABLE `tarif_cours`;
TRUNCATE TABLE `responsable_eleve`;
TRUNCATE TABLE `cours`;
TRUNCATE TABLE `instrument`;
TRUNCATE TABLE `professeur_type_instrument`;
TRUNCATE TABLE `metier_professionnel`;
TRUNCATE TABLE `responsable`;
TRUNCATE TABLE `eleve`;
TRUNCATE TABLE `tarif`;
TRUNCATE TABLE `type_instrument`;
TRUNCATE TABLE `tranche_quotient`;
TRUNCATE TABLE `professionnel`;
TRUNCATE TABLE `professeur`;
TRUNCATE TABLE `metier`;
TRUNCATE TABLE `marque`;
TRUNCATE TABLE `jour`;
TRUNCATE TABLE `couleur`;
TRUNCATE TABLE `contact`;
TRUNCATE TABLE `classe_instrument`;
TRUNCATE TABLE `type`;
TRUNCATE TABLE `user`;
SET FOREIGN_KEY_CHECKS=1;

--
-- Insertion des données de base (sans dépendances)
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `num_rue`) VALUES
(1, 'admin@emusic.com', '["ROLE_ADMIN"]', '$2y$13$yourhashedpassword', 'Admin', 'Root', 1),
(2, 'parent.durand@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Durand', 'Paul', 10),
(3, 'parent.martin@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Martin', 'Sophie', 20),
(4, 'eleve.durand@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Durand', 'Leo', 10),
(5, 'eleve.martin@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Martin', 'Clara', 20),
(6, 'parent.petit@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Petit', 'Marc', 30),
(7, 'eleve.petit@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Petit', 'Lucie', 30);

INSERT INTO `type` (`id`, `nom`) VALUES
(1, 'Collectif'),
(2, 'Individuel');

INSERT INTO `classe_instrument` (`id`, `libelle`) VALUES
(1, 'Vents'),
(2, 'Cordes'),
(3, 'Percussions'),
(4, 'Claviers');

INSERT INTO `contact` (`id`, `nom`, `email`, `message`) VALUES
(1, 'Julien Leblanc', 'j.leblanc@email.com', 'Bonjour, proposez-vous des cours de ukulélé ?'),
(2, 'Alice Moreau', 'a.moreau@email.com', 'Quels sont les tarifs pour les cours de piano individuels ?');

INSERT INTO `couleur` (`id`, `nom`) VALUES
(1, 'Noir laqué'),
(2, 'Bois naturel'),
(3, 'Argenté'),
(4, 'Rouge vif');

INSERT INTO `jour` (`id`, `libelle`) VALUES
(1, 'Lundi'),
(2, 'Mardi'),
(3, 'Mercredi'),
(4, 'Jeudi'),
(5, 'Vendredi'),
(6, 'Samedi');

INSERT INTO `marque` (`id`, `libelle`) VALUES
(1, 'Yamaha'),
(2, 'Fender'),
(3, 'Gibson'),
(4, 'Roland'),
(5, 'Selmer');

INSERT INTO `metier` (`id`, `libelle`) VALUES
(1, 'Luthier'),
(2, 'Accordeur'),
(3, 'Réparateur instruments à vent');

INSERT INTO `professeur` (`id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 'Dupont', 'Jean-Pierre', 15, 'Rue des Arts', 75001, 'Paris', 611223344, 'jp.dupont@emusic.com'),
(2, 'Durant', 'Marie', 22, 'Boulevard de la Musique', 69002, 'Lyon', 622334455, 'm.durant@emusic.com'),
(3, 'Petit', 'Luc', 8, 'Avenue Mozart', 13001, 'Marseille', 633445566, 'l.petit@emusic.com');

INSERT INTO `professionnel` (`id`, `nom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 'Lutherie & Co', 12, 'Rue des Luthiers', 75005, 'Paris', '0145678901', 'contact@lutherieco.com'),
(2, 'Piano Service', 30, 'Avenue des Claviers', 69003, 'Lyon', '0478901234', 'info@pianoservice.fr'),
(3, 'Vent-Debout', 5, 'Place du Mistral', 13002, 'Marseille', '0491234567', 'reparation@ventdebout.com');

--
-- Insertion table `tranche_quotient` (BASÉE SUR L'IMAGE)
--
INSERT INTO `tranche_quotient` (`id`, `libelle`, `quotient_min`, `quotient_max`) VALUES
(1, '0 à 250', 0, 250),
(2, '251 à 425', 251, 425),
(3, '426 à 680', 426, 680),
(4, '681 à 935', 681, 935),
(5, '936 à 1800', 936, 1800),
(6, '1801 et supérieur', 1801, 999999);

--
-- Insertion tables dépendantes (Niveau 2)
--

INSERT INTO `type_instrument` (`id`, `classe_instrument_id`, `classeinstrument_id`, `libelle`) VALUES
(1, NULL, 4, 'Piano'),
(2, NULL, 2, 'Guitare Classique'),
(3, NULL, 2, 'Violon'),
(4, NULL, 1, 'Flûte traversière'),
(5, NULL, 1, 'Saxophone'),
(6, NULL, 3, 'Batterie'),
(7, NULL, 2, 'Guitare Électrique');

INSERT INTO `eleve` (`id`, `user_id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 4, 'Durand', 'Léo', 10, 'Rue de la Gare', 75010, 'Paris', 612345678, 'leo.durand@example.com'),
(2, 5, 'Martin', 'Clara', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789, 'clara.martin@example.com'),
(3, 7, 'Petit', 'Lucie', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890, 'lucie.petit@example.com');

INSERT INTO `responsable` (`id`, `quotient_id`, `user_id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 3, 2, 'Durand', 'Paul', 10, 'Rue de la Gare', 75010, 'Paris', 612345678, 'parent.durand@example.com'),
(2, 5, 3, 'Martin', 'Sophie', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789, 'parent.martin@example.com'),
(3, 1, 6, 'Petit', 'Marc', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890, 'parent.petit@example.com');

INSERT INTO `metier_professionnel` (`metier_id`, `professionnel_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

INSERT INTO `professeur_type_instrument` (`professeur_id`, `type_instrument_id`) VALUES
(1, 1),
(2, 2),
(2, 7),
(3, 4),
(3, 5),
(3, 6);

INSERT INTO `tarif` (`id`, `type_id`, `montant`) VALUES
(1, 1, 350.00),
(2, 2, 550.00);

--
-- Insertion tables dépendantes (Niveau 3)
--

INSERT INTO `instrument` (`id`, `marque_id`, `type_id`, `num_serie`, `date_achat`, `prix_achat`, `utilisation`, `chemin_image`) VALUES
(1, 1, 1, 123456, '2020-05-10', 1200.00, 'École', 'piano_yamaha_1.jpg'),
(2, 2, 7, 789012, '2021-09-15', 800.00, 'Prêt', 'fender_strat_1.jpg'),
(3, 5, 5, 345678, '2019-02-20', 2500.00, 'École', 'selmer_saxo_1.jpg'),
(4, 1, 3, 901234, '2022-01-30', 450.00, 'Prêt', 'yamaha_violon_1.jpg'),
(5, 4, 6, 567890, '2021-11-05', 1500.00, 'École', 'roland_td17_1.jpg');

INSERT INTO `cours` (`id`, `type_id`, `type_instrument_id`, `professeur_id`, `jour_id`, `libelle`, `age_mini`, `heure_debut`, `heure_fin`, `nb_places`, `age_maxi`) VALUES
(1, 2, 1, 1, 1, 'Piano Individuel Lundi', 7, '2025-11-17 14:00:00', '15:00:00', 1, 99),
(2, 1, 2, 2, 2, 'Guitare Collectif Ados', 12, '2025-11-18 17:00:00', '18:00:00', 8, 17),
(3, 1, 6, 3, 3, 'Atelier Batterie', 10, '2025-11-19 16:00:00', '17:30:00', 5, 15),
(4, 2, 4, 3, 5, 'Flûte Individuel Vendredi', 8, '2025-11-21 11:00:00', '12:00:00', 1, 99);

INSERT INTO `responsable_eleve` (`responsable_id`, `eleve_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

--
-- Insertion table `tarif_cours` (BASÉE SUR L'IMAGE)
-- (Rappel: Type ID 1 = Collectif, Type ID 2 = Individuel)
--
INSERT INTO `tarif_cours` (`tranche_quotient_id_id`, `cours_id_id`, `prix_facture`) VALUES
(NULL, 2, '417'), -- " -9999 à -1" (NULL) / Cours Individuel
(NULL, 1, '209'), -- " -9999 à -1" (NULL) / Cours Collectif
(1, 2, '60'), -- "0 à 250" / Cours Individuel
(1, 1, '30'), -- "0 à 250" / Cours Collectif
(2, 2, '96'), -- "251 à 425" / Cours Individuel
(2, 1, '48'), -- "251 à 425" / Cours Collectif
(3, 2, '126'), -- "426 à 680" / Cours Individuel
(3, 1, '63'), -- "426 à 680" / Cours Collectif
(4, 2, '192'), -- "681 à 935" / Cours Individuel
(4, 1, '96'), -- "681 à 935" / Cours Collectif
(5, 2, '282'), -- "936 à 1800" / Cours Individuel
(5, 1, '141'), -- "936 à 1800" / Cours Collectif
(6, 2, '330'), -- "1801 et supérieur" / Cours Individuel
(6, 1, '165'); -- "1801 et supérieur" / Cours Collectif

--
-- Insertion tables dépendantes (Niveau 4)
--

INSERT INTO `accessoire` (`id`, `instrument_id`, `libelle`) VALUES
(1, 1, 'Banquette de piano'),
(2, 2, 'Housse de guitare'),
(3, 2, 'Jeu de cordes de rechange'),
(4, 3, 'Bec de saxophone'),
(5, 3, 'Boîte d\'anches'),
(6, 5, 'Paire de baguettes');

INSERT INTO `contrat_pret` (`id`, `eleve_id`, `instrument_id`, `date_debut`, `date_fin`, `attestation_assurance`, `etat_detaille_debut`, `etat_detaille_retour`) VALUES
(1, 2, 2, '2025-09-10', '2026-06-25', 'assurance_martin_2025.pdf', 'Neuf', 'TBD'),
(2, 3, 4, '2025-09-12', '2026-06-25', 'assurance_petit_2025.pdf', 'Bon état, légère éraflure', 'TBD');

INSERT INTO `couleur_instrument` (`couleur_id`, `instrument_id`) VALUES
(1, 1),
(2, 4),
(3, 3),
(4, 2);

INSERT INTO `intervention` (`id`, `professionnel_id`, `instrument_id`, `date_debut`, `date_fin`, `description`, `prix`, `quotite`) VALUES
(1, 2, 1, '2025-09-01', '2025-09-01', 'Accordage annuel piano salle 1', 120, 100),
(2, 1, 4, '2025-10-15', '2025-10-17', 'Réglage chevalet violon prêt n°4', 75, 100),
(3, 3, 3, '2025-11-03', '2025-11-05', 'Remplacement tampons saxophone Selmer', 180, 100);

INSERT INTO `inscription` (`id`, `cours_id`, `eleve_id`, `date_inscription`) VALUES
(1, 2, 1, '2025-09-02'),
(2, 1, 2, '2025-09-03'),
(3, 3, 3, '2025-09-04'),
(4, 2, 2, '2025-09-05');

--
-- Insertion tables dépendantes (Niveau 5)
--

INSERT INTO `paiment` (`id`, `inscription_id`, `eleve_id`, `quotient_id`, `montant`, `date_paiment`) VALUES
(1, 1, 1, 3, 63.00, '2025-09-10'), -- Eleve 1 (Durand, QF 3) s'inscrit au cours 2 (Collectif) -> Prix = 63
(2, 2, 2, 5, 282.00, '2025-09-11'), -- Eleve 2 (Martin, QF 5) s'inscrit au cours 1 (Individuel) -> Prix = 282
(3, 3, 3, 1, 30.00, '2025-09-12'); -- Eleve 3 (Petit, QF 1) s'inscrit au cours 3 (Collectif) -> Prix = 30

COMMIT;