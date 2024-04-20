<?php
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

// Fetch demands
$sql = "SELECT id_demande, contenu_demande, type_demande FROM demande";
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
                    <th>Contenu Demande</th>
                    <th>Type Demande</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id_demande"] . "</td>
                                <td>" . $row["contenu_demande"] . "</td>
                                <td>" . $row["type_demande"] . "</td>
                                <td>
                                    <a href='afficher_demande.php?id=" . $row["id_demande"] . "' class='btn btn-info btn-sm mr-2'>Afficher</a>
                                    <a href='modifier_demande.php?id=" . $row["id_demande"] . "' class='btn btn-warning btn-sm mr-2'>Modifier</a>
                                    <a href='supprimer_demande.php?id=" . $row["id_demande"] . "' class='btn btn-danger btn-sm'>Supprimer</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Aucune demande trouvée.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="ajouter_demande.php" class="btn btn-primary">Ajouter</a>
        <a href="Menu_Cadre.php" class="btn btn-secondary">Retour</a>
    </div>
</body>
</html>