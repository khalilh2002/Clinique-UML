<?php

include '../database/database.php';

$requete = $conn->prepare('SELECT * FROM fournisseur');
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);

@$id = $_POST['cmd'];


if(@$_POST['submit'] == 'Supprimer'){
    $requete = $conn->prepare("DELETE FROM fournisseur WHERE id_fournisseur = :id");
    
    $requete->bindParam(':id', $id);
    $requete->execute();
    header('location: Afficher_fournisseur.php');
}




?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Fournisseur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-image: url('./uml_back.jpg');">
    <?php include 'navbar.php' ?>
    <div class="container d-flex justify-content-center my-5">
        <div class="card" style="width: 78rem;">
        <div class="card-header d-flex justify-content-between">
            <p>Fournisseur</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ajouter
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Fournisseur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include 'Ajouter_fournisseur.php';?>
                </div>
                </div>
            </div>
            </div>

        </div>
        <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom Fournisseur</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $fournisseur){ ?>
                <tr>
                    <td><?php echo $fournisseur->id_fournisseur?></td>
                    <td><?php echo $fournisseur->nom?></td>
                    <td>Medicament</td>
                    <td>
                        <form action="Afficher_fournisseur.php" method="post">
                                <input type="hidden" value="<?php echo $fournisseur->id_fournisseur ?>" name="cmd">
                                <div class="d-flex justify-content-center align-items-center w-25">
                                    <button name="submit" value="Supprimer" type="submit" class="btn btn-danger w-100 me-2">
                                        <i class="fa-solid fa-delete-left"></i>
                                    </button>
                                </div>
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
    





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
