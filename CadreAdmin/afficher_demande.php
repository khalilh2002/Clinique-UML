<?php
$page_title = "Ma Demande";
require_once "base.php";
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT contenu_demande, type_demande FROM demande WHERE id_demande = ?";
    
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Store result
            $stmt->store_result();
            
            // Check if ID exists
            if($stmt->num_rows == 1){                    
                // Bind result variables
                $stmt->bind_result($contenu_demande, $type_demande);
                $stmt->fetch();
                
                // HTML to display the demand
                echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Afficher Demande</title>
                    <!-- Bootstrap CSS -->
                    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f0f0f0;
                        }
                        .container {
                            max-width: 800px;
                            margin: 50px auto;
                            background-color: #fff;
                            border-radius: 8px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            padding: 20px;
                        }
                        h1 {
                            margin-top: 0;
                            color: #333;
                        }
                        p {
                            font-size: 18px;
                        }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h1>Afficher Demande</h1>
                        <p><strong>Contenu Demande:</strong> $contenu_demande</p>
                        <p><strong>Type Demande:</strong> $type_demande</p>
                        <a href='demandes_cadre.php' class='btn btn-primary'>Retour</a>
                    </div>
                </body>
                </html>";
            } else{
                // No demand found with that ID
                header("location: demandes_cadre.php");
                exit();
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $conn->close();
} else{
    // ID parameter is missing
    header("location: demande_cadre.php");
    exit();
}
?>
