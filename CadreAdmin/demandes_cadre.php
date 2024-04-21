<?php
require_once "base.php";
session_start(); // Start session
// Check if cadre is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'cadre_administratif') {
    header("Location: login.php"); // Redirect to login page if not logged in or not cadre_administratif
    exit;
}

// Include database connection
include 'config.php';

// Retrieve cadre's demands
$id_cadre_admin = $_SESSION['user_id'];
$sql = "SELECT id_demande, contenu_demande, type_demande, Status FROM demande WHERE id_cadre_administratif = $id_cadre_admin";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Demandes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 800px;
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-en-attente {
            background-color: #007bff;
            color: #fff;
        }
        .btn-accepte {
            background-color: #28a745;
            color: #fff;
        }
        .btn-refuse {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
         <!-- Logout button -->
         <a href="logout.php" class="btn btn-danger" style="position: absolute; top: 10px; left: 10px;">Logout</a>
        <h1>Liste des Demandes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type Demande</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id_demande"] . "</td>
                                <td>" . $row["type_demande"] . "</td>
                                <td><button class='btn btn-" . getStatusButtonClass($row["Status"]) . " btn-sm' disabled>" . $row["Status"] . "</button></td>
                                <td>";
                        
                        // Show modifier button only if Status is En Attente
                        if ($row["Status"] == 'En Attente') {
                            echo "<a href='modifier_demande.php?id=" . $row["id_demande"] . "' class='btn btn-warning btn-sm mr-2'>Modifier</a>";
                        }

                        echo "<a href='afficher_demande.php?id=" . $row["id_demande"] . "' class='btn btn-info btn-sm mr-2'>Afficher</a>
                              <a href='supprimer_demande.php?id=" . $row["id_demande"] . "' class='btn btn-danger btn-sm'>Supprimer</a>
                              </td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Aucune demande trouvée.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="ajouter_demande.php" class="btn btn-primary">Ajouter</a>
        <a href="Menu_Cadre.php" class="btn btn-secondary">Retour</a>
    </div>
</body>
</html>

<?php
// Function to get button class based on demande status
function getStatusButtonClass($status) {
    switch ($status) {
        case 'En Attente':
            return 'en-attente';
        case 'Accepté':
            return 'accepte';
        case 'Refusé':
            return 'refuse';
        default:
            return 'secondary';
    }
}
?>
