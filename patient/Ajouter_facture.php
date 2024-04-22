<?php
@session_start();

include '../database/database.php';





if(@$_POST['submit'] == "Enregistrer"){
    $type_facture = $_POST['type_facture'];
    $type_maladie = $_POST['type_maladie'];
    $numero_transaction = $_POST['numero_transaction'];
    $montant_payer = $_POST['montant_payer'];
    $status_paiement = "Non Payer";
    $mode_paiement = $_POST['mode_paiement'];
    $description = $_POST['description'];
    $id_patient = $_POST['id_patient'] ; // test


    if(isset($_POST['id_patient'])){
        $requete = $conn->prepare("SELECT id_patient FROM patient WHERE id_patient = :id_patient LIMIT 1");
        $requete->bindParam(':id_patient', $id_patient);
        $requete->execute(); // Execute the prepared statement
        $result = $requete->fetch(PDO::FETCH_OBJ); // Fetch a single row
    
        if ($result != null) {
            header("location: Afficher_facture.php");
        } else {
            $_SESSION['flash_message'] = "ID Not Found";
            header("location: Ajouter_facture.php");
        }
    }


    $requete = $conn->prepare("INSERT INTO `system_de_facturation`(`id_patient`,`type_facture`, `type_maladie`, `montant_payer`, `status_paiement`, `description`) 
    VALUES (:id_patient, :type_facture, :type_maladie, :montant_payer, :status_paiement, :description)");


    $requete->bindParam(':id_patient', $id_patient);
    $requete->bindParam(':type_facture', $type_facture);
    $requete->bindParam(':type_maladie', $type_maladie);
    $requete->bindParam(':montant_payer', $montant_payer);
    $requete->bindParam(':status_paiement',$status_paiement );
    $requete->bindParam(':description', $description);

    $requete->execute();

}





?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Facture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex justify-content-center my-5">
        

        <div class="card" style="width: 78rem;">
        <div class="card-body">
            <form action="Ajouter_facture.php" method="post">


                <?php    if(isset($_SESSION['flash_message'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                    
                        $message = $_SESSION['flash_message'];
                        unset($_SESSION['flash_message']);
                        echo $message;
                    ?>
                </div>
                <?php } ?>



                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">ID Patient</label>
                    <div class="col-sm-10">
                        <input name="id_patient" class="form-control" type="text" placeholder="ID Patient" aria-label="default input example"  required>
                    </div>
                </div>
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Type de Facture</label>
                    <div class="col-sm-10">
                        <select name="type_facture" class="col form-select me-2" aria-label="Default select example" required>
                            <option selected disabled>Choisissez un Type</option>
                            <option value="Medicament">Médicament</option>
                            <option value="Operation">Operation</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                </div>

                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Type de maladie</label>
                    <div class="col-sm-10">
                        <input name="type_maladie" class="form-control" type="text" placeholder="Type de maladie" aria-label="default input example" required>
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
                    <label for="montant_payer" class="col-sm-2 col-form-label">Montant</label>
                    <div class="col-sm-10">
                        <input name="montant_payer" class="form-control" type="text" placeholder="montant_payer" aria-label="default input example"  required>
                    </div>
                </div>
                
                


                <br>
                
                
                <div class="d-flex justify-content-end">
                    <input class="btn btn-success " type="submit" name="submit" value="Enregistrer"> <!-- Ajout du nom du bouton -->
                </div>
            </form>
        </div>
    </div>


    </div>
    





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
