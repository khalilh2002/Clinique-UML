<?php

include '../database/database.php';


if($_POST['submit'] == "Voir"){

    $id_facture = $_POST['id_facture'];

    $requete = $conn->prepare('SELECT * FROM system_de_facturation WHERE id_facture = :id_facture');
    $requete->bindParam(':id_facture', $id_facture);
    $requete->execute();
    $facture = $requete->fetch(PDO::FETCH_OBJ);
    
    $requete = $conn->prepare('SELECT * FROM patient WHERE id_patient = :id_patient');
    $requete->bindParam(':id_patient', $facture->id_patient);
    $requete->execute();
    $patient = $requete->fetch(PDO::FETCH_OBJ);
    
        
}
else{
    header('location: Afficher_facture.php');
}





?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reference de Facture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body style="background-image: url('./uml_back.jpg');">
<div class="container d-flex justify-content-center my-5">
        <div class="card" style="width: 78rem;">
            <div class="card-header d-flex justify-content-between">
                Facture
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col my-3">
                                <div class="row">
                                    <h6 for="id_patient" class="col-sm-2 ">Nom</h6>
                                    <p class="col-sm-10"><?php echo $patient->nom_complet ;   ?></p>
                                </div>
                            </div>
                        </div>

                    </li>
                    <li class="list-group-item">
                        <div class="row my-3">
                            <h6 for="id_patient" class="col-sm-2 ">Date de Naissance</h6>
                            <p class="col-sm-10"><?php echo $patient->date_naissance ;   ?></p>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-3">
                            <h6 for="id_patient" class="col-sm-2 ">Dossier medical n°</h6>
                            <p class="col-sm-10">656</p>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-3">
                            <h6 for="id_patient" class="col-sm-2 ">Numero de transaction</h6>
                            <p class="col-sm-10"><?php echo $facture->numero_transaction ;   ?></p>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-3">
                            <h6 for="id_patient" class="col-sm-2 ">Montant payer</h6>
                            <p class="col-sm-10"><?php echo $facture->montant_payer ;   ?></p>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-3">
                            <h6 for="id_patient" class="col-sm-2 ">Type de Facture</h6>
                            <p class="col-sm-10" style="font-weight: bold;"><?php echo $facture->type_facture ;   ?></p>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row my-3">
                            <h6 for="id_patient" class="col-sm-2 ">Type de Maladie</h6>
                            <p class="col-sm-10"><?php echo $facture->type_maladie ;   ?></p>
                        </div>
                    </li>
                </ul>

                

            </div>
        </div>








<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>