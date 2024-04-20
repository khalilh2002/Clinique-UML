<?php
    $page_title = "RH Home"; // header title from base.php
    require_once "base.php";
?>

<?php 
    if (isset($_GET["action"] )) {
        
        switch ($_GET["action"]) {
            case 'categorie':
                header('location:gerer_categorie.php');
                break;
            case 'employee':
                header('location:gestion_employee.php');
                break;
            case 'demision':
                header('location:demission.php');
                break;

            default:
                # code...
                break;
        }
    }
?>
<main>
    <section>
        <form action="homeRh.php" method="get" >
            <div class="col-lg-6 col-xxl-4 my-5 mx-auto">
                <div class="d-grid gap-2">
                    <button type="submit" name="action" value="categorie" class="btn btn-outline-primary btn-lg" >Gerer Categorie</button>
                    <button type="submit" name="action" value="employee" class="btn btn-outline-primary btn-lg">Gestion Employee</button>
                    <button type="submit" name="action" value="demision" class="btn btn-outline-primary btn-lg">Demission</button>

                </div>
            </div>
        </form>    
    </section>
    
</main>

<?php
    require_once "footer.php";
?>