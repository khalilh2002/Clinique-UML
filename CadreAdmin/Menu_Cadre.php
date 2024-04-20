<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadre Administratif</title>
</head>
<body>
    <h1>Cadre Administratif</h1>
    <form action="" method="post">
        <button type="submit" name="informations">Informations</button>
        <button type="submit" name="demandes">Demandes</button>
    </form>
</body>
</html>

<?php
// Check if a button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["informations"])) {
        // Redirect to the page for cadre administrative informations
        header("Location: info_cadres.php");
        exit;
    } elseif (isset($_POST["demandes"])) {
        // Redirect to the page for listing demands
        header("Location: demandes_cadre.php");
        exit;
    }
}
?>
