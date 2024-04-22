<?php
// Connexion à la base de données
function connectDB() {
    $servername = "localhost";
    $dbname = "hospital";
    $username = "root";
    $password = "";
    $port = 3306; // Port par défaut de MySQL

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;port=$port;charset=utf8mb4", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        // En cas d'échec de la connexion, affichez l'erreur et retournez null
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}
?>
