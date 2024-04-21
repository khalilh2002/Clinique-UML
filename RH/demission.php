<?php
    
    session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user'] != true) {
        
        header('Location: login.php');
        exit; 
    }
?>

<?php
    $page_title = "RH Demission"; // header title from base.php
    require_once "base.php";
?>
<?php 
    require_once "../database/database.php";
    if (isset($_POST["employee_suprimer_submit"] , $_POST['cni_emp'] , $_POST['name_emp'] ,$_POST['categorie'] )) {
        $qry = "DELETE FROM employee 
        WHERE cni = '".$_POST['cni_emp']."'
        AND nom_complet ='".$_POST['name_emp']."' AND
        id_categorie = ".$_POST['categorie']." ";

    
        $stmt = $conn->prepare($qry);

        if (!$stmt->execute()) {
            $message = ['warning' => 'error in deleting employee'];
        }else {
            $message = ['success' => 'employee is deleted'];
        }
    }
?>

<?php 
    if (isset($message)) {

        foreach ($message as $key => $msg) {
            echo '<div class="alert alert-' . $key . '">' . $msg . '</div>';
        }
        unset($message);
    }
?>

<section>
    <div class="card">
        <div class="card-header bg-danger">
            Suprimer
        </div>
        <div class="card-body">
            <form action="demission.php" method="post">

                <h5 class="card-title">donner le CNI</h5>
                <input required type="text" class="form-control" name="cni_emp">
                <br>

                <h5 class="card-title">donner le nom de employee</h5>
                <input required type="text" class="form-control" name="name_emp">

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
                    <select id="inputState" class="form-select" name="categorie">
                        

                        <?php 
                            foreach ($ctg as $row):
                        ?>
                            <option value="<?= $row["id_categorie"] ?>" active > <?= $row["nom"] ?> </option>

                        <?php 
                            endforeach;
                        ?>
                        

                    </select>
                </div>
                                
                            <br>
                <button type="submit" name="employee_suprimer_submit" class="btn btn-danger">Suprimer</button>

            </form>
        </div>
        
    </div>
</section>

<?php
    require_once "footer.php";
?>