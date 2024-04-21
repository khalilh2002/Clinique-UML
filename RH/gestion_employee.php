<?php
    
    session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user'] != true) {
        
        header('Location: login.php');
        exit; 
    }
?>

<?php
    $page_title = "RH employee"; // header title from base.php
    require_once "base.php";

?>

<?php
   require_once "../database/database.php";


   if (isset($_GET["search_employee"] , $_GET["keyword"])) {
        $var = $_GET["keyword"];
    }else{
        $var='';
    }



   if (isset($_POST['add_employee'], $_POST['salaire_employee'], $_POST['cni_employee'])) {
       $qry = "
           INSERT INTO employee (nom_complet, salaire, cni, genre, email, num_tel, id_categorie)
           VALUES
               (:var1, :var2, :var3, :var4, :var5, :var6, :var7)
       ";
       $stmt = $conn->prepare($qry);
       $stmt->bindParam(':var1', $_POST['nom_employee']);
       $stmt->bindParam(':var2', $_POST['salaire_employee']);
       $stmt->bindParam(':var3', $_POST['cni_employee']);
       $stmt->bindParam(':var4', $_POST['genre_employee']);
       $stmt->bindParam(':var5', $_POST['email_employee']);
       $stmt->bindParam(':var6', $_POST['telephone_employee']);
       $stmt->bindParam(':var7', $_POST['categorie_employee']);
       
       
       if (!$stmt->execute()) {
           echo "error database";
       }
       $stmt = $conn->prepare("SELECT * FROM employee WHERE id_employee = LAST_INSERT_ID()");
       $stmt->execute();
       $id = $stmt->fetch();

       docteur($_POST, $id);

       

       unset($_POST);
   }

   

?>
<section>
    
    <div class="container mt-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">List Employee</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Ajoute Employee</button>
            </li>
            
        </ul>

        <!-- Tab panes -->
        <div class="tab-content " id="myTabContent">
            <div class="tab-pane fade show active m-3" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <form action="gestion_employee.php" method="get">
                    <div class="input-group my-3 mx-auto ">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-button" name="keyword">
                        <button class="btn btn-outline-secondary" type="submit" name="search_employee">Search</button>
                    </div>
                </form>

                <?php 
                    require_once "../database/database.php";
                    $qry = "SELECT * FROM employee LEFT JOIN categorie on employee.id_categorie = categorie.id_categorie 
                    WHERE nom_complet LIKE '%".$var."%' OR cni LIKE '%".$var."%' OR email LIKE '%".$var."%' OR nom LIKE '%".$var."%'";
                    
                    $stmt = $conn->prepare($qry);
                    
                    if (!$stmt->execute()) {
                        echo "database not executed";
                        exit;
                    }

                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">nom et prenom </th>
                            <th scope="col">salaire</th>
                            <th scope="col">cni</th>
                            <th scope="col">genre</th>
                            <th scope="col">email</th>
                            <th scope="col">telephone</th>
                            <th scope="col">post</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <form action="modifier_employee.php" method="post">
                    <?php 
                    foreach ($data as $row):
                        ?>
                        <tbody>
                            <tr>
                                <th scope="row"> <?= $row["id_employee"] ?> </th>
                                <td><?= $row["nom_complet"] ?></td>
                                <td><?= $row["salaire"] ?> Dh</td>
                                <td><?= $row["cni"] ?></td>
                                <td><?= $row["genre"] ?></td>
                                <td><?= $row["email"] ?></td>
                                <td><?= $row["num_tel"] ?></td>
                                <td><?= $row["nom"] ?></td>
                                <td>
                                    <button type="submit" name="employee_modifier" value="<?= $row["id_employee"] ?>" class="btn btn-outline-success">
                                        Modifier
                                    </button>
                                </td>
                            </tr>
                        </tbody>

                            <?php
                        endforeach
                    ?>
                    </table>
                    </form>
                        
                </div>
            <div class="tab-pane fade m-3" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                <div class="card">
                        <div class="card-header bg-success">
                            Ajouter
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="gestion_employee.php" method="post">
                                <div class="col-md-6">
                                    <label for="nom_employee" class="form-label">Nom et Prenom</label>
                                    <input type="text" class="form-control" id="nom_employee" name="nom_employee">
                                </div>
                                <div class="col-md-6">
                                    <label for="salaire_employee" class="form-label">Salaire</label>
                                    <input type="number" class="form-control" id="salaire_employee" name="salaire_employee"  >
                                </div>
                                
                                
                                <div class="col-md-6">
                                    <label for="cni_employee" class="form-label">CNI</label>
                                    <input type="text" class="form-control" id="cni_employee" name="cni_employee" >
                                </div>
                                <div class="col-md-4">
                                    <label for="inputState" class="form-label">State</label>
                                    <select id="inputState" class="form-select" name="genre_employee">
                                        
                                    <option value="Homme" active >Homme</option>
                                    <option value="Famme" >Famme</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <?php 
                                            require_once "../database/database.php";
                                            $qry = "SELECT * FROM categorie ";
                                            $stmt_ = $conn->prepare($qry);
                                            
                                            if (!$stmt_->execute()) {
                                                echo "database not executed";
                                                exit;
                                            }

                                            $ctg = $stmt_->fetchAll(PDO::FETCH_ASSOC);
                                            
                                        ?>
                                        
                                    <label for="inputState" class="form-label">Post</label>
                                    <select id="inputState" class="form-select" name="categorie_employee">
                                        

                                        <?php 
                                            foreach ($ctg as $row):
                                        ?>
                                            <option value="<?= $row["id_categorie"] ?>" active > <?= $row["nom"] ?> </option>

                                        <?php 
                                            endforeach;
                                        ?>
                                        

                                    </select>
                                </div>
                                

                                <div class="col-12">
                                    <label for="email_employee" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email_employee" name="email_employee" >
                                </div>

                                <div class="col-12">
                                    <label for="telephone_employee" class="form-label">Telephone</label>
                                    <input type="text" class="form-control" id="telephone_employee" name="telephone_employee" >
                                </div>

                                
                                <div class="col-12">
                                    <button type="submit" name="add_employee" class="btn btn-primary">Envoyer</button>
                                </div>
                                
                            </form>

                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</section>
<section>
    
</section>

<?php 
    function docteur($data , $copy){
        /* var_dump($copy);
        var_dump($data); */
        require_once "../database/database.php";
        global $conn;
        $qry = "SELECT nom FROM categorie WHERE id_categorie =".$data["categorie_employee"]."";
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        $x = $stmt->fetch();

        if (strtolower($x['nom']) != 'docteur' && strtolower($x['nom']) != 'infermier' ) {
            return;

        }elseif ($copy["nom_complet"] != $data["nom_employee"] && (strtolower($x['nom']) === 'docteur' || strtolower($x['nom']) === 'infermier' ) ) {
            echo "  
                <script>
                    windows.alert(\"il y a une error , suprimer l'employe et reajouter \");
                </script>
            ";
            return;
        }else{
            switch (strtolower( $x['nom'])) {
                case 'docteur':
                    $qry = "INSERT INTO docteur (nom_complet , salaire , cni , genre , email , num_tel ,id_employee)
                            VALUES('".$copy['nom_complet']."', ".$copy['salaire']." , '".$copy['cni']."' , '".$copy['genre']."',
                            '".$copy['email']."',".$copy['num_tel'].",".$copy['id_employee'].")";
                    $stmt = $conn->prepare($qry);
                    
                    if (!$stmt->execute() ) {
                        echo"
                        <script>
                            windows.alert(\"il y a une error \");
                        </script>
                        ";
                    }

                    
                    break;
                case 'infermier';
                    $qry = "INSERT INTO infermiere (nom_complet , salaire , cni , genre , email , num_tel ,id_employee)
                            VALUES('".$copy['nom_complet']."', ".$copy['salaire']." , '".$copy['cni']."' , '".$copy['genre']."',
                            '".$copy['email']."',".$copy['num_tel'].",".$copy['id_employee'].")";
                    $stmt = $conn->prepare($qry);
                    
                    if (!$stmt->execute() ) {
                        echo"
                        <script>
                            windows.alert(\"il y a une error \");
                        </script>
                        ";
                    }

                    break;
                default:
                    break;
                    
            }
        }
        

        
    }

?>
