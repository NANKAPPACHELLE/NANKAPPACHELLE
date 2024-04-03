
<!DOCTYPE html>
<html lang="fr">
<head>
     <title>Créer une notification</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>
<body>

<h2>Créer une notification</h2>

<form action="traitement_notification.php" method="POST">
    <label for="id_eleve">Élève :</label>
    <select name="id_eleve" id="id_eleve">
        <!-- Ici, vous devez remplir la liste déroulante avec les élèves récupérés depuis la base de données -->
        <option value="1">John Doe</option>
        <option value="2">Jane Smith</option>
        <!-- Vous devez ajouter plus d'options en fonction des élèves de votre école -->
    </select>
    <br><br>
    <label for="contenu">Contenu :</label><br>
    <textarea name="contenu" id="contenu" rows="4" cols="50" required></textarea>
    <br><br>
    <input type="submit" value="Envoyer">
</form>

</body>
</html>
