<?php
$page_title = "Demande";
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

// Check if demande ID is set
if (isset($_GET['id'])) {
    $id_demande = $_GET['id'];

    // Fetch demande content and cadre_administratif name
    $sql = "SELECT demande.contenu_demande, cadre_administratif.nom_complet
            FROM demande
            INNER JOIN cadre_administratif ON demande.id_cadre_administratif = cadre_administratif.id_cadre_administratif
            WHERE id_demande=$id_demande";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $contenu_demande = $row['contenu_demande'];
        $nom_complet_cadre = $row['nom_complet'];
    } else {
        echo "Demande not found";
        exit;
    }
} else {
    echo "Demande ID not specified";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenu de la Demande</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 600px;
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
        .info-item {
            margin-bottom: 20px;
        }
        .info-item label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contenu de la Demande</h1>
        <div class="info-item">
            <label for="cadre_administratif">Cadre Administratif:</label>
            <p id="cadre_administratif"><?php echo $nom_complet_cadre; ?></p>
        </div>
        <div class="info-item">
            <label for="contenu_demande">Contenu de la Demande:</label>
            <p id="contenu_demande"><?php echo $contenu_demande; ?></p>
        </div>
        <a href="demandes_directeur.php" class="btn btn-secondary">Retour</a>
    </div>
</body>
</html>
