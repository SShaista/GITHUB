function validerConnexion() {
    // Récupérer les valeurs des champs
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm_password').value;
    var errorMessage = document.getElementById('error-message');

    // Vérification si les champs sont vides
    if (username === "" || password === "" || confirmPassword === "") {
        errorMessage.innerHTML = "Veuillez remplir tous les champs.";
        errorMessage.style.display = "block";
        return false;
    }

    // Validation du mot de passe (8 caractères, une majuscule et un chiffre)
    var regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!regex.test(password)) {
        errorMessage.innerHTML = "Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.";
        errorMessage.style.display = "block";
        return false;
    }

    // Vérification de la confirmation du mot de passe
    if (password !== confirmPassword) {
        errorMessage.innerHTML = "Les mots de passe ne correspondent pas.";
        errorMessage.style.display = "block";
        return false;
    }

    // Si tout est bon, masquer le message d'erreur
    errorMessage.style.display = "none";

    return true; // Permet d'envoyer le formulaire si toutes les vérifications sont OK
}
