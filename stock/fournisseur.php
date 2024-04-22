<?php
include '../database/database.php';

$requete = $conn->prepare('SELECT * FROM commande');
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);

@$id = $_POST['cmd'];

if(isset($_POST['submit']) && $_POST['submit'] == 'Enregistrer'){

    $etat = $_POST['etat'];
    
    $requete = $conn->prepare("INSERT INTO `commande`(`etat`) 
    VALUES (:etat)");

    $requete = $conn->prepare("
    UPDATE `commande`
    SET etat = :etat
    WHERE id_cmd = :id;
    ");
    

    $requete->bindParam(':etat', $etat);
    $requete->bindParam(':id', $id);
    $requete->execute();
    header('location: fournisseur.php');
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
        <div class="card-header d-flex justify-content-between">
            <p>Commandes</p>
            <a class="btn btn-dark" href="Ajouter_commande.php">Ajouter</a>
        </div>
        <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>date_expiration</th>
                    <th>Action</th>
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
                    <td><?php echo $commande->etat?></td>
                    <td>
                    <form action="fournisseur.php" method="post">
                        <div class="row">
                            <select name="etat" class="col form-select my-3 me-3" aria-label="Default select example">
                                <option selected disabled>Choisissez une état</option>
                                <option value="En cours de traitement">En cours de traitement</option>
                                <option value="En attente">En attente</option>
                                <option value="Livraison en cours">Livraison en cours </option>
                                <option value="Livrée">Livrée</option>
                            </select>
                        <input class="col btn btn-success my-3" type="submit" name="submit" value="Enregistrer"> 

                        </div>
                        <input type="hidden" value="<?php echo $commande->id_cmd ?>" name="cmd">
                    </form>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>


            <form action="" method="post">
            </form>
        </div>
    </div>


    </div>
    





    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
