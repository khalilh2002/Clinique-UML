<?php
    session_start();
    if($_SESSION['gerant'] != true){
        header('location: login_stock.php');
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container d-flex justify-content-center align-items-center h-100">
        <div class="card" style="width: 58rem;height: 30rem;">
            <div class="card-header d-flex justify-content-between">
                Menu
            </div>
            <div class="card-body d-flex justify-content-center align-items-center h-100">
                <a href="Afficher_commande.php" class="btn btn-primary btn-lg w-25 mx-3">Commande</a>
                <a href="Afficher_fournisseur.php" class="btn btn-primary btn-lg w-25 mx-3">Fournisseur</a>
                <a href="../patient/Afficher_facture.php" class="btn btn-primary btn-lg w-25 mx-3">Facture</a>
                <a href="logout_stock.php" class="btn btn-primary btn-lg w-25 mx-3">Logout</a>
            </div>
        </div>
    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>