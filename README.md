# SAE AVEC DOCKER

Ce projet est une application web basée sur Docker qui utilise PHP pour le backend, MySQL pour la base de données, et LDAP pour la gestion des utilisateurs. L'objectif est d'intégrer l'authentification et la gestion des comptes à l'aide de Docker et Docker Compose pour un déploiement simplifié.

Structure du Projet : 

L'application est organisée en plusieurs dossiers :

📁 frontend/ → Interface utilisateur (HTML, CSS, JavaScript)
📁 backend/ → Scripts PHP pour l’authentification et la gestion des utilisateurs
📁 SQL/ → Fichiers SQL pour la base de données
📁 docker/ → Configuration Docker (docker-compose.yml, scripts de lancement)

Arborescence : 


 
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
 
 
