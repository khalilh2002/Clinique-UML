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

// Query to fetch cadre administrative data
$sql = "SELECT id_cadre_administratif, nom_complet, status FROM cadre_administratif";
$result = $conn->query($sql);

// Check if there are rows returned
if ($result->num_rows > 0) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Liste des Cadres Administratifs</title>
        <!-- Bootstrap CSS -->
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
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
        <div class='container'>
            <h1>Liste des Cadres Administratifs</h1>
            <a href='ajouter_cadre.php' class='btn btn-primary mb-3'>Ajouter</a>
            <table class='table'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_cadre_administratif"] . "</td>
                <td>" . $row["nom_complet"] . "</td>
                <td>" . $row["status"] . "</td>
                <td>
                    <a href='modifier_cadre.php?id=" . $row["id_cadre_administratif"] . "' class='btn btn-info btn-sm mr-2'>Modifier</a>
                    <a href='retirer_cadre.php?id=" . $row["id_cadre_administratif"] . "' class='btn btn-danger btn-sm'>Retirer</a>
                </td>
              </tr>";
    }
    echo "</tbody>
        </table>
    </div>
    </body>
    </html>";
} else {
    echo "0 results";
}

$conn->close();
?>
