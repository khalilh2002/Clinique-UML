<?php
include("../CNT.php"); // Inclure le fichier de connexion à la base de données

// Vérifier si les données du formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $patientId = $_POST['patientId'];
    $nom = $_POST["nom"];
    $genre = $_POST["genre"];
    $date_naissance = $_POST["date_naissance"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $adresse = $_POST["adresse"];
    $type_sang = $_POST["type_sang"];

    // Mettre à jour les informations du patient dans la base de données
    $conn = connectDB();
    $sql = "UPDATE patient SET nom_complet = :nom, genre = :genre, date_naissance = :date_naissance, email = :email, num_tel = :tel, adresse = :adresse, type_de_sang = :type_sang WHERE id_patient = :patientId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':type_sang', $type_sang);
    $stmt->bindParam(':patientId', $patientId);
    $success = $stmt->execute();

    if ($success) {
        // Rediriger vers la page modif_pat.php avec un message de succès
        header("Location: modif_pat.php?patientId=$patientId&success=true");
        exit();
    } else {
        // Rediriger avec un message d'erreur si la mise à jour a échoué
        header("Location: modif_pat.php?patientId=$patientId&error=true");
        exit();
    }
} else {
    // Rediriger avec un message d'erreur si les données n'ont pas été soumises via POST
    header("Location: modif_pat.php?patientId=$patientId&error=true");
    exit();
}
?>
