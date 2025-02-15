# SAE AVEC DOCKER

Ce projet est une application web basée sur Docker qui utilise PHP pour le backend, MySQL pour la base de données, et LDAP pour la gestion des utilisateurs. L'objectif est d'intégrer l'authentification et la gestion des comptes à l'aide de Docker et Docker Compose pour un déploiement simplifié.

Structure du Projet : 

L'application est organisée en plusieurs dossiers :

📁 frontend/ → Interface utilisateur (HTML, CSS, JavaScript)
📁 backend/ → Scripts PHP pour l’authentification et la gestion des utilisateurs
📁 database/ → Fichiers SQL pour la base de données
📁 docker/ → Configuration Docker (docker-compose.yml, scripts de lancement)

Arborescence : 

myapp/
├── backend/              # Contient les scripts PHP pour l'authentification et la gestion des utilisateurs
│   ├── login.php         # Page de connexion
│   ├── logout.php        # Déconnexion de l'utilisateur
│   ├── ldap_signup.php   # Inscription via LDAP
│   ├── ldap_login.php    # Connexion via LDAP
│   ├── signout.php       # Déconnexion LDAP
│   ├── home.php          # Page d'accueil après connexion
│   ├── dashboard.php     # Tableau de bord utilisateur
│   ├── index.php         # Page principale
│
├── database/             # Contient les fichiers liés à la base de données MySQL
│   ├── compte_db.sql     # Dump SQL pour créer la base de données
│
├── docker/               # Configuration Docker pour l'environnement de développement
│   ├── docker-compose.yml  # Fichier Docker Compose pour gérer les services
│   ├── ldap1.txt         # Configuration spécifique pour LDAP
│
├── frontend/             # Contient les fichiers du frontend (HTML, CSS, JavaScript)
│   ├── login.html        # Page de connexion
│   ├── ldap_signup.html  # Page d'inscription LDAP
│   ├── ldap_login.html   # Page de connexion LDAP
│   ├── home.html         # Page d'accueil utilisateur
│   ├── dashboard.html    # Tableau de bord utilisateur
│   ├── styles.css        # Feuille de styles principale
│   ├── login.js          # Scripts JS pour validation et gestion du formulaire de connexion
│   ├── ldap_signup.js    # Scripts JS pour l'inscription LDAP
│   ├── ldap_login.js     # Scripts JS pour la connexion LDAP
│   ├── signup.js         # Scripts JS pour l'inscription
│
└── README.md             # Documentation du projet

⚙️ Installation et Déploiement
🛠️ Avant de commencer, assurez-vous d'avoir les outils suivants installés sur votre machine :

Docker
Docker Compose
PHP
Composer
PHPMailer

📌 Étapes d'installation : 

1️⃣ Cloner le projet
git clone https://github.com/votre-utilisateur/votre-repo.git
cd myapp
2️⃣ Installer les dépendances
composer install
3️⃣ Lancer les services avec Docker :  
docker-compose up -d
Cela démarre Apache + PHP, MySQL, phpMyAdmin et LDAP.

4️⃣ Accéder à l'application : 

🌍 Frontend : http://localhost:8080
🛠️ phpMyAdmin : http://localhost:8081
🔐 phpLDAPadmin : http://localhost:8082

📌 Fonctionnalités : 
✅ Inscription et Connexion via MySQL et LDAP
✅ Validation et gestion des erreurs en JavaScript
✅ Envoi d'e-mail sécurisé avec PHPMailer
✅ Docker Compose pour un déploiement facile
✅ Interface web stylisée avec CSS
 
 
