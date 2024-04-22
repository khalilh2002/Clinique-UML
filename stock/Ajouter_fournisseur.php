<?php
include '../database/database.php';

if(isset($_POST['submit']) && $_POST['submit'] == 'Enregistrer'){
    $nom = $_POST['nom'];

    $requete = $conn->prepare("INSERT INTO `fournisseur`(`nom`) 
    VALUES (:nom)");

    $requete->bindParam(':nom', $nom);
    $requete->execute();
    header('location: Afficher_fournisseur.php');
    exit(); // Terminer le script après la redirection
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex justify-content-center mt-5">
        <div class="card" style="width: 78rem;">
        <div class="card-body">
            <form action="Ajouter_fournisseur.php" method="post">
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Nom de Fournisseur</label>
                    <div class="col-sm-10">
                        <input name="nom" class="form-control" type="text" placeholder="Nom de Fournisseur" aria-label="default input example">
                    </div>
                </div>
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                        <select name="type_facture" class="col form-select me-2" aria-label="Default select example" required>
                            <option selected disabled>Choisissez un Type</option>
                            <option value="Medicament">Médicament</option>
                            <option value="Materiel">Materiel</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <input class="btn btn-success" type="submit" name="submit" value="Enregistrer"> <!-- Ajout du nom du bouton -->
                    <a class="btn btn-secondary mx-3" href="Afficher_fournisseur.php">Cancel</a>
                </div>
            </form>
            
        </div>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
