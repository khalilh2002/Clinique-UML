<?php
session_start(); // Start session
// Check if cadre is logged in
if (!isset($_SESSION['id_cadre_administratif'])) {
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

// Retrieve cadre administratif information
$id_cadre_admin = $_SESSION['id_cadre_administratif'];
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
        <h1>Informations du Cadre Administratif</h1>
        <div class="info-item">
            <label for="nom">Nom Complet:</label>
            <p id="nom"><?php echo $nom_complet; ?></p>
        </div>
        <div class="info-item">
            <label for="status">Status:</label>
            <p id="status"><?php echo $status; ?></p>
        </div>
    </div>
</body>
</html>
