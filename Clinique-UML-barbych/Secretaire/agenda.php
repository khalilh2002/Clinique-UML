<?php
session_start();
include("../CNT.php"); // Inclure le fichier de connexion à la base de données
$conn = connectDB(); // Établir une connexion à la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional CSS for customization */
        body {
            background-image: url('back.jpg');
            background-size: cover; /* pour couvrir toute la surface */
            background-position: center; /* centrer l'image */
            background-repeat: no-repeat; /* ne pas répéter l'image */
        }
        body {
            padding: 20px;
        }
        .calendar {
            width: 100%;
        }
        .calendar th, .calendar td {
            padding: 10px;
        }
        .calendar th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }
        .event-list {
            list-style: none;
            padding-left: 0;
        }
        .event-list li {
            margin-bottom: 5px;
        }
        .event-list li::before {
            content: "\2022"; /* Bullet character */
            color: #007bff; /* Bootstrap primary color */
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        .search-form {
            margin-bottom: 20px;
        }
        .title-container {
            background-color: #cfe2ff; /* Couleur bleu ciel */
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 10px; /* Bordure arrondie */
        }
        .search-result {
            background-color: #ffa500; /* Couleur orange */
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 10px; /* Bordure arrondie */
        }
        .search-result-icon {
            font-size: 24px;
            color: #ffffff; /* Couleur blanche */
            margin-right: 10px;
        }
        .table {
            background-color: #ffffff; /* Fond blanc pour le tableau */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Titre de l'agenda décoré -->
        <div class="title-container">
            <h2 class="mt-4 mb-4">Agenda</h2>
        </div>

        <!-- Search Form -->
        <form class="search-form" method="get">
            <div class="form-group">
                <label for="search_date">Rechercher par date:</label>
                <input type="date" id="search_date" name="search_date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <!-- Affichage des événements filtrés par date -->
        <?php
        // Vérifier si une date de recherche a été soumise
        if (isset($_GET['search_date'])) {
            $search_date = $_GET['search_date'];

            // Connexion à la base de données avec PDO
            $conn = connectDB();

            // Préparer la requête SQL
            $sql = "SELECT id_agenda, heure_RV, `Docteur_associé` FROM agenda WHERE date_rendez_vous = :search_date";

            // Préparer la requête
            $stmt = $conn->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(':search_date', $search_date);

            // Exécuter la requête
            $stmt->execute();

            // Vérifier s'il y a des résultats
            if ($stmt->rowCount() > 0) {
                echo "<div class='search-result'>";
                echo "<h3><i class='search-result-icon fas fa-calendar-day'></i>Rendez-vous pour le $search_date:</h3>";
                echo "<ul class='event-list'>";
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li>{$row['heure_RV']} - {$row['Docteur_associé']}</li>";
                }
                echo "</ul>";
                echo "</div>";
            } else {
                echo "<div class='search-result'>";
                echo "<p>Aucun rendez-vous trouvé pour la date $search_date</p>";
                echo "</div>";
            }
        }
        ?>

        <!-- Tableau de tous les rendez-vous -->
        <div class="table-responsive">
            <table class="table table-bordered calendar">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Docteur associé</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Préparer la requête SQL pour récupérer tous les rendez-vous
                    $sql_all = "SELECT id_agenda, date_rendez_vous, heure_RV, `Docteur_associé` FROM agenda";

                    // Préparer la requête
                    $stmt_all = $conn->prepare($sql_all);

                    // Exécuter la requête
                    $stmt_all->execute();

                    // Parcourir les résultats et afficher les rendez-vous
                    while($row_all = $stmt_all->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row_all['id_agenda']}</td>";
                        echo "<td>{$row_all['date_rendez_vous']}</td>";
                        echo "<td>{$row_all['heure_RV']}</td>";
                        echo "<td>{$row_all['Docteur_associé']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
