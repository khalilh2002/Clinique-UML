<?php
require_once "base.php";
$page_title = "Ajouter Cadre";
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form
    $nom_complet = $_POST['nom_complet'];
    $status = $_POST['status'];

    // Insert cadre_administratif into database
    $sql = "INSERT INTO cadre_administratif (nom_complet, status) VALUES ('$nom_complet', '$status')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to directeur's page
        header("Location: info_directeur.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Cadre Administratif</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajouter un Cadre Administratif</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="nom_complet">Nom Complet</label>
                <input type="text" class="form-control" id="nom_complet" name="nom_complet" required>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirmer</button>
        </form>
    </div>
</body>
</html>
