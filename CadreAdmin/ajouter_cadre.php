<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Cadre Administratif</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajouter un Cadre Administratif</h1>
        <form action="traitement_ajout_cadre.php" method="post">
            <div class="form-group">
                <label for="nom_complet">Nom Complet</label>
                <input type="text" class="form-control" id="nom_complet" name="nom_complet" required>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirmer</button>
        </form>
    </div>
</body>
</html>
