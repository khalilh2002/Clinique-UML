<?php 
    require_once "../database/database.php";

    if (isset($_POST['username'],$_POST['id'], $_POST['login_rh'])) {
        $qry = "SELECT * FROM cadre_administratif WHERE id_cadre_administratif=".$_POST['id']." AND nom_complet='".$_POST['username']."'";
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        $data_ = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($data_)==0) {
            echo"
                <script>
                    window.alert('id or name is wrong')
                </script>
            ";
        }else{
            session_start();
            $_SESSION['user']=true;
            session_write_close();
            header('location:homeRh.php');
            exit;
            
        }

    }
?>




<?php
    $page_title = "RH login"; // header title from base.php
    $login=true;
    require_once "base.php";

?>

<section>
    <div class="m-5"></div>
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3 login-container">
      <h3 class="mb-4">Login RH</h3>
      <form action="login.php" method="post">
        <div class="mb-3">
          <label for="id" class="form-label">id</label>
          <input type="number" class="form-control" id="id" name="id" required>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">nom complete</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <button type="submit" name="login_rh" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
</div>
</section>

<?php
    require_once "footer.php";
?>