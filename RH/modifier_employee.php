<?php
    
    session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user'] != true) {
        
        header('Location: login.php');
        exit; 
    }
?>

<?php 
        require_once "../database/database.php";
        if (isset($_POST["employee_modifier"])) {
            //header("location:gestion_employee.php");

            $qry = "SELECT * FROM employee LEFT JOIN categorie on employee.id_categorie = categorie.id_categorie WHERE id_employee =".$_POST["employee_modifier"];
            $stmt = $conn->prepare($qry);
            
            if (!$stmt->execute()) {
                echo "database not executed";
                exit;
            }

            $data = $stmt->fetch();
        }elseif(!isset($_POST["modifer_employee"])){
            header("location:gestion_employee.php");
        }

        
        
?>


<?php 
    if (isset($_POST["modifer_employee"])) {

        $stmt = $conn->prepare("UPDATE employee SET nom_complet = :nom_ , salaire = :salaire_  , cni = :cni_ , genre = :genre_ , email = :email_ , num_tel = :num_tel_ WHERE id_employee = :idToUpdate");
        $stmt->bindParam(':nom_',$_POST["nom_employee"]);
        $stmt->bindParam(':salaire_',$_POST["salaire_employee"]);
        $stmt->bindParam(':cni_',$_POST["cni_employee"]);
        $stmt->bindParam(':genre_',$_POST["genre"]);
        $stmt->bindParam(':email_',$_POST["email_employee"]);
        $stmt->bindParam(':num_tel_',$_POST["telephone_employee"]);
        $stmt->bindParam(':idToUpdate',$_POST["id"]);

        if (!$stmt->execute()) {
            echo "database not executed";
            exit;
        }else{
            echo "ok";
            exit;
        }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifer employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>

<body>
    <div class="m-4 ">
        <div class="card mx-auto">
            <div class="card-body">

                <form class="row g-3" action="modifier_employee.php" method="post">
                    <input type="hidden" name="id" value="<?= $data['id_employee'] ?>">
                    <div class="col-md-6">
                        <label for="nom_employee" class="form-label">Nom et Prenom</label>
                        <input type="text" class="form-control" id="nom_employee" name="nom_employee" value="<?= $data['nom_complet'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="salaire_employee" class="form-label">Salaire</label>
                        <input type="number" class="form-control" id="salaire_employee" name="salaire_employee" value="<?= $data['salaire'] ?>" >
                    </div>
                    
                    
                    <div class="col-md-6">
                        <label for="cni_employee" class="form-label">CNI</label>
                        <input type="text" class="form-control" id="cni_employee" name="cni_employee" value="<?= $data['cni'] ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">State</label>
                        <select id="inputState" class="form-select" name="genre">
                            <?php 
                                if ($data['genre']=="Homme") {
                                    $homme_select = "selected";
                                    $famme_select = "";
                                }else{
                                    $homme_select = "";
                                    $famme_select = "selected";
                                }
                            ?>
                        <option value="Homme" <?= $homme_select ?>>Homme</option>
                        <option value="Famme" <?= $famme_select ?>>Famme</option>
                        </select>
                    </div>
                    

                    <div class="col-12">
                        <label for="email_employee" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_employee" name="email_employee" value="<?= $data['email'] ?>">
                    </div>

                    <div class="col-12">
                        <label for="telephone_employee" class="form-label">Telephone</label>
                        <input type="text" class="form-control" id="telephone_employee" name="telephone_employee" value="<?= $data['num_tel'] ?>">
                    </div>

                    
                    <div class="col-12">
                        <button type="submit" name="modifer_employee" class="btn btn-primary">Enregistre</button>
                        <a href="gestion_employee.php"  class="btn btn-outline-secondary">Annuler</a>
                    </div>
                    
                </form>
            </div>
        </div>    
    </div>
    
   
</body>
</html>