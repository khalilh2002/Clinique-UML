<?php
session_start();

// Include database connection
include 'config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username from the form
    $username = $_POST['username'];

    // SQL to check if the username exists in cadre_administratif table
    $sql_cadre_admin = "SELECT * FROM cadre_administratif WHERE nom_complet = '$username'";

    // SQL to check if the username exists in directeur table
    $sql_directeur = "SELECT * FROM directeur WHERE nom_complet = '$username'";

    // Execute SQL queries
    $result_cadre_admin = $conn->query($sql_cadre_admin);
    $result_directeur = $conn->query($sql_directeur);

    // Check if username exists in cadre_administratif table
    if ($result_cadre_admin->num_rows == 1) {
        $user = $result_cadre_admin->fetch_assoc();
        $_SESSION['user_id'] = $user['id_cadre_administratif'];
        $_SESSION['user_type'] = 'cadre_administratif';
        header("Location: Menu_Cadre.php");
    }
    // Check if username exists in directeur table
    elseif ($result_directeur->num_rows == 1) {
        $user = $result_directeur->fetch_assoc();
        $_SESSION['user_id'] = $user['id_directeur'];
        $_SESSION['user_type'] = 'directeur';
        header("Location: Menu_Directeur.php");
    } else {
        $error = "Nom d'utilisateur incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="username">Nom Complet:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <button type="submit" class="btn btn-primary">Se Connecter</button>
        </form>
    </div>
</body>
</html>
