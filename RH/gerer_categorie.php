<?php
    $page_title = "RH Categorie"; // header title from base.php
    require_once "base.php";

    // Set the default active tab dynamically
    $default_tab = isset($_GET['default_tab']) ? $_GET['default_tab'] : 'tab1'; // Change 'tab1' to the desired default tab ID

    // Function to check if a tab should be active
    function isActive($tabId) {
        global $default_tab;
        return $default_tab === $tabId ? 'show active' : '';
    }
    if (isset($_GET["search_employee"] , $_GET["keyword"])) {
        $var = $_GET["keyword"];
    }else{
        $var='';
    }
?>

<?php 
    if (isset($_GET['categorie_add_submit'] , $_GET['name_categorie'])) {
        require_once "../database/database.php";
        
        $qry = 'INSERT INTO categorie(nom) VALUES ( "'.$_GET['name_categorie'].'")';
        $stmt = $conn->prepare($qry);
        if (!$stmt->execute()) {
            $message = ['warning' => 'erro in adding categorie'];
        }else {
            $message = ['success' => 'categorie is added'];
        }

    }
?>

<?php 
    if (isset($_GET['categorie_suprimer_submit'] ,$_GET['id_categorie'], $_GET['name_categorie'])) {
        
        require_once "../database/database.php";
        
        $qry ="DELETE FROM categorie WHERE id_categorie = ".$_GET['id_categorie']." AND nom = '".$_GET['name_categorie']."'" ;      

        
        $stmt = $conn->prepare($qry);
        if (!$stmt->execute()) {
            $message = ['warning' => 'erro in deleting categorie'];
        }else {
            $message = ['success' => 'categorie is deleted'];
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
<div class="container mt-5">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link <?= isActive('tab1') ?>" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">List Categorie</button>
        </li>
        <li class="nav-item " role="presentation">
            <button class="nav-link <?= isActive('tab2') ?>" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">Ajoute Categorie</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?= isActive('tab3') ?>" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3" aria-selected="false">Suprimer Categorie</button>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content m-3" id="myTabContent">
        <div class="tab-pane fade <?= isActive('tab1') ?>" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <form action="gerer_categorie.php" method="get">
                    <div class="input-group my-3 mx-auto ">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-button" name="keyword">
                        <button class="btn btn-outline-secondary" type="submit" name="search_employee">Search</button>
                    </div>
                </form>

            
            <?php 
                require_once "../database/database.php";
                $qry = "SELECT * FROM categorie
                        WHERE nom LIKE '%".$var."%'";

                $stmt = $conn->prepare($qry);
                
                if (!$stmt->execute()) {
                    echo "database not executed";
                    exit;
                }

                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">id</th>
                        <th scope="col">nom</th>
                        
                        </tr>
                    </thead>

            <?php 
                foreach ($data as $row):
                    ?>

                    <tbody class="table-group-divider">
                        
                        <tr>
                            <th scope="row"><?= $row["id_categorie"] ?></th>
                            <td><?= $row["nom"] ?></td>
                        </tr>
                        
                    </tbody>
                    

                    <?php
                endforeach
            ?>
                </table>



        </div>
        <div class="tab-pane fade <?= isActive('tab2') ?>" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
            <div class="card">
                <div class="card-header bg-success">
                    Ajoute
                </div>
                <div class="card-body">
                    <form action="gerer_categorie.php" method="get">

                        <h5 class="card-title">donner le nom de nouveaux categorie</h5>
                        <input required type="text" class="form-control" name="name_categorie">
                        <br>
                        <button type="submit" name="categorie_add_submit" class="btn btn-primary">envoyer</button>
                        <input type="hidden" name="default_tab" value="tab2">

                    </form>
                    
                </div>
            </div>
        </div>
        <div class="tab-pane fade <?= isActive('tab3') ?>" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
            <div class="card">
                <div class="card-header bg-danger">
                    Suprimer
                </div>
                <div class="card-body">
                    <form action="gerer_categorie.php" method="get">

                        <h5 class="card-title">donner le ID de categorie</h5>
                        <input required type="text" class="form-control" name="id_categorie">
                        <br>

                        <h5 class="card-title">donner le nom de categorie</h5>
                        <input required type="text" class="form-control" name="name_categorie">

                        <button type="submit" name="categorie_suprimer_submit" class="btn btn-danger">Suprimer</button>
                        <input type="hidden" name="default_tab" value="tab3">

                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>
</section>


<?php
    require_once "footer.php";
?>