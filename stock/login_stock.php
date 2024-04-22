<?php 
    require_once "../database/database.php";

    if (isset($_POST['username'],$_POST['id'], $_POST['login_rh'])) {
      $qry = "SELECT * FROM cadre_administratif AS a, gerant AS g WHERE g.id_gerant=" . $_POST['id'] . " AND a.nom_complet='" . $_POST['username'] . "'";
      $stmt = $conn->prepare($qry);
        $stmt->execute();
        $data_ = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($data_)===0 ) {
          session_start();

          $_SESSION['flash_message'] = "Login Incorrecte !";

        }elseif( strtolower($data_[0]['status'])==='gerant' || strtolower($data_[0]['status'])==='ressource humaine' ){
            session_start();
            $_SESSION['gerant']=true;
            session_write_close();
            header('location:menu.php');
            exit;
            
        }else{
          session_start();

          $_SESSION['flash_message'] = "Login Incorrecte !";
          header('location: login_stock.php');
        }

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
  


<section>
    <div class="m-5"></div>
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3 login-container">
      <h3 class="mb-4 fw-bold text-uppercase lh-lg">Login Responsable de Stock</h3>


      <?php
        @session_start();

        if(isset($_SESSION['flash_message'])) {
      ?>
      <div class="alert alert-danger" role="alert">
      <?php
            $message = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
            echo $message . '</div>';
        }
      ?>
      
      

      <form action="login_stock.php" method="post">
        <div class="mb-3">
          <label for="id" class="form-label fw-bold">ID</label>
          <input type="number" class="form-control" id="id" name="id" required>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label fw-bold">Nom Complet</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <button type="submit" name="login_rh" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>