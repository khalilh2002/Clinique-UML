<?php
session_start();
include("../CNT.php"); // Inclure le fichier de connexion à la base de données
$conn = connectDB(); // Établir une connexion à la base de données

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération de l'email saisi
    $email = $_POST["username"];

    // Requête pour récupérer l'email du secrétaire depuis la base de données
    $sql = "SELECT email FROM secraitere WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification si l'email saisi correspond à celui du secrétaire dans la base de données
    if ($result) {
        // L'email est valide, redirigez l'utilisateur vers une autre page
        header("Location: accueil_secretaire.php");
        exit;
    } else {
        // L'email n'est pas valide, redirigez l'utilisateur vers la page de connexion avec un message d'alerte Bootstrap
        header("Location: login_secretaire.php?error=email_incorrect");
        exit;
    }
}
?>
