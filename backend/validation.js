document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signup-form");
    const errorMessage = document.getElementById("error-message");

    form.addEventListener("submit", function (event) {
        var username = document.getElementById("username").value.trim();
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;

        errorMessage.innerHTML = "";
        errorMessage.style.display = "none";

        let errors = [];

        if (username === "" || password === "" || confirmPassword === "") {
            errors.push("Veuillez remplir tous les champs.");
        }

        var regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
        if (!regex.test(password)) {
            errors.push("Le mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.");
        }

        if (password !== confirmPassword) {
            errors.push("Les mots de passe ne correspondent pas.");
        }

        if (errors.length > 0) {
            errorMessage.innerHTML = errors.join("<br>");
            errorMessage.style.display = "block";
            event.preventDefault();
        }
    });
});

