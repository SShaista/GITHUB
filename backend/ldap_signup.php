<?php
session_start();

// Paramètres du serveur LDAP
$ldap_server = "ldap://ldap"; 
$ldap_port = 389;
$ldap_base_dn = "dc=momo,dc=com";
$ldap_admin_dn = "cn=admin,dc=momo,dc=com";
$ldap_admin_password = "admin";

// Charger PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$error = ""; // Initialiser une variable pour stocker les erreurs

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération et nettoyage des données du formulaire
    $nom      = trim($_POST['nom']);
    $prenom   = trim($_POST['prenom']);
    $email    = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Vérifier la force du mot de passe
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
        $error = "Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.";
    }

    if (empty($error)) {
        // Connexion au serveur LDAP
        $ldap_conn = ldap_connect($ldap_server, $ldap_port);
        if (!$ldap_conn) {
            $error = "Erreur de connexion au serveur LDAP.";
        } else {
            ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

            // Authentification avec l'admin LDAP
            if (!ldap_bind($ldap_conn, $ldap_admin_dn, $ldap_admin_password)) {
                $error = "Erreur d'authentification avec l'admin LDAP.";
            } else {
                // Vérifier si l'utilisateur existe déjà
                $user_dn = "uid=$username,ou=users,$ldap_base_dn";

                $search = ldap_search($ldap_conn, $ldap_base_dn, "(uid=$username)");
                $entries = ldap_get_entries($ldap_conn, $search);

                if ($entries["count"] > 0) {
                    $error = "Cet utilisateur existe déjà.";
                } else {
                    // Ajouter l'utilisateur dans l'annuaire LDAP
                    $entry = [];
                    $entry["objectClass"]   = ["inetOrgPerson", "posixAccount", "top"];
                    $entry["cn"]            = $nom . " " . $prenom;
                    $entry["sn"]            = $nom;
                    $entry["givenName"]     = $prenom;
                    $entry["uid"]           = $username;
                    $entry["mail"]          = $email;
                    $entry["userPassword"]  = "{MD5}" . base64_encode(pack("H*", md5($password)));
                    $entry["homeDirectory"] = "/home/$username";
                    $entry["loginShell"]    = "/bin/bash";
                    $entry["uidNumber"]     = rand(1000, 9999);
                    $entry["gidNumber"]     = 1000;

                    if (ldap_add($ldap_conn, $user_dn, $entry)) {
                        // Envoi d'un email avec PHPMailer
                        $mail = new PHPMailer(true);
                        try {
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username   = 'noreply.lequipe@gmail.com';  // Mettez ici votre adresse no-reply
                            $mail->Password   = 'edolwuyzxohwhzsj';
                            $mail->SMTPSecure = 'ssl';
                            $mail->Port       = 465;
                            $mail->setFrom('noreply@votre-domaine.com', 'Equipe');
                            $mail->addAddress($email, $prenom);
                            $mail->isHTML(true);
                            $mail->Subject = 'Confirmation de votre inscription';
                            $mail->Body = "Bonjour $prenom,<br><br>"
                                        . "Merci de vous être inscrit. Nous sommes très heureux de vous compter parmi nous.<br><br>"
                                        . "<strong>Vos identifiants de connexion :</strong><br>"
                                        . "Nom d'utilisateur : <strong>$username</strong><br>"
                                        . "Mot de passe : <strong>$password</strong><br><br>"
                                        . "Nous vous recommandons de modifier votre mot de passe dès que possible pour des raisons de sécurité.<br><br>"
                                        . "Cordialement,<br>L'équipe";

                            $mail->send();
                        } catch (Exception $e) {
                            $error = "Erreur lors de l'envoi de l'email de confirmation.";
                        }
                    } else {
                        $error = "Erreur lors de l'ajout de l'utilisateur.";
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="ldapp.css">
    <script src="validation.js" defer></script>
</head>
<body>
    <div class="container">
        <h2>Créer un compte</h2>
        <?php if (!empty($error)): ?>
            <p id="error-message" style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
              <form action="ldap_signup.php" method="POST">
      
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>

            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà un compte ? <a href="ldap_login.php">Se connecter</a></p>

        <div class="extra-buttons">
            <a href="index.php" class="btn-home">Retour à l'accueil</a>
            <a href="ldap_login.php" class="btn-intranet">Intranet</a>
            

    </div>
    </div>
</body>
</html>


