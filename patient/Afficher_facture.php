<?php
include '../database/database.php';

$requete = $conn->prepare('SELECT * FROM system_de_facturation');
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);


@$id = $_POST['cmd'];





?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Commande</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-image: url('./uml_back.jpg');">
    <?php include './navbar.php' ?>

    <div class="container d-flex justify-content-center my-5">
        <div class="card" style="width: 88rem;">
        <div class="card-header d-flex justify-content-between">
            <p>Facture</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ajouter
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Facture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include 'Ajouter_facture.php';?>
                </div>
                </div>
            </div>
            </div>

        </div>
        <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID patient</th>
                    <th>Type facture</th>
                    <th>Type maladie</th>
                    <th>Description</th>
                    <th>Numero transaction</th>
                    <th>Montant payer</th>
                    <th>Status paiement</th>
                    <th>Mode paiement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $facture){ ?>
                <tr>

                    <td><?php echo $facture->id_patient?></td>
                    <td><?php echo $facture->type_facture?></td>
                    <td><?php echo $facture->type_maladie?></td>
                    <td><?php echo $facture->description?></td>
                    <td><?php echo $facture->numero_transaction?></td>
                    <td><?php echo $facture->montant_payer?> DH</td>
                    <td>
                        <?php 
                            if($facture->status_paiement == "Non Payer"){
                                echo '<span class="badge text-bg-warning">' . $facture->status_paiement . '</span>' ;
                            }else{
                                echo '<span class="badge text-bg-success">' . $facture->status_paiement . '</span>' ;
                            }
                        ?>    
                    </td>
                    <td>
                        <?php 
                            if($facture->mode_paiement == "Espece"){
                                echo '<span class="badge text-bg-light">' . $facture->mode_paiement  . '</span>' . '<i class="fa-solid fa-wallet"></i>';
                            }elseif($facture->mode_paiement == "Par Carte"){
                                echo '<span class="badge text-bg-light">' . $facture->mode_paiement  .'</span>' . '<i class="fa-regular fa-credit-card"></i>' ;
                            }
                        ?> 
                    <td>
                            <div class="d-flex justify-content-center align-items-center w-100">


                                
                                <form action="facture.php" method="post">
                                    <input type="hidden" name="id_facture" value="<?php echo $facture->id_facture?>">
                                    <input type="hidden" name="id_patient" value="<?php echo $facture->id_patient?>">
                                    <input type="hidden" name="type_facture " value="<?php echo $facture->type_facture?>">
                                    <input type="hidden" name="type_maladie" value="<?php echo $facture->type_maladie?>">
                                    <input type="hidden" name="description" value="<?php echo $facture->description?>">
                                    <input type="hidden" name="numero_transaction" value="<?php echo $facture->numero_transaction?>">
                                    <input type="hidden" name="montant_payer" value="<?php echo $facture->montant_payer?>">
                                    <input type="hidden" name="status_paiement" value="<?php echo $facture->status_paiement?>">
                                    <input type="hidden" name="mode_paiement" value="<?php echo $facture->mode_paiement?>">
                                    <button name="submit" value="Voir" type="submit" class="btn btn-success me-2">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </form>


                                <form action="Modifier_facture.php" method="post">
                                    <input type="hidden" name="id_facture" value="<?php echo $facture->id_facture?>">
                                    <input type="hidden" name="id_patient" value="<?php echo $facture->id_patient?>">
                                    <input type="hidden" name="type_facture " value="<?php echo $facture->type_facture?>">
                                    <input type="hidden" name="type_maladie" value="<?php echo $facture->type_maladie?>">
                                    <input type="hidden" name="description" value="<?php echo $facture->description?>">
                                    <input type="hidden" name="numero_transaction" value="<?php echo $facture->numero_transaction?>">
                                    <input type="hidden" name="montant_payer" value="<?php echo $facture->montant_payer?>">
                                    <input type="hidden" name="status_paiement" value="<?php echo $facture->status_paiement?>">
                                    <input type="hidden" name="mode_paiement" value="<?php echo $facture->mode_paiement?>">
                                    <button name="submit" value="Modifier" type="submit" class="btn btn-warning me-2">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </form>
                                

                                <form action="Supprimer_facture.php" method="post">
                                    <input type="hidden" name="id_facture" value="<?php echo $facture->id_facture?>">
                                    <button name="submit" value="Supprimer" type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-delete-left"></i>
                                    </button>
                                </form>

                            </div>

                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>


        </div>
    </div>


    </div>
    





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
