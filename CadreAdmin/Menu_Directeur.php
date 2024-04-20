<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directeur</title>
</head>
<body>
    <h1>Menu Directeur</h1>
    <form action="" method="post">
        <button type="submit" name="cadres">Liste Cadres</button>
        <button type="submit" name="demandes">Liste Demandes</button>
    </form>
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
