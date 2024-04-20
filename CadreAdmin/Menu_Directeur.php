<?php
    $page_title = "RH Categorie"; // header title from base.php
    require_once "base.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directeur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            margin: 10px 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
         <!-- Logout button -->
         <a href="logout.php" class="btn btn-danger" style="position: absolute; top: 10px; left: 10px;">Logout</a>
        <h1>Menu Directeur</h1>
        <form action="" method="post">
            <button type="submit" name="cadres">Liste Cadres</button>
            <button type="submit" name="demandes">Liste Demandes</button>
        </form>
    </div>
</body>
</html>

<?php
// Check if a button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["cadres"])) {
        // Redirect to the page for listing cadres
        header("Location: info_directeur.php");
        exit;
    } elseif (isset($_POST["demandes"])) {
        // Redirect to the page for listing demands
        header("Location: demandes_directeur.php");
        exit;
    }
}
?>
<?php
    require_once "footer.php";
?>