<?php
$page_title = "Demandes";
require_once "base.php";
session_start(); // Start session

// Check if directeur is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'directeur')  {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hospitale"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch demandes made by cadres_administratif
$sql = "SELECT demande.id_demande, demande.contenu_demande, demande.type_demande, demande.status, cadre_administratif.nom_complet
        FROM demande
        INNER JOIN cadre_administratif ON demande.id_cadre_administratif = cadre_administratif.id_cadre_administratif";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Demandes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Demandes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom Complet Cadre</th>
                    <th>Type Demande</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id_demande"] . "</td>
                                <td>" . $row["nom_complet"] . "</td>
                                <td>" . $row["type_demande"] . "</td>
                                <td>" . $row["status"] . "</td>
                                <td>";
                        
                        // Show Accepter or Refuser button based on demande status
                        if ($row["status"] == 'En Attente') {
                            echo "<a href='accepter_demande.php?id=" . $row["id_demande"] . "' class='btn btn-success btn-sm mr-2'>Accepter</a>
                                  <a href='refuser_demande.php?id=" . $row["id_demande"] . "' class='btn btn-danger btn-sm mr-2'>Refuser</a>";
                        } elseif ($row["status"] == 'Accepté' || $row["status"] == 'Refusé') {
                            echo "<a href='revoquer_demande.php?id=" . $row["id_demande"] . "' class='btn btn-warning btn-sm'>Revoquer Demande</a>";
                        }

                        // Add Voir button
                        echo "<a href='voir_contenu_demande.php?id=" . $row["id_demande"] . "' class='btn btn-primary btn-sm ml-2'>Voir</a>";

                        echo "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucune demande trouvée.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="Menu_Directeur.php" class="btn btn-secondary">Retour</a>
    </div>
</body>
</html>
