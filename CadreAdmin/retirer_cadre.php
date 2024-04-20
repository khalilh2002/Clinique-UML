<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hospitale"; // Change to your database name

// Check if ID parameter is set
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the cadre ID
    $id_cadre = $_GET['id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to delete cadre
    $sql = "DELETE FROM cadre_administratif WHERE id_cadre_administratif = $id_cadre";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the cadre list
        header("Location: info_directeur.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    echo "ID parameter not set.";
}
?>
