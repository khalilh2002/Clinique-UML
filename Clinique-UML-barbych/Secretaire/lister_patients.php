<?php
include("../CNT.php"); // Inclure le fichier de connexion à la base de données
$conn = connectDB(); // Établir une connexion à la base de données

// Récupérer les données des patients depuis la base de données
$sql = "SELECT * FROM patient";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des patients</title>
    <!-- Styles Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styles CSS personnalisés */
        body {
            background-image: url('back.jpg');
            background-size: cover; /* pour couvrir toute la surface */
            background-position: center; /* centrer l'image */
            background-repeat: no-repeat; /* ne pas répéter l'image */
        }

        .container {
            margin-top: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
            background-color: #ffffff; /* Ajout de la couleur de fond */
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Liste des patients</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Patient</th>
                        <th>Nom complet</th>
                        <th>Genre</th>
                        <th>Date de naissance</th>
                        <th>Email</th>
                        <th>Numéro de téléphone</th>
                        <th>Adresse</th>
                        <th>Type de sang</th>
                        <th>Opération</th> <!-- Nouvelle colonne pour les opérations -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Afficher les données des patients dans le tableau
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>{$row['id_patient']}</td>";
                        echo "<td>{$row['nom_complet']}</td>";
                        echo "<td>{$row['genre']}</td>";
                        echo "<td>{$row['date_naissance']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['num_tel']}</td>";
                        echo "<td>{$row['adresse']}</td>";
                        echo "<td>{$row['type_de_sang']}</td>";
                        echo "<td><a href='modif_pat.php?patientId={$row['id_patient']}' class='btn btn-warning'>Modifier</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
