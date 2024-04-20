<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$contenu_demande = $type_demande = "";
$contenu_demande_err = $type_demande_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate contenu_demande
    $input_contenu_demande = trim($_POST["contenu_demande"]);
    if(empty($input_contenu_demande)){
        $contenu_demande_err = "Please enter a content.";
    } else{
        $contenu_demande = $input_contenu_demande;
    }
    
    // Validate type_demande
    $input_type_demande = trim($_POST["type_demande"]);
    if(empty($input_type_demande)){
        $type_demande_err = "Please enter the type of demand.";
    } else{
        $type_demande = $input_type_demande;
    }
    
    // Check input errors before inserting in database
    if(empty($contenu_demande_err) && empty($type_demande_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO demande (contenu_demande, type_demande) VALUES (?, ?)";
         
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_contenu_demande, $param_type_demande);
            
            // Set parameters
            $param_contenu_demande = $contenu_demande;
            $param_type_demande = $type_demande;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: demandes_cadre.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Demande</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter Demande</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Contenu Demande</label>
                <input type="text" name="contenu_demande" class="form-control <?php echo (!empty($contenu_demande_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contenu_demande; ?>">
                <span class="invalid-feedback"><?php echo $contenu_demande_err;?></span>
            </div>
            <div class="form-group">
                <label>Type Demande</label>
                <input type="text" name="type_demande" class="form-control <?php echo (!empty($type_demande_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $type_demande; ?>">
                <span class="invalid-feedback"><?php echo $type_demande_err;?></span>
            </div>
            <input type="submit" class="btn btn-primary" value="Confirmer">
            <a href="demandes_cadre.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
