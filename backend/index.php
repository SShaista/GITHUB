<?php
session_start();
if (isset($_SESSION['username'])) {
    // Si l'utilisateur est connecté, redirige-le vers le tableau de bord
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mon Projet</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Mon Projet</h1>
            </div>
            <ul class="nav-links">
                <!-- Lien de connexion -->
                <li><a href="login.php">Intranet</a></li>
                <!-- Lien vers l'intranet -->
                <li><a href="ldap_login.php">Extranet</a></li>
                                <!-- Lien de connexion -->
                <li><a href="ldap_signup.php">Inscription intranet</a></li>
                <!-- Lien vers l'intranet -->
                <li><a href="signup.php">Inscription extranet</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-text">
            <h2>Bienvenue sur notre plateforme !</h2>
            <p>Créez votre compte et commencez à profiter de nos services exclusifs. Choisissez votre profil pour vous connecter. </p>
            <!-- Boutons d'action -->
            <a href="login.php" class="btn-secondary"> Employés </a>
            <a href="ldap_login.php" class="btn-intranet"> Particulier </a>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Mon Projet - Tous droits réservés</p>
    </footer>
</body>
</html>
