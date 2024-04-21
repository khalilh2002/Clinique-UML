<?php
require_once "base.php";
$page_title = "Ajouter Demande";
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

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO demande (contenu_demande, type_demande, id_cadre_administratif, Status) VALUES (?, ?, ?, 'En Attente')");
    $stmt->bind_param("ssi", $contenu_demande, $type_demande, $id_cadre_administratif);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: demandes_cadre.php"); // Redirect to demande_cadre page after successful insertion
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
    // Close connection
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
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Ajouter une Demande</h1>
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="contenu_demande">Contenu de la Demande</label>
                        <textarea class="form-control" id="contenu_demande" name="contenu_demande" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="type_demande">Type de Demande</label>
                        <input type="text" class="form-control" id="type_demande" name="type_demande" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmer</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
