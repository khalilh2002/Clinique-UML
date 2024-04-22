<?php

include '../database/database.php';

$requete = $conn->prepare('SELECT * FROM Commande');
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);

@$id = $_POST['cmd'];

if( @$_POST['submit'] == 'Valider'){
    $requete = $conn->prepare("
    UPDATE Commande
    SET valider = 1 ,
    etat = 'In Progress'
    WHERE id_cmd = :id
    ");
    $requete->bindParam(':id', $id);
    $requete->execute();
    header('location: Afficher_commande.php');
    
}
if(@$_POST['submit'] == 'Supprimer'){
    $requete = $conn->prepare("DELETE FROM Commande WHERE id_cmd = :id");
    
    $requete->bindParam(':id', $id);
    $requete->execute();
    header('location: Afficher_commande.php');
}




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
    <?php include 'navbar.php' ?>

    <div class="container d-flex justify-content-center my-5">
        <div class="card" style="width: 78rem;">
        <div class="card-header d-flex justify-content-between">
            <p>Commande</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ajouter
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Commande</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include 'Ajouter_commande.php';?>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>date_expiration</th>
                    <th>Type</th>
                    <th>Etat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $commande){ ?>
                <tr>
                    <td><?php echo $commande->Titre?></td>
                    <td><?php echo $commande->description?></td>
                    <td><?php echo $commande->quantité?></td>
                    <td><?php echo $commande->date_expiration?></td>
                    <td><?php echo $commande->type?></td>
                    <td>
                        <?php 
                            if($commande->valider == 0){
                                echo '<span class="badge rounded-pill text-bg-danger">' . $commande->etat .'</span>' ;
                            }elseif($commande->valider == 1){
                                echo '<span class="badge rounded-pill text-bg-warning">' . $commande->etat .'</span>' ;
                            }
                        
                        ?>
                        
                    </td>
                    <td>
                        <form action="Afficher_commande.php" method="post">
                            <?php if($commande->valider != 1){?>
                                <input type="hidden" value="<?php echo $commande->id_cmd ?>" name="cmd">
                                <div class="d-flex justify-content-center align-items-center w-100">
                                    <button name="submit" value="Valider" type="submit" class="btn btn-success w-100 me-2">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                    <button name="submit" value="Supprimer" type="submit" class="btn btn-danger w-100 me-2">
                                        <i class="fa-solid fa-delete-left"></i>
                                    </button>
                                </div>
                            <?php }else{?>
                                <div class="d-flex justify-content-center align-items-center">
                                    <button disabled name="submit" value="Valider" type="button" class="btn btn-outline-success  me-2">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </div>
                            <?php }?>
                        </form>
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
