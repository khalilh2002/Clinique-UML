<?php

include '../database/database.php';



if(!isset($_POST['id_patient'])){
    header('location: Afficher_facture.php');
}
$result = null; // Initialisation de $result en dehors des conditions

if(isset($_POST['submit']) && $_POST['submit'] == "Modifier"){

    $id_patient = $_POST['id_patient'];
    $id_facture = $_POST['id_facture'];

    $requete1 = $conn->prepare("SELECT * FROM system_de_facturation WHERE id_patient = :id_patient AND id_facture = :id_facture");
    $requete1->bindParam(':id_patient', $id_patient);
    $requete1->bindParam(':id_facture', $id_facture);
    $requete1->execute(); // Execute the prepared statement 
    $result = $requete1->fetch(PDO::FETCH_OBJ); // Fetch a single row
}

if(isset($_POST['submit']) && $_POST['submit'] == "Enregistrer"){
    
    // Assurez-vous que les variables POST sont définies avant de les utiliser
    if(isset($_POST['type_facture']) && isset($_POST['type_maladie']) && isset($_POST['montant_payer']) && isset($_POST['mode_paiement']) && isset($_POST['description']) && isset($_POST['id_patient']) ){
        $type_facture = $_POST['type_facture'];
        $type_maladie = $_POST['type_maladie'];
        $montant_payer = $_POST['montant_payer'];
        $status_paiement = $_POST['status_paiement'];
        $mode_paiement = $_POST['mode_paiement'];
        $description = $_POST['description'];
        $id_patient = $_POST['id_patient'] ; 
        $numero_transaction = $_POST['numero_transaction'] ; 

        $requete = $conn->prepare("UPDATE system_de_facturation 
                               SET 
                                    numero_transaction = :numero_transaction, 
                                   type_facture = :type_facture, 
                                   type_maladie = :type_maladie, 
                                   montant_payer = :montant_payer, 
                                   status_paiement = :status_paiement, 
                                   mode_paiement = :mode_paiement, 
                                   description = :description
                               WHERE 
                                   id_patient = :id_patient");

        $requete->bindParam(':id_patient', $id_patient);
        $requete->bindParam(':numero_transaction', $numero_transaction);
        $requete->bindParam(':type_facture', $type_facture);
        $requete->bindParam(':type_maladie', $type_maladie);
        $requete->bindParam(':montant_payer', $montant_payer);
        $requete->bindParam(':status_paiement', $status_paiement);
        $requete->bindParam(':mode_paiement', $mode_paiement);
        $requete->bindParam(':description', $description);

        // Execute the prepared statement
        $requete->execute();
        header('location: Afficher_facture.php');
        // Gérer le cas où les variables POST ne sont pas définies
    }
    else{
        header('location: Afficher_facture.php');
    }
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
            <form action="Modifier_facture.php" method="post">
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">ID Patient</label>
                    <div class="col-sm-10">
                        <input name="id_patient" class="form-control" type="text" placeholder="ID Patient" aria-label="default input example" value="<?php echo $result->id_patient ?>">
                    </div>
                </div>
                <div class="row my-3">
                    <label for="type_facture" class="col-sm-2 col-form-label">Type de Facture</label>
                    <div class="col-sm-10">
                        <select name="type_facture" class="col form-select me-2" aria-label="Default select example">
                            <option selected disabled value="<?php echo $result->type_facture ?>"><?php echo $result->type_facture ?></option>
                            <option value="Medicament">Médicament</option>
                            <option value="Operation">Operation</option>
                            <option value="Autre">Autre</option>
                        </select>
                        <input name="type_autre" class="col form-control my-3" type="text" placeholder="Autre" aria-label="default input example">
                    </div>
                </div>

                <div class="row my-3">
                    <label for="type_maladie" class="col-sm-2 col-form-label">Type de maladie</label>
                    <div class="col-sm-10">
                        <input name="type_maladie" class="form-control" type="text" placeholder="Type de maladie" aria-label="default input example">
                    </div>
                </div>
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"><?php echo $result->description ?></textarea>
                            <label for="floatingTextarea2">Description</label>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Numero de transaction</label>
                    <div class="col-sm-10">
                        <input name="numero_transaction" class="form-control" type="text" placeholder="numero_transaction" aria-label="default input example" >
                    </div>
                </div>
                <div class="row my-3">
                    <label for="montant_payer" class="col-sm-2 col-form-label">Montant</label>
                    <div class="col-sm-10">
                        <input value="<?php echo $result->montant_payer ?>" name="montant_payer" class="form-control" type="text" placeholder="montant_payer" aria-label="default input example">
                    </div>
                </div>
                <div class="row my-3">
                    <label for="status_paiement" class="col-sm-2 col-form-label">Status de Paiment</label>
                    <div class="col-sm-10">
                        <select name="status_paiement" class="form-select me-2" aria-label="Default select example">
                            <option selected disabled value="<?php echo $result->status_paiement ?>"><?php echo $result->status_paiement ?></option>
                            <option value="Payer">Payer</option>
                            <option value="Non Payer">Non Payer</option>
                        </select>
                    </div>
                </div>
                <div class="row my-3">
                    <label for="id_patient" class="col-sm-2 col-form-label">Mode de Paiment</label>
                    <div class="col-sm-10">
                        <select name="mode_paiement" class="form-select me-2" aria-label="Default select example">
                            <option selected disabled value="<?php echo $result->mode_paiement ?>"><?php echo $result->mode_paiement ?></option>
                            <option value="Medicament">Espece</option>
                            <option value="Matériel">Par Carte</option>
                        </select>
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
