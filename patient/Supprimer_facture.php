<?php

include '../database/database.php';

if(isset($_POST['submit']) && $_POST['submit'] == "Supprimer"){

    $id_facture = $_POST['id_facture'] ;
    $requete = $conn->prepare('DELETE FROM system_de_facturation WHERE id_facture = :id_facture ;');
    $requete->bindParam(':id_facture', $id_facture);

    $requete->execute();
    header('location: Afficher_facture.php') ;
    
    
}





?>


