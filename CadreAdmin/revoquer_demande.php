<?php
session_start(); // Start session

// Check if directeur is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'directeur') {
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

    // Update demande status to "En Attente"
    $sql = "UPDATE demande SET status='En Attente' WHERE id_demande=$id_demande";

    if ($conn->query($sql) === TRUE) {
        header("Location: demandes_directeur.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Demande ID not specified";
}

$conn->close();
?>
