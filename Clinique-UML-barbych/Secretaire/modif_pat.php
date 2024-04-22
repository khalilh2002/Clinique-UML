<?php
include("../CNT.php"); // Inclure le fichier de connexion à la base de données


// Récupérer les paramètres d'URL pour vérifier s'il y a un message de succès ou d'erreur
$success = isset($_GET['success']) ? $_GET['success'] : false;
$error = isset($_GET['error']) ? $_GET['error'] : false;
// Vérifier si l'ID du patient est passé en paramètre
if (isset($_GET['patientId'])) {
    $patientId = $_GET['patientId'];

    // Requête pour récupérer les informations du patient
    $conn = connectDB();
    $sql = "SELECT * FROM patient WHERE id_patient = :patientId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':patientId', $patientId);
    $stmt->execute();
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Patient</title>
    <!-- Styles Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('back.jpg');
            background-size: cover; /* pour couvrir toute la surface */
            background-position: center; /* centrer l'image */
            background-repeat: no-repeat; /* ne pas répéter l'image */
        }
        .container {
            margin-top: 50px;
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.3);
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center; /* Centrer le titre en haut */
        }
        .form-group label {
            text-align: right; /* Aligner les titres à droite */
            color: blue;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-container {
            text-align: center; /* Centrer le bouton */
        }
    </style>
</head>
<body>
    <!-- Messages de succès ou d'erreur -->
    <div class="container mt-5">
        <?php if ($success) : ?>
            <div class="alert alert-success" role="alert">
                Les informations du patient ont été mises à jour avec succès.
            </div>
        <?php endif; ?>
        <?php if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                Une erreur s'est produite lors de la mise à jour des informations du patient.
            </div>
        <?php endif; ?>
    </div>

    <div class="container">
        <?php if (isset($patient)) : ?>
        <div class="form-container">
            <h2><b>Modifier les informations du patient</b></h2>
            <form action="traitement_modif_pat.php" method="POST">
                <input type="hidden" name="patientId" value="<?php echo $patient['id_patient']; ?>">
                <div class="form-group">
                    <label for="nom">Nom complet:</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $patient['nom_complet']; ?>">
                </div>
                <div class="form-group">
                    <label for="genre">Genre :</label>
                    <select class="form-control" id="genre" name="genre">
                        <option value="masculin" <?php echo ($patient['genre'] == 'masculin') ? 'selected' : ''; ?>>Masculin</option>
                        <option value="féminin" <?php echo ($patient['genre'] == 'féminin') ? 'selected' : ''; ?>>Féminin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_naissance">Date de naissance:</label>
                    <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?php echo $patient['date_naissance']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $patient['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="tel">Numéro de téléphone:</label>
                    <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo $patient['num_tel']; ?>">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $patient['adresse']; ?>">
                </div>
                <div class="form-group">
                        <div class="form-group">
                        <label for="sang">Type de sang:</label>
                        <select class="form-control" id="sang" name="type_sang">
                            <option value="A+" <?php echo ($patient['type_de_sang'] == 'A+') ? 'selected' : ''; ?>>A+</option>
                            <option value="A-" <?php echo ($patient['type_de_sang'] == 'A-') ? 'selected' : ''; ?>>A-</option>
                            <option value="B+" <?php echo ($patient['type_de_sang'] == 'B+') ? 'selected' : ''; ?>>B+</option>
                            <option value="B-" <?php echo ($patient['type_de_sang'] == 'B-') ? 'selected' : ''; ?>>B-</option>
                            <option value="AB+" <?php echo ($patient['type_de_sang'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                            <option value="AB-" <?php echo ($patient['type_de_sang'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                            <option value="O+" <?php echo ($patient['type_de_sang'] == 'O+') ? 'selected' : ''; ?>>O+</option>
                            <option value="O-" <?php echo ($patient['type_de_sang'] == 'O-') ? 'selected' : ''; ?>>O-</option>
                        </select>
                    
                </div>
                <script>
                    function updateSang() {
                        var select = document.getElementById("sang-select");
                        var input = document.getElementById("sang");
                        input.value = select.value;
                    }
                </script>
                <div class="btn-container"> <!-- Ajoutez cette classe pour le conteneur du bouton -->
                    <button type="submit" class="btn btn-primary"><b>Enregistrer</b></button>
                </div>
            </form>
        </div>
        <?php else : ?>
        <div class="alert alert-danger" role="alert">
            Patient non trouvé.
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
