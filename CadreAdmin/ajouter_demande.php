<?php
session_start(); // Start session
// Check if cadre is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'cadre_administratif') {
    header("Location: login.php"); // Redirect to login page if not logged in or not cadre_administratif
    exit;
}

// Include database connection
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form
    $contenu_demande = $_POST['contenu_demande'];
    $type_demande = $_POST['type_demande'];
    $id_cadre_administratif = $_SESSION['user_id']; // Assign the logged-in cadre's ID

    // Insert demande into database
    $sql = "INSERT INTO demande (contenu_demande, type_demande, id_cadre_administratif, Status) 
            VALUES ('$contenu_demande', '$type_demande', $id_cadre_administratif, 'En Attente')";
    if ($conn->query($sql) === TRUE) {
        header("Location: demandes_cadre.php"); // Redirect to demande_cadre page after successful insertion
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
    <title>Ajouter une Demande</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajouter une Demande</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="contenu_demande">Contenu de la Demande</label>
                <input type="text" class="form-control" id="contenu_demande" name="contenu_demande" required>
            </div>
            <div class="form-group">
                <label for="type_demande">Type de Demande</label>
                <input type="text" class="form-control" id="type_demande" name="type_demande" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirmer</button>
        </form>
    </div>
</body>
</html>
