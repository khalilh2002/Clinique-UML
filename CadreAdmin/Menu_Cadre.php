<?php
session_start();

// Check if the user is not logged in as cadre_administratif
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'cadre_administratif') {
    header("Location: login.php");
    exit; // Stop further execution
}

// Database connection
include 'config.php';

// Fetch demands
$sql = "SELECT id_demande, contenu_demande, type_demande FROM demande";
$result = $conn->query($sql);
$page_title = "Menu"; // header title from base.php
require_once "base.php"; // Including base.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadre Administratif - Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            margin: 10px 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logout button -->
        <a href="logout.php" class="btn btn-danger" style="position: absolute; top: 10px; left: 10px;">Logout</a>
        <h1>Cadre Administratif</h1>
        <form action="" method="post">
            <button type="submit" name="informations">Informations</button>
            <button type="submit" name="demandes">Demandes</button>
        </form>
    </div>
</body>
</html>

<?php
// Check if a button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["informations"])) {
        // Redirect to the page for cadre administrative informations
        header("Location: info_cadres.php");
        exit;
    } elseif (isset($_POST["demandes"])) {
        // Redirect to the page for listing demands
        header("Location: demandes_cadre.php");
        exit;
    }
}
?>
