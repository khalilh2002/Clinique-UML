<?php
// Démarrez la session
session_start();

// Détruisez toutes les variables de session
session_destroy();

// Redirigez l'utilisateur vers la page de connexion
header("Location: login_secretaire.php");
exit();
?>
