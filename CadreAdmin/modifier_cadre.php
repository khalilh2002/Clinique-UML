<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hospitale"; // Change to your database name

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from form
    $id_cadre = $_POST['id_cadre'];
    $nom_complet = $_POST['nom_complet'];
    $status = $_POST['status'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to update cadre
    $sql = "UPDATE cadre_administratif SET nom_complet='$nom_complet', status='$status' WHERE id_cadre_administratif=$id_cadre";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to directeur info page
        header("Location: info_directeur.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    // Get cadre ID from URL parameter
    $id_cadre = $_GET['id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch cadre details
    $sql = "SELECT nom_complet, status FROM cadre_administratif WHERE id_cadre_administratif = $id_cadre";
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Cadre Administratif</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier un Cadre Administratif</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id_cadre" value="<?php echo $id_cadre; ?>">
            <div class="form-group">
                <label for="nom_complet">Nom Complet</label>
                <input type="text" class="form-control" id="nom_complet" name="nom_complet" value="<?php echo $nom_complet; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo $status; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirmer</button>
        </form>
    </div>
</body>
</html>
