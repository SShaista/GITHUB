<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: ldap_login.php");
    exit();
}

$username = $_SESSION['user']; // Récupère le nom d'utilisateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue sur votre page d'accueil</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="home-container">
        <h1>Bienvenue, <?php echo htmlspecialchars($username); ?> !</h1>
        <p>Vous êtes maintenant connecté à votre espace personnel.</p>
        <div class="welcome-message">
            <h3>Vos informations :</h3>
            <p><strong>Nom d'utilisateur:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p> Nous sommes ravis de vous compter parmis nous, <?php echo htmlspecialchars($username) ?></p> <!-- Adaptez ceci -->
        </div>
        <a href="logout.php" class="logout-btn">Se déconnecter</a>
    </div>
</body>
</html>

