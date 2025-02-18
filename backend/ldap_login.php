<?php
session_start();

// Connexion LDAP
$ldap_server = "ldap://ldap";
$ldap_base_dn = "ou=users,dc=momo,dc=com";

$message = "";

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $ldap_conn = ldap_connect($ldap_server);
    ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

    $user_dn = "uid=$username,$ldap_base_dn";

    if (@ldap_bind($ldap_conn, $user_dn, $password)) {
        $_SESSION['user'] = $username;
        echo "<script>alert('Connexion réussie ! Redirection vers votre page d\\'accueil.'); window.location.href='home.php';</script>";
        exit();
    } else {
        $message = "Nom d'utilisateur ou mot de passe incorrect.";
    }

    ldap_unbind($ldap_conn);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="ldap.css">
</head>
<body>
    <div class="container">
        <h2>Connexion en temps que particulier</h2>
        <form action="ldap_login.php" method="POST" onsubmit="return checkForm()">
            <input type="text" name="username" id="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <p class="message"><?php echo $message; ?></p>
        <p>Pas encore de compte ? <a href="ldap_signup.php">S'inscrire</a></p>
        <div class="extra-buttons">
            <a href="index.php" class="btn-home">Retour à l'accueil</a>
            <a href="ldap_login.php" class="btn-intranet">Intranet</a>

    </div>


    <script>
        function checkForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (username.trim() === "" || password.trim() === "") {
                alert("Veuillez remplir tous les champs.");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>

