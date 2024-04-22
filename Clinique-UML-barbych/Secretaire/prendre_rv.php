<?php
session_start();
include("../CNT.php"); // Inclure le fichier de connexion à la base de données
$conn = connectDB(); // Établir une connexion à la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un rendez-vous</title>
    <!-- Styles Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
      body {
            background-image: url('back.jpg');
            background-size: cover; /* pour couvrir toute la surface */
            background-position: center; /* centrer l'image */
            background-repeat: no-repeat; /* ne pas répéter l'image */
        }
 .container {
    max-width: 800px;
    margin: 0 auto;
    margin-top: 50px;
    border: 2px solid #007bff; /* Bordure principale */
    border-radius: 15px; /* Coins arrondis */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Ombre */
    background-color: #fff; /* Fond blanc */
}

.card-header {
    background-color: #007bff;
    color: white;
    border-radius: 15px 15px 0 0; /* Coins arrondis seulement en haut */
    border-bottom: none; /* Pas de bordure en bas */
}

.card-body {
    padding: 30px;
}

.form-group label {
    font-weight: bold;
}

.btn-primary {
    background-color: #007bff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}


        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .card-body {
            padding: 30px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
    background-color: #007bff;
    border: none;
    padding: 10px 20px; /* Ajustez les valeurs de padding selon vos besoins */
}

.btn-primary:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 " style="align-items: center;text-align: center;">Prendre un rendez-vous</h5>
            </div>
            <div class="card-body">
                <form action="traitement_rdv.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom">Nom complet:</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="date_naissance">Date naissance:</label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                            </div>
                
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="tel">Tel:</label>
                                <input type="tel" class="form-control" id="tel" name="tel" required>
                            </div>
                            <div class="form-group">
                                <label for="adresse">Adresse:</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" required>
                            </div>                        
                        </div>
                        <div class="col-md-6">
                           
                            <div class="form-group">
                                <label for="genre">Genre :</label>
                                <select class="form-control" id="genre" name="genre" required>
                                    <option value="masculin">Masculin</option>
                                    <option value="féminin">Féminin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sang">Groupe sanguin :</label>
                                <select class="form-control" id="sang" name="sang" required>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_rd">Date du rendez-vous:</label>
                                <input type="date" class="form-control" id="date_rd" name="date_rd" required>
                            </div>
                            <div class="form-group">
                                <label for="heure">Heure du rendez-vous:</label>
                                <input type="time" class="form-control" id="heure" name="heure" required>
                            </div>    
                                <?php
                                // Requête pour sélectionner tous les noms des docteurs
                                $sql = "SELECT nom_complet FROM docteur";
                                $result = $conn->query($sql);

                                // Vérifier s'il y a des résultats
                                if ($result && $result->rowCount() > 0) {
                                    // Afficher les options dans le select
                                    echo '<div class="form-group">';
                                    echo '<label for="docteur">Docteur associé :</label>';
                                    echo '<select class="form-control" id="docteur" name="docteur" required>';
                                    echo '<option value="">Sélectionnez un docteur</option>';
                                    // Parcourir les résultats et afficher chaque nom de docteur comme une option
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="' . $row["nom_complet"] . '">' . $row["nom_complet"] . '</option>';
                                    }
                                    echo '</select>';
                                    echo '</div>';
                                } else {
                                    echo "Aucun docteur trouvé.";
                                }

                                // Fermer la connexion à la base de données
                                $conn = null;
                            ?>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-block mt-4">Prendre rendez-vous</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Scripts Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <?php
// Vérifiez si un message est défini dans la session
if (isset($_SESSION['message'])) {
    // Déterminez le type d'alerte Bootstrap en fonction du message
    $alertType = ($_SESSION['message'] == "Rendez-vous ajouté avec succès") ? "success" : "danger";

    // Affichez le modal Bootstrap correspondant
    echo '<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">';
    echo '<div class="modal-dialog" role="document">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<h5 class="modal-title" id="messageModalLabel">Message</h5>';
    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo '</div>';
    echo '<div class="modal-body">';
    echo '<div class="alert alert-' . $alertType . '">';
    echo $_SESSION['message'];
    echo '</div>';
    echo '</div>';
    echo '<div class="modal-footer">';
    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    // Afficher le script JavaScript pour afficher le modal au chargement de la page
    echo '<script>$(document).ready(function() { $("#messageModal").modal("show"); });</script>';

    // Effacez le message de la session
    unset($_SESSION['message']);
}
?>

</body>
</html>
