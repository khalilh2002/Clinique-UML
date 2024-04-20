<?php
    $page_title = "RH Home"; // header title from base.php
    require_once "base.php";
?>

<?php 
    if (isset($_GET["action"])) {
        print_r($_GET["action"]);
        exit;
    }
?>
<main>
    <section>
        <div class="d-flex justify-content-center align-items-center">
            <form action="homeRh.php" method="get" >
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" name="action" value="categorie" class="btn btn-outline-primary btn-lg" >Gerer Categorie</button>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" name="action" value="employee" class="btn btn-outline-primary btn-lg">Gestion Employee</button>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" name="action" value="demision" class="btn btn-outline-primary btn-lg">Demission</button>
                    </div>
                
                </div>
            </form>    
        </div>
        
    </section>
</main>

<?php
    require_once "footer.php";
?>