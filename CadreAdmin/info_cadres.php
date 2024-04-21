<?php
require_once "base.php";
session_start(); // Start session
// Check if cadre is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'cadre_administratif') {
    header("Location: login.php"); // Redirect to login page if not logged in or not cadre_administratif
    exit;
}

// Database connection
include 'config.php';

// Retrieve cadre administratif information
$id_cadre_admin = $_SESSION['user_id']; // Assuming the user ID is stored in 'user_id' session variable
$sql = "SELECT nom_complet, status FROM cadre_administratif WHERE id_cadre_administratif = $id_cadre_admin";
$result = $conn->query($sql);

// Check if cadre exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nom_complet = $row['nom_complet'];
    $status = $row['status'];
} else {
    echo "Cadre not found";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations du Cadre Administratif</title>
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
         <!-- Logout button -->
         <a href="logout.php" class="btn btn-danger" style="position: absolute; top: 10px; left: 10px;">Logout</a>
        <h1>Informations du Cadre Administratif</h1>
        <div class="info-item">
            <label for="nom">Nom Complet:</label>
            <p id="nom"><?php echo $nom_complet; ?></p>
        </div>
        <div class="info-item">
            <label for="status">Status:</label>
            <p id="status"><?php echo $status; ?></p>
        </div>
        <a href="Menu_Cadre.php" class="btn btn-secondary">Retour</a>
    </div>
</body>
</html>
