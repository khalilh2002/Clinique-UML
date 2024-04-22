<?php
session_start();
include("../CNT.php"); // Inclure le fichier de connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $genre = $_POST["genre"];
    $date_naissance = $_POST["date_naissance"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $adresse = $_POST["adresse"];
    $sang = $_POST["sang"];
    $date_rd = $_POST["date_rd"];
    $heure = $_POST["heure"];
    $docteur = $_POST["docteur"];

    // Insérer les données dans la table patient
    $sql_patient = "INSERT INTO patient (nom_complet, genre, date_naissance, email, num_tel, adresse, type_de_sang) 
                    VALUES ('$nom', '$genre', '$date_naissance', '$email', '$tel', '$adresse', '$sang')";
    
    // Insérer les données dans la table agenda
    $sql_agenda = "INSERT INTO agenda (date_rendez_vous, heure_RV, Docteur_associé) 
                   VALUES ('$date_rd', '$heure', '$docteur')";

    // Exécuter les requêtes
    $conn = connectDB();
    $result_patient = $conn->query($sql_patient);
    $result_agenda = $conn->query($sql_agenda);

    // Vérifier si l'insertion a réussi
    if ($result_patient && $result_agenda) {
        // Définir un message de succès dans la session
        session_start();
        $_SESSION['message'] = "Rendez-vous ajouté avec succès";
    } else {
        // Définir un message d'erreur dans la session
        session_start();
        $_SESSION['message'] = "Erreur lors de l'ajout du rendez-vous.";
    }

    // Fermer la connexion à la base de données
    $conn = null;

    // Rediriger vers prendre-rv.php
    header("Location: prendre_rv.php");
   
}
?>
