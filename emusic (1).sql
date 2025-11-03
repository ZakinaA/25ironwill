-- couleurs
INSERT INTO couleur (id, nom) VALUES
(1, 'Rouge'),
(2, 'Bleu'),
(3, 'Vert'),
(4, 'Noir');

-- marques
INSERT INTO marque (id, libelle) VALUES
(1, 'Yamaha'),
(2, 'Fender'),
(3, 'Gibson'),
(4, 'Korg');

-- tranches
INSERT INTO tranche (id, libelle, quotient_mini) VALUES
(1, 'A', 0),
(2, 'B', 500),
(3, 'C', 1000),
(4, 'D', 1500);

-- métiers
INSERT INTO metier (id, libelle) VALUES
(1, 'Luthier'),
(2, 'Réparateur'),
(3, 'Technicien son'),
(4, 'Accordeur');

-- types
INSERT INTO type (id, nom) VALUES
(1, 'Cordes'),
(2, 'Percussions'),
(3, 'Claviers'),
(4, 'Vent');

-- classe_instrument
INSERT INTO classe_instrument (id, libelle) VALUES
(1, 'Guitare'),
(2, 'Batterie'),
(3, 'Piano'),
(4, 'Saxophone');

-- type_instrument (en respectant les FK)
INSERT INTO type_instrument (id, classe_instrument_id, classeinstrument_id, libelle) VALUES
(1, 1, NULL, 'Electrique'),
(2, 1, NULL, 'Acoustique'),
(3, 2, NULL, 'Standard'),
(4, 3, NULL, 'Numérique');

-- professionnel
INSERT INTO professionnel (id, nom, num_rue, rue, copos, ville, tel, mail) VALUES
(1, 'Dupont', 10, 'Rue des Lilas', 75001, 'Paris', '0123456789', 'dupont@mail.com'),
(2, 'Martin', 5, 'Avenue Victor', 69002, 'Lyon', '0987654321', 'martin@mail.com'),
(3, 'Durand', 20, 'Boulevard Sud', 31000, 'Toulouse', '0147852369', 'durand@mail.com'),
(4, 'Petit', 8, 'Rue des Fleurs', 13001, 'Marseille', '0178563421', 'petit@mail.com');

-- metier_professionnel
INSERT INTO metier_professionnel (metier_id, professionnel_id) VALUES
(1,1),
(2,2),
(3,3),
(4,4);

-- professeur
INSERT INTO professeur (id, nom, prenom, num_rue, rue, copos, ville, tel, mail) VALUES
(1, 'Bernard', 'Paul', 12, 'Rue du Lac', 75002, 'Paris', 123456789, 'bernard@mail.com'),
(2, 'Moreau', 'Julie', 22, 'Avenue des Champs', 69001, 'Lyon', 987654321, 'moreau@mail.com'),
(3, 'Lemoine', 'Anne', 18, 'Boulevard Est', 31001, 'Toulouse', 111222333, 'lemoine@mail.com'),
(4, 'Girard', 'Marc', 3, 'Rue du Port', 13002, 'Marseille', 444555666, 'girard@mail.com');

-- professeur_type_instrument
INSERT INTO professeur_type_instrument (professeur_id, type_instrument_id) VALUES
(1,1),
(2,2),
(3,3),
(4,4);

-- eleve
INSERT INTO eleve (id, tranche_id, nom, prenom, num_rue, rue, copos, ville, tel, mail) VALUES
(1,1,'Dupuis','Thomas', 11,'Rue du Parc',75003,'Paris', 123456789, 'tdupuis@mail.com'),
(2,2,'Leroy','Sophie', 7,'Avenue de la Gare',69003,'Lyon', 987654321, 'sleroy@mail.com'),
(3,3,'Faure','Lucas', 14,'Boulevard Ouest',31002,'Toulouse', 111222333, 'lfaure@mail.com'),
(4,4,'Blanc','Emma', 19,'Rue du Moulin',13003,'Marseille', 444555666, 'eblanc@mail.com');

-- responsable
INSERT INTO responsable (id, tranche_id, nom, prenom, num_rue, rue, copos, ville, tel, mail) VALUES
(1,1,'Durand','Michel', 21,'Rue du Lac',75004,'Paris', 123123123, 'mdurand@mail.com'),
(2,2,'Garnier','Isabelle', 9,'Avenue Victor',69004,'Lyon', 987987987, 'igarnier@mail.com'),
(3,3,'Colin','Pascal', 17,'Boulevard Nord',31003,'Toulouse', 111111111, 'pcolin@mail.com'),
(4,4,'Marchand','Claire', 23,'Rue du Port',13004,'Marseille', 222222222, 'cmarchand@mail.com');

-- responsable_eleve
INSERT INTO responsable_eleve (responsable_id, eleve_id) VALUES
(1,1),
(2,2),
(3,3),
(4,4);

-- instrument (avec fk marque_id et type_id)
INSERT INTO instrument (id, marque_id, type_id, num_serie, date_achat, prix_achat, utilisation, chemin_image) VALUES
(1, 1, 1, 12345, '2023-01-15', 500.00, 'Enseignement', NULL),
(2, 2, 2, 12346, '2022-05-20', 300.00, 'Location', NULL),
(3, 3, 3, 12347, '2021-09-10', 1000.00, 'Enseignement', NULL),
(4, 4, 4, 12348, '2020-12-01', 750.00, 'Location', NULL);

-- accessoire (fk instrument_id)
INSERT INTO accessoire (id, instrument_id, libelle) VALUES
(1,1,'Étui'),
(2,2,'Cordes'),
(3,3,'Métronome'),
(4,4,'Sourdine');

-- contrat_pret (fk eleve_id, instrument_id)
INSERT INTO contrat_pret (id, eleve_id, instrument_id, date_debut, date_fin, attestation_assurance, etat_detaille_debut, etat_detaille_retour) VALUES
(1,1,1,'2025-01-05','2025-02-20','Assurance A','Bon état','Bon état'),
(2,2,2,'2025-01-05','2025-02-20','Assurance B','Bon état','Bon état'),
(3,3,3,'2025-01-05','2025-02-20','Assurance C','Bon état','Bon état'),
(4,4,4,'2025-01-05','2025-02-20','Assurance D','Bon état','Bon état');

-- intervention (fk professionnel_id, instrument_id)
INSERT INTO intervention (id, professionnel_id, instrument_id, date_debut, date_fin, description, prix, quotite) VALUES
(1,1,1,'2025-01-10','2025-01-15','Réglage corde',100.00,50),
(2,2,2,'2025-01-12','2025-01-16','Réparation caisse',150.00,75),
(3,3,3,'2025-01-20','2025-01-25','Révision générale',200.00,100),
(4,4,4,'2025-01-22','2025-01-28','Changement de pièces',180.00,90);

-- tarif (fk tranche_id, type_id)
INSERT INTO tarif (id, tranche_id, type_id, montant) VALUES
(1,1,1,100.00),
(2,2,2,200.00),
(3,3,3,300.00),
(4,4,4,400.00);
