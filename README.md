# 🎵 e-Music : Gestion d'École de Musique

![Symfony](https://img.shields.io/badge/Symfony-6.0-black?style=flat&logo=symfony) ![PHP](https://img.shields.io/badge/PHP-8.0-blue) ![MariaDB](https://img.shields.io/badge/Database-MariaDB-orange) ![License](https://img.shields.io/badge/License-MIT-green)

> Une application web complète pour la digitalisation de l'école de musique municipale d'Ifs.

## 📄 À propos
**e-Music** est une solution web développée pour répondre aux besoins de gestion de l'école de musique municipale d'Ifs (300 usagers).
L'objectif est de centraliser les processus administratifs qui étaient auparavant gérés via des fichiers Excel disparates (GEM).

L'application permet de fluidifier :
* Les **inscriptions** administratives et la gestion des familles.
* Le suivi du **parc instrumental** (prêts et maintenance).
* La planification pédagogique.

## ✨ Fonctionnalités Clés

### 1. Gestion Administrative & Inscriptions
* **Dossiers Élèves :** Centralisation des informations élèves et responsables légaux.
* **Tarification :** Calcul automatique des coûts selon le quotient familial et le type de cours (individuel/collectif).
* **Suivi des Paiements :** Gestion des échéances (1 à 4 fois) et état des règlements.

### 2. Gestion du Parc Instrumental
* **Inventaire :** Suivi complet des instruments (Marque, Modèle, N° Série, Date d'achat).
* **Prêts :** Gestion des contrats de location avec les familles (état des lieux, dates, assurance).
* **Maintenance :** Historique des réparations et interventions effectuées par des professionnels (luthiers, accordeurs).

### 3. Pédagogie & Planning
* Gestion des cours individuels et collectifs.
* Visualisation des places disponibles par cours.
* Emplois du temps individualisés (Objectif final).

## 🛠 Stack Technique

Conformément au cahier des charges technique :

* **Back-end :** PHP 8, Framework **Symfony 6**.
* **Base de données :** MariaDB (MySQL).
* **ORM :** Doctrine.
* **Front-end :** Twig, Bootstrap, jQuery.
* **Qualité de code :** Respect des standards PSR-12.

## 🚀 Installation

### Prérequis
* PHP 8.x
* Composer
* Symfony CLI
* Serveur MariaDB

### Étapes de déploiement

1. **Cloner le dépôt**
   ```bash
   git clone (https://github.com/ZakinaA/25ironwill.git)
2. installer les dependance :
    composer install

3. Configuration

Créez un fichier .env.local à la racine.

Configurez votre accès base de données :

DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/emusic_db?serverVersion=mariadb-10.4.10"

4. Base de données Création de la base et exécution des migrations :

Bash

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

5.Données de test (Fixtures) Pour avoir un jeu de données initial (instruments, élèves, cours) :

Bash

php bin/console doctrine:fixtures:load

6. Absolument ! Je comprends tout à fait que ce n'est pas le style habituel d'un README.md sur GitHub.

Je viens d'enlever toutes les balises de citation (``) du code pour que tu aies un document propre et professionnel, prêt à être copié-collé.

Voici le README.md final pour ton projet e-Music :

Markdown

# 🎵 e-Music : Gestion d'École de Musique

![Symfony](https://img.shields.io/badge/Symfony-6.0-black?style=flat&logo=symfony) ![PHP](https://img.shields.io/badge/PHP-8.0-blue) ![MariaDB](https://img.shields.io/badge/Database-MariaDB-orange) ![License](https://img.shields.io/badge/License-MIT-green)

> Une application web complète pour la digitalisation de l'école de musique municipale d'Ifs.

## 📄 À propos
**e-Music** est une solution web développée pour répondre aux besoins de gestion de l'école de musique municipale d'Ifs (300 usagers).
L'objectif est de centraliser les processus administratifs qui étaient auparavant gérés via des fichiers Excel disparates (GEM).

L'application permet de fluidifier :
* Les **inscriptions** administratives et la gestion des familles.
* Le suivi du **parc instrumental** (prêts et maintenance).
* La planification pédagogique.

## ✨ Fonctionnalités Clés

### 1. Gestion Administrative & Inscriptions
* **Dossiers Élèves :** Centralisation des informations élèves et responsables légaux.
* **Tarification :** Calcul automatique des coûts selon le quotient familial et le type de cours (individuel/collectif).
* **Suivi des Paiements :** Gestion des échéances (1 à 4 fois) et état des règlements.

### 2. Gestion du Parc Instrumental
* **Inventaire :** Suivi complet des instruments (Marque, Modèle, N° Série, Date d'achat).
* **Prêts :** Gestion des contrats de location avec les familles (état des lieux, dates, assurance).
* **Maintenance :** Historique des réparations et interventions effectuées par des professionnels (luthiers, accordeurs).

### 3. Pédagogie & Planning
* Gestion des cours individuels et collectifs.
* Visualisation des places disponibles par cours.
* Emplois du temps individualisés (Objectif final).

## 🛠 Stack Technique

Conformément au cahier des charges technique :

* **Back-end :** PHP 8, Framework **Symfony 6**.
* **Base de données :** MariaDB (MySQL).
* **ORM :** Doctrine.
* **Front-end :** Twig, Bootstrap, jQuery.
* **Qualité de code :** Respect des standards PSR-12.

## 🚀 Installation

### Prérequis
* PHP 8.x
* Composer
* Symfony CLI
* Serveur MariaDB

### Étapes de déploiement

1. **Cloner le dépôt**
   ```bash
   git clone [https://github.com/votre-username/e-music.git](https://github.com/votre-username/e-music.git)
   cd e-music
Installer les dépendances

Bash

composer install
Configuration

Créez un fichier .env.local à la racine.

Configurez votre accès base de données :

Extrait de code

DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/emusic_db?serverVersion=mariadb-10.4.10"
Base de données Création de la base et exécution des migrations :

Bash

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
Données de test (Fixtures) Pour avoir un jeu de données initial (instruments, élèves, cours) :

Bash

php bin/console doctrine:fixtures:load
Utilisation
Lancer le serveur de développement local :

Bash

symfony server:start


Crée par Camille Lucas Yahya 
