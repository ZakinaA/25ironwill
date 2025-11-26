-- DÉBUT DU SCRIPT DE RESTAURATION DES DONNÉES SANS ERREUR

-- 1. DÉSACTIVER LES CONTRÔLES DE CLÉS ÉTRANGÈRES
SET FOREIGN_KEY_CHECKS = 0;

-- 2. VIDAGE DES TABLES (TRUNCATE) ET RÉINITIALISATION DE L'AUTO_INCREMENT
-- Ceci permet de garantir que les ID recommencent à 1 (ou le prochain disponible) pour chaque table.

TRUNCATE TABLE `accessoire`;
TRUNCATE TABLE `classe_instrument`;
TRUNCATE TABLE `contact`;
TRUNCATE TABLE `contrat_pret`;
TRUNCATE TABLE `couleur`;
TRUNCATE TABLE `couleur_instrument`;
TRUNCATE TABLE `cours`;
-- TRUNCATE TABLE `doctrine_migration_versions`; (Souvent laissé intact)
TRUNCATE TABLE `eleve`;
TRUNCATE TABLE `inscription`;
TRUNCATE TABLE `instrument`;
TRUNCATE TABLE `intervention`;
TRUNCATE TABLE `jour`;
TRUNCATE TABLE `marque`;
TRUNCATE TABLE `metier`;
TRUNCATE TABLE `metier_professionnel`;
TRUNCATE TABLE `paiment`;
TRUNCATE TABLE `professeur`;
TRUNCATE TABLE `professeur_type_instrument`;
TRUNCATE TABLE `professionnel`;
TRUNCATE TABLE `responsable`;
TRUNCATE TABLE `responsable_eleve`;
TRUNCATE TABLE `tarif`;
TRUNCATE TABLE `tarif_cours`;
TRUNCATE TABLE `tranche_quotient`;
TRUNCATE TABLE `type`;
TRUNCATE TABLE `type_instrument`;
TRUNCATE TABLE `user`;


-- 3. INSERTION DES DONNÉES (SANS LA COLONNE ID POUR LES TABLES AUTO_INCREMENT)
-- Utilisation de INSERT IGNORE pour la table user pour passer l'erreur 'admin@emusic.com' si elle existe

-- TABLES DE BASE -------------------------------------------------------------------
INSERT INTO `marque` (`libelle`) VALUES
('Yamaha'), ('Fender'), ('Gibson'), ('Roland'), ('Selmer');

INSERT INTO `metier` (`libelle`) VALUES
('Luthier'), ('Accordeur'), ('Réparateur instruments à vent');

INSERT INTO `jour` (`libelle`) VALUES
('Lundi'), ('Mardi'), ('Mercredi'), ('Jeudi'), ('Vendredi'), ('Samedi');

INSERT INTO `type` (`nom`) VALUES
('Collectif'), ('Individuel');

INSERT INTO `couleur` (`nom`) VALUES
('Noir laqué'), ('Bois naturel'), ('Argenté'), ('Rouge vif');

INSERT INTO `classe_instrument` (`libelle`) VALUES
('Vents'), ('Cordes'), ('Percussions'), ('Claviers');

INSERT INTO `tranche_quotient` (`libelle`, `quotient_min`, `quotient_max`) VALUES
('0 à 250', 0, 250),
('251 à 425', 251, 425),
('426 à 680', 426, 680),
('681 à 935', 681, 935),
('936 à 1800', 936, 1800),
('1801 et supérieur', 1801, 999999);

INSERT INTO `professeur` (`nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
('Dupont', 'Jean-Pierre', 15, 'Rue des Arts', 75001, 'Paris', 611223344, 'jp.dupont@emusic.com'),
('Durant', 'Marie', 22, 'Boulevard de la Musique', 69002, 'Lyon', 622334455, 'm.durant@emusic.com'),
('Petit', 'Luc', 8, 'Avenue Mozart', 13001, 'Marseille', 633445566, 'l.petit@emusic.com');

INSERT INTO `professionnel` (`nom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
('Lutherie & Co', 12, 'Rue des Luthiers', 75005, 'Paris', '0145678901', 'contact@lutherieco.com'),
('Piano Service', 30, 'Avenue des Claviers', 69003, 'Lyon', '0478901234', 'info@pianoservice.fr'),
('Vent-Debout', 5, 'Place du Mistral', 13002, 'Marseille', '0491234567', 'reparation@ventdebout.com');

INSERT INTO `contact` (`nom`, `email`, `message`) VALUES
('Julien Leblanc', 'j.leblanc@email.com', 'Bonjour, proposez-vous des cours de ukulélé ?'),
('Alice Moreau', 'a.moreau@email.com', 'Quels sont les tarifs pour les cours de piano individuels ?');

-- TABLES AVEC DÉPENDANCES ----------------------------------------------------------

-- USERS (source de l'erreur #1062 précédente, corrigée par l'ordre et TRUNCATE)
INSERT INTO `user` (`email`, `roles`, `password`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`) VALUES
('admin@emusic.com', '["ROLE_ADMIN"]', '$2y$13$yourhashedpassword', 'Admin', 'Root', 1, 'Rue de l\'Admin', 75000, 'Paris', 101010101),
('parent.durand@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Durand', 'Paul', 10, 'Rue de la Gare', 75010, 'Paris', 612345678),
('parent.martin@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Martin', 'Sophie', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789),
('eleve.durand@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Durand', 'Leo', 10, 'Rue de la Gare', 75010, 'Paris', 612345678),
('eleve.martin@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Martin', 'Clara', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789),
('parent.petit@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Petit', 'Marc', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890),
('eleve.petit@example.com', '["ROLE_USER"]', '$2y$13$yourhashedpassword', 'Petit', 'Lucie', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890),
('adm@gmail.com', '["ROLE_ELEVE"]', '$2y$13$TkX3x0K7MiG.zX.dAvsZiOmWeNx2kkK9i0TI7zy2UwOHkplN5lI1S', 'sdfsdf', 'sdfsdf', 12, 'rue de pierre ', 78500, 'villepaint', 850505055),
('cam@gmail.com', '["ROLE_ADMIN"]', '$2y$13$acvRTCgkZ/kNSfGbDChswetf53d2bjSwNVXdqBtqEJFn2Zcec64gi', 'Cam', 'mi', 14, 'rue des lilas', 61250, 'conde sur sarthe ', 761704334),
('Pierre@gmail.com', '["ROLE_RESPONSABLE"]', '$2y$13$jhBUURux8TjWV.sh7uPr9uLSXA1Sx0dfw9V0MeZzhks8k6ECKLru', 'Pierre', 'Pierre', 14, 'rue des lilas', 61250, 'Conde ', 461704334);

-- ELEVES (Dépend de user)
INSERT INTO `eleve` (`user_id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(4, 'Durand', 'Léo', 10, 'Rue de la Gare', 75010, 'Paris', 612345678, 'leo.durand@example.com'),
(5, 'Martin', 'Clara', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789, 'clara.martin@example.com'),
(7, 'Petit', 'Lucie', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890, 'lucie.petit@example.com'),
(8, 'sdfsdf', 'sdfsdf', 12, 'rue de pierre ', 78500, 'villepaint', 850505055, 'adm@gmail.com');

-- RESPONSABLES (Dépend de user, tranche_quotient)
INSERT INTO `responsable` (`quotient_id`, `user_id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(3, 2, 'Durand', 'Paul', 10, 'Rue de la Gare', 75010, 'Paris', 612345678, 'parent.durand@example.com'),
(5, 3, 'Martin', 'Sophie', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789, 'parent.martin@example.com'),
(1, 6, 'Petit', 'Marc', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890, 'parent.petit@example.com'),
(2, 9, 'Cam', 'mi', 14, 'rue des lilas', 61250, 'conde sur sarthe ', 761704334, 'cam@gmail.com'),
(NULL, 10, 'Pierre', 'Pierre', 14, 'rue des lilas', 61250, 'Conde ', 461704334, 'Pierre@gmail.com');

-- TYPE INSTRUMENT (dépend de classe_instrument)
INSERT INTO `type_instrument` (`classeinstrument_id`, `libelle`) VALUES
(4, 'Piano'),
(2, 'Guitare Classique'),
(2, 'Violon'),
(1, 'Flûte traversière'),
(1, 'Saxophone'),
(3, 'Batterie'),
(2, 'Guitare Électrique');

-- INSTRUMENT (Dépend de marque, type_instrument)
INSERT INTO `instrument` (`marque_id`, `type_id`, `num_serie`, `date_achat`, `prix_achat`, `utilisation`, `chemin_image`) VALUES
(1, 1, '123456', '2020-05-10', 1200, 'École', 'piano_yamaha_1.jpg'),
(2, 7, '789012', '2021-09-15', 800, 'Prêt', 'fender_strat_1.jpg'),
(5, 5, '345678', '2019-02-20', 2500, 'École', 'selmer_saxo_1.jpg'),
(1, 3, '901234', '2022-01-30', 450, 'Prêt', 'yamaha_violon_1.jpg'),
(4, 6, '567890', '2021-11-05', 1500, 'École', 'roland_td17_1.jpg');

-- COURS (Dépend de type, type_instrument, professeur, jour)
INSERT INTO `cours` (`type_id`, `type_instrument_id`, `professeur_id`, `jour_id`, `libelle`, `age_mini`, `heure_debut`, `heure_fin`, `nb_places`, `age_maxi`) VALUES
(2, 1, 1, 1, 'Piano Individuel Lundi', 7, '2025-11-17 14:00:00', '15:00:00', 1, 99),
(1, 2, 2, 2, 'Guitare Collectif Ados', 12, '2025-11-18 17:00:00', '18:00:00', 8, 17),
(1, 6, 3, 3, 'Atelier Batterie', 10, '2025-11-19 16:00:00', '17:30:00', 5, 15),
(2, 4, 3, 5, 'Flûte Individuel Vendredi', 8, '2025-11-21 11:00:00', '12:00:00', 1, 99);

-- TABLES DE LIAISON (Dépendances multiples)
INSERT INTO `metier_professionnel` (`metier_id`, `professionnel_id`) VALUES
(1, 1), (2, 2), (3, 3);

INSERT INTO `professeur_type_instrument` (`professeur_id`, `type_instrument_id`) VALUES
(1, 1), (2, 2), (2, 7), (3, 4), (3, 5), (3, 6);

INSERT INTO `couleur_instrument` (`couleur_id`, `instrument_id`) VALUES
(1, 1), (2, 4), (3, 3), (4, 2);

INSERT INTO `responsable_eleve` (`responsable_id`, `eleve_id`) VALUES
(1, 1), (2, 2), (3, 3), (4, 4);

-- ACCESSOIRES (Dépend d'instrument)
INSERT INTO `accessoire` (`instrument_id`, `libelle`) VALUES
(1, 'Banquette de piano'),
(2, 'Housse de guitare'),
(2, 'Jeu de cordes de rechange'),
(3, 'Bec de saxophone'),
(3, 'Boîte d\'anches'),
(5, 'Paire de baguettes');

-- INTERVENTION (Dépend de professionnel, instrument)
INSERT INTO `intervention` (`professionnel_id`, `instrument_id`, `date_debut`, `date_fin`, `description`, `prix`, `quotite`) VALUES
(2, 1, '2025-09-01', '2025-09-01', 'Accordage annuel piano salle 1', 120, 100),
(1, 4, '2025-10-15', '2025-10-17', 'Réglage chevalet violon prêt n°4', 75, 100),
(3, 3, '2025-11-03', '2025-11-05', 'Remplacement tampons saxophone Selmer', 180, 100);

-- TARIF COURS (Dépend de tranche_quotient et type)
INSERT INTO `tarif_cours` (`tranche_quotient_id_id`, `cours_id_id`, `prix_facture`) VALUES
(NULL, 2, 417), (NULL, 1, 209),
(1, 2, 60), (1, 1, 30),
(2, 2, 96), (2, 1, 48),
(3, 2, 126), (3, 1, 63),
(4, 2, 192), (4, 1, 96),
(5, 2, 282), (5, 1, 141),
(6, 2, 330), (6, 1, 165);

-- INSCRIPTION (Dépend de cours, eleve)
INSERT INTO `inscription` (`cours_id`, `eleve_id`, `date_inscription`, `montant_du`) VALUES
(2, 1, '2025-09-02', NULL), (1, 2, '2025-09-03', NULL), (3, 3, '2025-09-04', NULL), (2, 2, '2025-09-05', NULL),
(1, 4, '2025-11-24', NULL), (1, 4, '2025-11-24', NULL), (2, 4, '2025-11-24', NULL), (3, 4, '2025-11-24', NULL),
(1, 4, '2025-11-24', NULL), (1, 4, '2025-11-24', NULL), (3, 4, '2025-11-24', NULL), (1, 4, '2025-11-24', NULL),
(3, 4, '2025-11-24', NULL), (1, 4, '2025-11-24', NULL), (3, 4, '2025-11-24', NULL), (1, 4, '2025-11-24', NULL),
(3, 4, '2025-11-24', NULL), (1, 4, '2025-11-24', NULL), (2, 4, '2025-11-24', NULL), (4, 4, '2025-11-24', NULL);

-- PAIEMENT (Dépend d'inscription, eleve, tranche_quotient)
INSERT INTO `paiment` (`inscription_id`, `eleve_id`, `quotient_id`, `montant`, `date_paiment`) VALUES
(18, 4, 2, 96, '2025-11-24'),
(19, 4, 2, 48, '2025-11-24'),
(20, 4, 2, 96, '2025-11-24');

-- CONTRAT PRÊT (Dépend d'eleve, instrument)
INSERT INTO `contrat_pret` (`eleve_id`, `instrument_id`, `date_debut`, `date_fin`, `attestation_assurance`, `etat_detaille_debut`, `etat_detaille_retour`) VALUES
(2, 2, '2025-09-10', '2026-06-25', 'assurance_martin_2025.pdf', 'Neuf', 'TBD'),
(3, 4, '2025-09-12', '2026-06-25', 'assurance_petit_2025.pdf', 'Bon état, légère éraflure', 'TBD');




-- 4. RÉACTIVER LES CONTRÔLES DE CLÉS ÉTRANGÈRES
SET FOREIGN_KEY_CHECKS = 1;

