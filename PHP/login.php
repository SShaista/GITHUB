<?php
session_start();
include('db.php'); // Inclusion de la connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Utilisation d'une requête préparée pour éviter les injections SQL
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Vérification du mot de passe avec password_verify()
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $user;
            header("Location: dashboard.php"); // Redirige vers le tableau de bord
            exit();
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Utilisateur non trouvé.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="login.css">
    <script src="login.js"></script>  
</head>
<body>
    <div class="container">
        <h2>Connexion à notre intranet</h2>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <form action="login.php" method="POST">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Se connecter">
        </form>
        <p>Pas encore de compte ? <a href="signup.php">Créer un compte</a></p>
        <div class="extra-buttons">
            <a href="index.php" class="btn-home">Retour à l'accueil</a>
            <a href="ldap_login.php" class="btn-intranet">Intranet</a>
    </div>
</body>
</html>
