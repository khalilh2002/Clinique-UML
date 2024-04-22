<?php
include '../database/database.php';

if(isset($_POST['submit']) && $_POST['submit'] == 'Enregistrer'){
    $titre = $_POST['titre'];
    $quantity = $_POST['quantity'];
    $date_expiration = $_POST['date_expiration'];
    $description = $_POST['description'];
    $valider = 0; // Valeur par défaut pour le champ valider
    $date_commande = date('Y-m-d H:i:s'); // Obtient la date et l'heure actuelles au format MySQL
    $etat = "Non validé";
    $type = $_POST['type'];

    $requete = $conn->prepare("INSERT INTO `commande`(`Titre`, `date_commande`, `etat`, `date_expiration`, `type`, `description`, `quantité`, `valider`) 
    VALUES (:titre, :date_commande, :etat, :date_expiration, :type, :description, :quantite, :valider)");

    $requete->bindParam(':titre', $titre);
    $requete->bindParam(':date_commande', $date_commande);
    $requete->bindParam(':etat', $etat);
    $requete->bindParam(':date_expiration', $date_expiration);
    $requete->bindParam(':type', $type);
    $requete->bindParam(':description', $description);
    $requete->bindParam(':quantite', $quantity); // Correction du nom du paramètre
    $requete->bindParam(':valider', $valider);
    $requete->execute();
    header('location: Afficher_commande.php');
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
    <div class="container d-flex justify-content-center">
        <div class="card" style="width: 78rem;">
        <div class="card-body">
            <form action="Ajouter_commande.php" method="post">
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Type</label>
                    <div class="col-sm-10">
                        <select name="type" class="form-select " aria-label="Default select example">
                            <option selected disabled>Choisissez un type</option>
                            <option value="Medicament">Médicament</option>
                            <option value="Matériel">Matériel</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                </div>
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Titre</label>
                    <div class="col-sm-10">
                        <input name="titre" class="form-control" type="text" placeholder="Titre" aria-label="default input example">
                    </div>
                </div>
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Description</label>
                        </div>  
                    </div>
                </div>
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input name="quantity" class="form-control " type="number" placeholder="Quantité" aria-label="default input example">
                    </div>
                </div>
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Date Expiration</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                            <div class="form-floating">
                                <input name="date_expiration" class="form-control" type="date" placeholder="Expiration" aria-label="default input example">
                                <label for="floatingInputGroup1">Date Expiration</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end">
                    <input class="btn btn-success" type="submit" name="submit" value="Enregistrer"> <!-- Ajout du nom du bouton -->
                </div>
            </form>
        </div>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
