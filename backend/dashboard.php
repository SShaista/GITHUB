<?php
session_start();

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirection si non connecté
    exit();
}

$user = $_SESSION['username']; // Nom de l'utilisateur connecté
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="dashboard.css"> <!-- Lien vers le fichier CSS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Lien vers Chart.js -->
</head>
<body>

    <!-- Barre de navigation latérale -->
    <div class="sidebar">
        <h2>Intranet</h2>
        <ul>
            <li><a href="dashboard.php">🏠 Accueil</a></li>
            <li><a href="#">👤 Profil</a></li>
            <li><a href="logout.php">🚪 Déconnexion</a></li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        <header>
            <h2>Bienvenue dans votre ERP, <?php echo htmlspecialchars($user); ?> !</h2>
        </header>

        <!-- Section des statistiques -->
        <section class="cards">
            <div class="card">
                <h3>Utilisateurs inscrits</h3>
                <p>1245</p>
            </div>
            <div class="card">
                <h3>Visiteurs aujourd'hui</h3>
                <p>325</p>
            </div>
        </section>

        <!-- Section graphique -->
        <section class="chart-container">
            <h3>Évolution des connexions</h3>
            <canvas id="connexionChart"></canvas> <!-- Le graphique s'affichera ici -->
        </section>

        <!-- Tableau des dernières activités -->
        <section class="data-table">
            <h3>Dernières activités</h3>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
                <tr>
                    <td>Jean Dupont</td>
                    <td>Connexion</td>
                    <td>12/02/2024</td>
                </tr>
                <tr>
                    <td>Sophie Martin</td>
                    <td>Modification de profil</td>
                    <td>11/02/2024</td>
                </tr>
            </table>
        </section>
    </div>

    <!-- Script pour afficher le graphique -->
    <script>
        var ctx = document.getElementById('connexionChart').getContext('2d');
        var connexionChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"],
                datasets: [{
                    label: 'Connexions par jour',
                    data: [12, 19, 25, 30, 40, 50, 65], // Exemple de données
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

</body>
</html>
