<?php
require_once "base.php";
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

// Get data from form
$nom_complet = $_POST['nom_complet'];
$status = $_POST['status'];

// Prepare and execute SQL query to insert cadre
$sql = "INSERT INTO cadre_administratif (nom_complet, status) VALUES ('$nom_complet', '$status')";

if ($conn->query($sql) === TRUE) {
    // Redirect back to cadre list page
    header("Location: info_directeur.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
