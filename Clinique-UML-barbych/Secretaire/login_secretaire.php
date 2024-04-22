<?php
include("../CNT.php");
$conn = connectDB();

// Vérification de la présence du paramètre d'erreur dans l'URL
if (isset($_GET['error']) && $_GET['error'] === 'email_incorrect') {
    echo '<div class="alert alert-danger" role="alert">
            L\'adresse email saisie est incorrecte ou introuvable. Veuillez réessayer.
          </div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Secrétaire</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('back.jpg');
            background-size: cover; /* pour couvrir toute la surface */
            background-position: center; /* centrer l'image */
            background-repeat: no-repeat; /* ne pas répéter l'image */
            font-family: Arial, sans-serif;
        }
        
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion Secrétaire</h2>
        <form action="process_login.php" method="post">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required>
            </div>
           
            <button type="submit" class="btn btn-login">Se connecter</button>
        </form>
    </div>
</body>
</html>
