<?php

$servername = "localhost";
$username = "root";
$password = "root";

    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=hospitale", $username, "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully <br>";
        } catch (PDOException $e) {
            echo "Connection failed: <br> " . $e->getMessage();
        }
        
?>