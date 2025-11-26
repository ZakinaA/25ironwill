

INSERT INTO `accessoire` (`id`, `instrument_id`, `libelle`) VALUES
(1, 1, 'Banquette de piano'),
(2, 2, 'Housse de guitare'),
(3, 2, 'Jeu de cordes de rechange'),
(4, 3, 'Bec de saxophone'),
(5, 3, 'Boîte d\'anches'),
(6, 5, 'Paire de baguettes'),
(7, 1, 'Tabouret piano'),
(8, 2, 'Capodastre guitare'),
(9, 3, 'Housse violon'),
(10, 4, 'Pédale sustain'),
(11, 5, 'Clé d\'accord'),
(12, 6, 'Sac batterie'),
(13, 1, 'Protection clavier'),
(14, 2, 'Médiators'),
(15, 3, 'Cordes violon'),
(16, 4, 'Étui flûte'),
(17, 5, 'Anches supplémentaires'),
(18, 6, 'Pads de frappe'),
(19, 1, 'Couvre piano'),
(20, 2, 'Sangle guitare'),
(21, 3, 'Mallettes'),
(22, 4, 'Porte-partition'),
(23, 5, 'Nettoyant saxophone'),
(24, 6, 'Casque batterie'),
(25, 1, 'Réglage piano'),
(26, 2, 'Housse électrique');



INSERT INTO `classe_instrument` (`id`, `libelle`) VALUES
(1, 'Vents'),
(2, 'Cordes'),
(3, 'Percussions'),
(4, 'Claviers');


INSERT INTO `contact` (`id`, `nom`, `email`, `message`) VALUES
(1, 'Julien Leblanc', 'j.leblanc@email.com', 'Bonjour, proposez-vous des cours de ukulélé ?'),
(2, 'Alice Moreau', 'a.moreau@email.com', 'Quels sont les tarifs pour les cours de piano individuels ?'),
(3, 'test', 'tszakj@gmaol.com', 'kj');



INSERT INTO `couleur` (`id`, `nom`) VALUES
(1, 'Noir laqué'),
(2, 'Bois naturel'),
(3, 'Argenté'),
(4, 'Rouge vif');



INSERT INTO `couleur_instrument` (`couleur_id`, `instrument_id`) VALUES
(1, 1),
(2, 4),
(3, 3),
(4, 2);



INSERT INTO `cours` (`id`, `type_id`, `type_instrument_id`, `professeur_id`, `jour_id`, `libelle`, `age_mini`, `heure_debut`, `heure_fin`, `nb_places`, `age_maxi`) VALUES
(1, 2, 1, 1, 1, 'Piano Individuel Lundi', 7, '2025-11-17 14:00:00', '15:00:00', 1, 99),
(2, 1, 2, 2, 2, 'Guitare Collectif Ados', 12, '2025-11-18 17:00:00', '18:00:00', 8, 17),
(3, 1, 6, 3, 3, 'Atelier Batterie', 10, '2025-11-19 16:00:00', '17:30:00', 5, 15),
(4, 2, 4, 3, 5, 'Flûte Individuel Vendredi', 8, '2025-11-21 11:00:00', '12:00:00', 1, 99);


INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20251124125300', '2025-11-24 13:07:14', 18085),
('DoctrineMigrations\\Version20251124131627', '2025-11-24 13:16:31', 359),
('DoctrineMigrations\\Version20251124150848', '2025-11-24 15:08:56', 233),
('DoctrineMigrations\\Version20251124152456', '2025-11-24 15:25:05', 329);



INSERT INTO `eleve` (`id`, `user_id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 4, 'Durand', 'Léo', 10, 'Rue de la Gare', 75010, 'Paris', 612345678, 'leo.durand@example.com'),
(2, 5, 'Martin', 'Clara', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789, 'clara.martin@example.com'),
(3, 7, 'Petit', 'Lucie', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890, 'lucie.petit@example.com'),
(4, 8, 'sdfsdf', 'sdfsdf', 12, 'rue de pierre ', 78500, 'villepaint', 850505055, 'adm@gmail.com'),
(5, 13, 'Lucas', 'Marie', 98, 'hytjyjytjyt', 11515, 'gehtr', 25432543, '1@gmail.com'),
(26, 27, 'Lefevre', 'Anaïs', 1, 'Rue des Acacias', 75012, 'Paris', 612345101, 'eleve21@example.com'),
(27, 28, 'Marchand', 'Tom', 2, 'Avenue Victor Hugo', 69006, 'Lyon', 612345102, 'eleve22@example.com'),
(28, 29, 'Fabre', 'Inès', 3, 'Boulevard de la Liberté', 13001, 'Marseille', 612345103, 'eleve23@example.com'),
(29, 30, 'Germain', 'Lucas', 4, 'Rue du Faubourg', 31000, 'Toulouse', 612345104, 'eleve24@example.com'),
(30, 31, 'Perrin', 'Chloé', 5, 'Place du Marché', 6000, 'Nice', 612345105, 'eleve25@example.com'),
(31, 32, 'Bertrand', 'Noé', 6, 'Rue des Oliviers', 44000, 'Nantes', 612345106, 'eleve26@example.com'),
(32, 33, 'Renaud', 'Élise', 7, 'Rue de la Cathédrale', 67000, 'Strasbourg', 612345107, 'eleve27@example.com'),
(33, 34, 'Colin', 'Antoine', 8, 'Rue Sainte', 34000, 'Montpellier', 612345108, 'eleve28@example.com'),
(34, 35, 'Dupuis', 'Laura', 9, 'Cours Victor', 33000, 'Bordeaux', 612345109, 'eleve29@example.com'),
(35, 36, 'Leclerc', 'Paul', 10, 'Rue Nationale', 59000, 'Lille', 612345110, 'eleve30@example.com'),
(36, 37, 'Boyer', 'Sofia', 11, 'Rue du Parc', 35000, 'Rennes', 612345111, 'eleve31@example.com'),
(37, 38, 'Gautier', 'Hugo', 12, 'Avenue des Arts', 51100, 'Reims', 612345112, 'eleve32@example.com'),
(38, 39, 'Lemoine', 'Sarra', 13, 'Quai de la République', 76600, 'Le Havre', 612345113, 'eleve33@example.com'),
(39, 40, 'Martinez', 'Theo', 14, 'Rue des Capucines', 42000, 'Saint-Étienne', 612345114, 'eleve34@example.com'),
(40, 41, 'Blanchard', 'Mia', 15, 'Boulevard du Port', 83000, 'Toulon', 612345115, 'eleve35@example.com'),
(41, 42, 'Fontaine', 'Léo', 16, 'Rue Gambetta', 38000, 'Grenoble', 612345116, 'eleve36@example.com'),
(42, 43, 'Daniel', 'Zoé', 17, 'Rue de la République', 21000, 'Dijon', 612345117, 'eleve37@example.com'),
(43, 44, 'Arnaud', 'Max', 18, 'Rue des Tanneurs', 49000, 'Angers', 612345118, 'eleve38@example.com'),
(44, 45, 'Girard', 'Lina', 19, 'Rue Jean Jaurès', 30000, 'Nîmes', 612345119, 'eleve39@example.com'),
(45, 46, 'Roux', 'Marc', 20, 'Place Clemenceau', 63000, 'Clermont-Ferrand', 612345120, 'eleve40@example.com');


INSERT INTO `inscription` (`id`, `cours_id`, `eleve_id`, `date_inscription`) VALUES
(1, 1, 1, '2025-11-24'),
(2, 1, 1, '2025-11-24'),
(3, 2, 1, '2025-11-24'),
(4, 4, 1, '2025-11-24'),
(5, 1, 5, '2025-11-24'),
(6, 2, 5, '2025-11-24'),
(7, 3, 5, '2025-11-24'),
(8, 4, 5, '2025-11-24'),
(9, 1, 1, '2025-11-24');


INSERT INTO `instrument` (`id`, `marque_id`, `type_id`, `num_serie`, `date_achat`, `prix_achat`, `utilisation`, `chemin_image`) VALUES
(1, 1, 1, '123456', '2020-05-10', 1200, 'Disponible', 'piano_yamaha_1.jpg'),
(2, 2, 7, '789012', '2021-09-15', 800, 'Indisponible', 'fender_strat_1.jpg'),
(3, 5, 5, '345678', '2019-02-20', 2500, 'École', 'selmer_saxo_1.jpg'),
(4, 1, 3, '901234', '2022-01-30', 450, 'Prêt', 'yamaha_violon_1.jpg'),
(5, 4, 6, '567890', '2021-11-05', 1500, 'École', 'roland_td17_1.jpg'),
(6, 2, 3, 'vio-145', '2025-11-04', 500, 'Stage', NULL),
(7, 1, 1, 'YAM-00001', '2019-03-10', 400, 'Disponible', 'yamaha_p45.jpg'),
(8, 4, 1, 'ROL-00001', '2021-11-05', 1500, 'École', 'roland_fp_10.jpg'),
(9, 1, 2, 'YAM-00002', '2018-07-20', 350, 'Stage', 'yamaha_c40.jpg'),
(10, 2, 2, 'FEN-00001', '2020-09-15', 600, 'Prêt', 'fender_gc_24_nylon.jpg'),
(11, 1, 3, 'YAM-00003', '2022-01-30', 800, 'Indisponible', 'yamaha_v5.jpg'),
(12, 1, 4, 'YAM-00004', '2018-12-01', 450, 'Disponible', 'yamaha_yfl_212.jpg'),
(13, 5, 4, 'SEL-00001', '2023-06-25', 1200, 'Prêt', 'selmer_flute_model.jpg'),
(14, 4, 4, 'ROL-00002', '2024-02-10', 900, 'Stage', 'roland_ae_1000.jpg'),
(15, 1, 5, 'YAM-00005', '2020-05-18', 550, 'Indisponible', 'yamaha_yas_280.jpg'),
(16, 5, 5, 'SEL-00002', '2021-08-22', 2000, 'École', 'selmer_mark_vi.jpg'),
(17, 1, 6, 'YAM-00006', '2019-10-10', 750, 'Disponible', 'yamaha_stage_custom.jpg'),
(18, 4, 6, 'ROL-00003', '2022-07-07', 650, 'Disponible', 'roland_td_1dmk.jpg'),
(19, 1, 6, 'YAM-00007', '2021-12-12', 800, 'Stage', 'yamaha_recording_custom.jpg'),
(20, 1, 7, 'YAM-00008', '2025-03-05', 1000, 'Disponible', 'yamaha_pacifica_112j.jpg'),
(21, 2, 7, 'FEN-00002', '2018-05-29', 1200, 'École', 'fender_stratocaster.jpg'),
(22, 2, 7, 'FEN-00003', '2023-01-01', 1150, 'Indisponible', 'fender_telecaster.jpg'),
(23, 3, 7, 'GIB-00001', '2020-11-11', 2400, 'Disponible', 'gibson_les_paul_standard.jpg'),
(24, 3, 7, 'GIB-00002', '2024-09-09', 2200, 'Stage', 'gibson_sg_standard.jpg'),
(25, 2, 7, 'FEN-00004', '2019-02-28', 1300, 'École', 'fender_jazz_bass.jpg'),
(26, 1, 5, 'YAM-00009', '2022-04-17', 1800, 'Prêt', 'yamaha_yts_62.jpg'),
(27, 2, 2, 'geegr', '2025-11-14', 545, 'Stage', NULL);



INSERT INTO `intervention` (`id`, `professionnel_id`, `instrument_id`, `date_debut`, `date_fin`, `description`, `prix`, `quotite`) VALUES
(1, 2, 1, '2025-09-01', '2025-09-01', 'Accordage annuel piano salle 1', 120, 100),
(2, 1, 4, '2025-10-15', '2025-10-17', 'Réglage chevalet violon prêt n°4', 75, 100),
(3, 3, 3, '2025-11-03', '2025-11-05', 'Remplacement tampons saxophone Selmer', 180, 100);



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


INSERT INTO `metier_professionnel` (`metier_id`, `professionnel_id`) VALUES
(1, 1),
(2, 2),
(3, 3);


INSERT INTO `paiment` (`id`, `inscription_id`, `eleve_id`, `quotient_id`, `montant`, `date_paiment`) VALUES
(1, 18, 4, 2, 96, '2025-11-24'),
(2, 19, 4, 2, 48, '2025-11-24'),
(3, 20, 4, 2, 96, '2025-11-24'),
(4, 1, 1, 3, 126, '2025-11-24'),
(5, 2, 1, 3, 126, '2025-11-24'),
(6, 3, 1, 3, 63, '2025-11-24'),
(7, 4, 1, 3, 126, '2025-11-24'),
(8, 5, 5, NULL, 0, '2025-11-24'),
(9, 6, 5, NULL, 0, '2025-11-24'),
(10, 7, 5, NULL, 0, '2025-11-24'),
(11, 8, 5, NULL, 0, '2025-11-24'),
(12, 9, 1, 3, 126, '2025-11-24');

INSERT INTO `professeur` (`id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 'Dupont', 'Jean-Pierre', 15, 'Rue des Arts', 75001, 'Paris', 611223344, 'jp.dupont@emusic.com'),
(2, 'Durant', 'Marie', 22, 'Boulevard de la Musique', 69002, 'Lyon', 622334455, 'm.durant@emusic.com'),
(3, 'Petit', 'Luc', 8, 'Avenue Mozart', 13001, 'Marseille', 633445566, 'l.petit@emusic.com');



INSERT INTO `professeur_type_instrument` (`professeur_id`, `type_instrument_id`) VALUES
(1, 1),
(2, 2),
(2, 7),
(3, 4),
(3, 5),
(3, 6);

INSERT INTO `professionnel` (`id`, `nom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 'Lutherie & Co', 12, 'Rue des Luthiers', 75005, 'Paris', '0145678901', 'contact@lutherieco.com'),
(2, 'Piano Service', 30, 'Avenue des Claviers', 69003, 'Lyon', '0478901234', 'info@pianoservice.fr'),
(3, 'Vent-Debout', 5, 'Place du Mistral', 13002, 'Marseille', '0491234567', 'reparation@ventdebout.com');


INSERT INTO `responsable` (`id`, `quotient_id`, `user_id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 3, 2, 'Durand', 'Paul', 10, 'Rue de la Gare', 75010, 'Paris', 612345678, 'parent.durand@example.com'),
(2, 5, 3, 'Martin', 'Sophie', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789, 'parent.martin@example.com'),
(3, 1, 6, 'Petit', 'Marc', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890, 'parent.petit@example.com'),
(4, 2, 9, 'Cam', 'mi', 14, 'rue des lilas', 61250, 'conde sur sarthe ', 761704334, 'cam@gmail.com'),
(5, NULL, 10, 'Pierre', 'Pierre', 14, 'rue des lilas', 61250, 'Conde ', 461704334, 'Pierre@gmail.com'),
(6, NULL, 16, 'Annouchhe', 'Lida', 12, 'reu des terbes', 14000, 'Caen', 60606, 'testz@gmail.com');

INSERT INTO `responsable_eleve` (`responsable_id`, `eleve_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);


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

INSERT INTO `tranche_quotient` (`id`, `libelle`, `quotient_min`, `quotient_max`) VALUES
(1, '0 à 250', 0, 250),
(2, '251 à 425', 251, 425),
(3, '426 à 680', 426, 680),
(4, '681 à 935', 681, 935),
(5, '936 à 1800', 936, 1800),
(6, '1801 et supérieur', 1801, 999999);



INSERT INTO `type` (`id`, `nom`) VALUES
(1, 'Collectif'),
(2, 'Individuel');


INSERT INTO `type_instrument` (`id`, `classe_instrument_id`, `classeinstrument_id`, `libelle`) VALUES
(1, NULL, 4, 'Piano'),
(2, NULL, 2, 'Guitare Classique'),
(3, NULL, 2, 'Violon'),
(4, NULL, 1, 'Flûte traversière'),
(5, NULL, 1, 'Saxophone'),
(6, NULL, 3, 'Batterie'),
(7, NULL, 2, 'Guitare Électrique');

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`) VALUES
(1, 'admin@emusic.com', '[\"ROLE_ADMIN\"]', '$2y$13$yourhashedpassword', 'Admin', 'Root', 1, 'Rue de l\'Admin', 75000, 'Paris', 101010101),
(2, 'parent.durand@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Durand', 'Paul', 10, 'Rue de la Gare', 75010, 'Paris', 612345678),
(3, 'parent.martin@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Martin', 'Sophie', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789),
(4, 'eleve.durand@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Durand', 'Leo', 10, 'Rue de la Gare', 75010, 'Paris', 612345678),
(5, 'eleve.martin@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Martin', 'Clara', 20, 'Avenue des Lilas', 69005, 'Lyon', 623456789),
(6, 'parent.petit@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Petit', 'Marc', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890),
(7, 'eleve.petit@example.com', '[\"ROLE_USER\"]', '$2y$13$yourhashedpassword', 'Petit', 'Lucie', 30, 'Boulevard du Port', 13008, 'Marseille', 634567890),
(8, 'adm@gmail.com', '[\"ROLE_ELEVE\"]', '$2y$13$TkX3x0K7MiG.zX.dAvsZiOmWeNx2kkK9i0TI7zy2UwOHkplN5lI1S', 'sdfsdf', 'sdfsdf', 12, 'rue de pierre ', 78500, 'villepaint', 850505055),
(9, 'cam@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$acvRTCgkZ/kNSfGbDChswetf53d2bjSwNVXdqBtqEJFn2Zcec64gi', 'Cam', 'mi', 14, 'rue des lilas', 61250, 'conde sur sarthe ', 761704334),
(10, 'Pierre@gmail.com', '[\"ROLE_RESPONSABLE\"]', '$2y$13$jhBUURux8TjWV.sh7uPr9uLSXA1Sx0dfw9V0MeZzhks8k6ECKLru', 'Pierre', 'Pierre', 14, 'rue des lilas', 61250, 'Conde ', 461704334),
(13, '1@gmail.com', '[\"ROLE_ELEVE\"]', '$2y$13$UCFf6.vh8GyEsDe20jC/JOR/qGyhETPpSljEqIu1KSYSYWlI9hIJi', 'Lucas', 'Marie', NULL, NULL, NULL, NULL, NULL),
(16, 'testz@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$mT0FqmPRQ..SOytB2IaLR.LyXFNqUwMGNFhABXpjHW/a81xl.R.xy', 'Annouchhe', 'Lida', NULL, NULL, NULL, NULL, NULL),
(27, 'eleve21@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash01', 'Lefevre', 'Anaïs', 1, 'Rue des Acacias', 75012, 'Paris', 612345101),
(28, 'eleve22@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash02', 'Marchand', 'Tom', 2, 'Avenue Victor Hugo', 69006, 'Lyon', 612345102),
(29, 'eleve23@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash03', 'Fabre', 'Inès', 3, 'Boulevard de la Liberté', 13001, 'Marseille', 612345103),
(30, 'eleve24@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash04', 'Germain', 'Lucas', 4, 'Rue du Faubourg', 31000, 'Toulouse', 612345104),
(31, 'eleve25@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash05', 'Perrin', 'Chloé', 5, 'Place du Marché', 6000, 'Nice', 612345105),
(32, 'eleve26@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash06', 'Bertrand', 'Noé', 6, 'Rue des Oliviers', 44000, 'Nantes', 612345106),
(33, 'eleve27@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash07', 'Renaud', 'Élise', 7, 'Rue de la Cathédrale', 67000, 'Strasbourg', 612345107),
(34, 'eleve28@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash08', 'Colin', 'Antoine', 8, 'Rue Sainte', 34000, 'Montpellier', 612345108),
(35, 'eleve29@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash09', 'Dupuis', 'Laura', 9, 'Cours Victor', 33000, 'Bordeaux', 612345109),
(36, 'eleve30@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash10', 'Leclerc', 'Paul', 10, 'Rue Nationale', 59000, 'Lille', 612345110),
(37, 'eleve31@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash11', 'Boyer', 'Sofia', 11, 'Rue du Parc', 35000, 'Rennes', 612345111),
(38, 'eleve32@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash12', 'Gautier', 'Hugo', 12, 'Avenue des Arts', 51100, 'Reims', 612345112),
(39, 'eleve33@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash13', 'Lemoine', 'Sarra', 13, 'Quai de la République', 76600, 'Le Havre', 612345113),
(40, 'eleve34@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash14', 'Martinez', 'Theo', 14, 'Rue des Capucines', 42000, 'Saint-Étienne', 612345114),
(41, 'eleve35@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash15', 'Blanchard', 'Mia', 15, 'Boulevard du Port', 83000, 'Toulon', 612345115),
(42, 'eleve36@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash16', 'Fontaine', 'Léo', 16, 'Rue Gambetta', 38000, 'Grenoble', 612345116),
(43, 'eleve37@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash17', 'Daniel', 'Zoé', 17, 'Rue de la République', 21000, 'Dijon', 612345117),
(44, 'eleve38@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash18', 'Arnaud', 'Max', 18, 'Rue des Tanneurs', 49000, 'Angers', 612345118),
(45, 'eleve39@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash19', 'Girard', 'Lina', 19, 'Rue Jean Jaurès', 30000, 'Nîmes', 612345119),
(46, 'eleve40@example.com', '[\"ROLE_USER\"]', '$2y$13$dummyhash20', 'Roux', 'Marc', 20, 'Place Clemenceau', 63000, 'Clermont-Ferrand', 612345120);