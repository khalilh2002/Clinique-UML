<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <style>
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Ensure it's behind other content */
            object-fit: cover; /* Cover the entire body */
            opacity: 0.5; /* Optional: Adjust opacity */
        }
    
    </style>
    <!-- Background image -->
    <img class="background-image" src="./images/clinique.jpg" alt="Background Image">
   
    <header class="bg-primary text-white py-4">
        <div class="container">
            <h1 class="text-center tex-white text-uppercase fw-bold">Iberia Hopitale</h1>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <img src="images/hr.png"  class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">RH</h5>
                        <a href="RH/homeRh.php" class="btn btn-primary">Aller a RH</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header ">
                        <img src="images/stock.png"  class="img-fluid " alt="">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Stock</h5>
                        <a href="./stock/menu.php" class="btn btn-primary">Aller a Stock </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <img src="images/admin.png"  class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Admin</h5>
                        <a href="CadreAdmin/login.php" class="btn btn-primary">Aller a Admin</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <img src="images/sec.png"  class="img-fluid" alt="">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Secretaire</h5>
                        <a href="logout.php" class="btn btn-primary">Aller a Secretaire</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, only needed if you want to use Bootstrap JavaScript features like dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
