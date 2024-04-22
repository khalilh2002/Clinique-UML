<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Secrétaire</title>
    <!-- Styles Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .menu-title {
            text-align: center;
            font-size: 24px;
            padding: 20px 0;
            background-color: #007bff;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border: 2px solid #0056b3;
            border-bottom: none;
            margin-bottom: 20px;
            position: relative;
            margin-top: 50px; /* Ajout de la marge supérieure */
        }

        .menu-title::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 80%;
            border-bottom: 2px solid #0056b3;
            transform: translateX(-50%);
        }

        .menu-container {
            padding: 20px;
            border: 2px solid #0056b3;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            background-color: white;
        }

        .clickable-div {
            cursor: pointer;
            padding: 20px;
            margin: 10px;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .clickable-div:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu-title">
            Menu Secrétaire
        </div>
        <div class="menu-container">
            <div class="row">
                <div class="col-md-4">
                    <div class="clickable-div bg-primary text-white" onclick="location.href='prendre_rv.php';">
                        <i class="fas fa-calendar-plus fa-3x"></i>
                        <h4>Prendre RDV</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="clickable-div bg-success text-white" onclick="location.href='lister_patients.php';">
                        <i class="fas fa-list-alt fa-3x"></i>
                        <h4>Lister les patients</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="clickable-div bg-warning text-white" onclick="location.href='demander_facture.php';">
                        <i class="fas fa-file-invoice-dollar fa-3x"></i>
                        <h4>Facture</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="clickable-div bg-info text-white" onclick="location.href='dossier_medicale.php';">
                    <i class="fas fa-notes-medical fa-3x"></i>
                        <h4>Dossier médical </h4>
                    </div>
                </div>
                <div class="col-md-4">
                <style>
                    body {
                        background-image: url('back.jpg');
                        background-size: cover; /* pour couvrir toute la surface */
                        background-position: center; /* centrer l'image */
                        background-repeat: no-repeat; /* ne pas répéter l'image */
                    }
                    .bg-brown {
                        background-color: #A52A2A; /* Marron */
                    }
                    .bg-brown:hover {
                        background-color: #A52A2A; /* Marron */
                    }
                </style>

                <!-- <div class="clickable-div bg-brown text-white" onclick="location.href='paiement.php';">
                    <i class="fas fa-money-check-alt fa-3x"></i>
                    <h4>Paiement de facture</h4>
                </div> -->

                </div>
                <div class="col-md-4">
                    <div class="clickable-div bg-secondary text-white" onclick="location.href='agenda.php';">
                        <i class="fas fa-calendar-alt fa-3x"></i>
                        <h4>Agenda</h4>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" style="margin-top: 200px;">
                <div class="col-md-4">
                    <button class="btn btn-danger btn-lg btn-block" onclick="location.href='logout.php';">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
