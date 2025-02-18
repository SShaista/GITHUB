<?php
$servername = "mysql"; // Nom du serveur MySQL dans XAMPP
$username = "root";
$password = "rootpassword"; // XAMPP ne met pas de mot de passe par défaut
$dbname = "compte_db";

// Connexion à la base de données MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // Vérification si les mots de passe correspondent
    if ($pass !== $confirm_pass) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier si l'utilisateur existe déjà
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Hachage du mot de passe avant de l'insérer
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Insertion du nouvel utilisateur
            $stmt = $conn->prepare("INSERT INTO utilisateurs (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $user, $hashed_password);
            if ($stmt->execute()) {
                header('Location: login.php'); // Redirection vers la page de connexion
                exit();
            } else {
                $error = "Erreur lors de la création de l'utilisateur.";
            }
        } else {
            $error = "L'utilisateur existe déjà.";
        }
        $stmt->close();
    }
}

// Fermer la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="signup.css"> <!-- Lien vers le fichier CSS -->
    <script src="signup.js"></script>
</head>
<body>
    <div class="container">
        <h2>Créer un compte pour notre intranet</h2>
        
        <!-- Affichage d'erreur s'il existe -->
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

        <!-- Formulaire -->
        <form action="signup.php" method="POST">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirmer le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="Enregistrer">
        </form>

        <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
        <div class="extra-buttons">
            <a href="index.php" class="btn-home">Retour à l'accueil</a>
            <a href="ldap_login.php" class="btn-intranet">Intranet</a>
    </div>
</body>
</html>
