<?php
session_start();
include("../CNT.php"); // Inclure le fichier de connexion à la base de données
$conn = connectDB(); // Établir une connexion à la base de données

// Initialisation de la variable de succès
$success_message = "";

// Vérifier si le formulaire a été soumis et si la note est renseignée
if(isset($_POST['submit_note'])) {
    $id_patient = $_POST['id_patient'];
    $note = $_POST['note'];
    try {
            // Requête pour insérer la note dans le dossier médical avec l'ID du patient
        $sql_insert_note = "INSERT INTO doussier_medical (`id_doussier_medical`, `Note du médecin`) VALUES (:id_patient, :note)";
        $stmt_insert_note = $conn->prepare($sql_insert_note);
        $stmt_insert_note->bindParam(':id_patient', $id_patient);
        $stmt_insert_note->bindParam(':note', $note);
        
        // Exécution de la requête
        if($stmt_insert_note->execute()) {
            $success_message = "Note ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la note.";
    }//code...
    } catch (PDOException $e) {
        
        $sql_update_note = "UPDATE doussier_medical SET `Note du médecin` = :note WHERE id_doussier_medical = :id_patient";
        $stmt_update_note = $conn->prepare($sql_update_note);
        $stmt_update_note->bindParam(':note', $note);
        $stmt_update_note->bindParam(':id_patient', $id_patient);
        
        // Exécution de la requête
        if($stmt_update_note->execute()) {
            $success_message = "Note mise à jour avec succès.";
        } else {
            $error_message = "Erreur lors de la mise à jour de la note.";
        }
    }

   
}

// Vérifier si l'ID du patient est spécifié
if(isset($_GET['id_patient'])) {
    $id_patient = $_GET['id_patient'];

    // Requête pour récupérer les informations du patient
    $sql_patient = "SELECT * FROM patient WHERE id_patient = :id_patient";
    $stmt_patient = $conn->prepare($sql_patient);
    $stmt_patient->bindParam(':id_patient', $id_patient);
    $stmt_patient->execute();
    $patient = $stmt_patient->fetch(PDO::FETCH_ASSOC);

    // Vérifier si la requête a renvoyé un résultat valide pour le patient
    if ($patient) {
        // Requête pour récupérer la note du dossier médical
        $sql_dossier = "SELECT `Note du médecin` FROM doussier_medical WHERE id_doussier_medical = :id_patient";
        $stmt_dossier = $conn->prepare($sql_dossier);
        $stmt_dossier->bindParam(':id_patient', $id_patient);
        $stmt_dossier->execute();
        $dossier = $stmt_dossier->fetch(PDO::FETCH_ASSOC);
    } else {
        // Si aucun patient n'est trouvé, initialiser $dossier à null pour éviter l'erreur
        $dossier = null;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dossier Médical</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional CSS for customization */
        body {
            background-image: url('back.jpg');
            background-size: cover; /* pour couvrir toute la surface */
            background-position: center; /* centrer l'image */
            background-repeat: no-repeat; /* ne pas répéter l'image */
        }
        body {
            padding: 20px 20px 100px; /* Ajout de padding en haut pour éviter que le texte ne soit collé au bord */
        }
        .container {
            padding-top: 50px; /* Ajout de padding en haut pour centrer le titre */
        }
        .title-container {
            background-color: #f0f0f0; /* Couleur de fond du div */
            border-radius: 15px; /* Bordure arrondie */
            padding: 20px; /* Espacement interne */
            margin-bottom: 20px; /* Marge en bas pour séparer du contenu suivant */
        }
        .note-container {
            background-color: #f0f0f0; /* Couleur de fond du div */
            border-radius: 15px; /* Bordure arrondie */
            padding: 20px; /* Espacement interne */
            margin-top: 20px; /* Marge en haut pour séparer du titre */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Alerte de succès -->
        <?php if(!empty($success_message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success_message; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <!-- Titre décoré -->
        <div class="title-container text-center">
            <h2 style="color: orange;">Dossier Médical</h2>
        </div>

        <!-- Formulaire de recherche par ID patient -->
        <form method="GET">
            <div class="form-group">
                <label for="id_patient">ID Patient :</label>
                <input type="text" id="id_patient" name="id_patient" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <!-- Affichage des informations du patient et de la note du dossier médical -->
        <?php if(isset($patient) && isset($dossier)): ?>
            <div class="note-container">
                <h4>Informations du patient :</h4>
                <p><strong>Nom :</strong> <?php echo $patient['nom_complet']; ?></p>
                <p><strong>Genre :</strong> <?php echo $patient['genre']; ?></p>
                <p><strong>Date de Naissance :</strong> <?php echo $patient['date_naissance']; ?></p>
                <p><strong>Email :</strong> <?php echo $patient['email']; ?></p>
                <p><strong>Numéro de téléphone :</strong> <?php echo $patient['num_tel']; ?></p>
                <p><strong>Adresse :</strong> <?php echo $patient['adresse']; ?></p>
                <p><strong>Type de Sang :</strong> <?php echo $patient['type_de_sang']; ?></p>
                <hr>
                <h4>Note du dossier médical :</h4>
                <p><?php echo isset($dossier['Note du médecin']) ? $dossier['Note du médecin'] : ""; ?></p>

                <!-- Formulaire pour écrire la note -->
                <form method="POST" class="mt-4">
                    <input type="hidden" name="id_patient" value="<?php echo $id_patient; ?>">
                    <div class="form-group">
                        <label for="note">Écrire une note dans le dossier médical :</label>
                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                    </div>
                    <button type="submit" name="submit_note" class="btn btn-primary">Enregistrer la note</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
