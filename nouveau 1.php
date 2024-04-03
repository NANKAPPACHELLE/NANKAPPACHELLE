<!DOCTYPE html>
<html>
<head>
  <title>Enregistrement d'un patient</title>
  <style>
    /* Styles CSS */
    /* ... */

  </style>
</head>
<body>
  <h1>Enregistrement d'un patient</h1>
  
  <form action="enregistrer_patient.php" method="POST">
    <label for="numss">Numéro de sécurité sociale :</label>
    <input type="number" id="numss" name="numss" required>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>

    <input type="submit" value="Envoyer">
    <input type="reset" value="Annuler">
  </form>
  
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $serveur = "localhost";
    $utilisateur = "nom_utilisateur";
    $motdepasse = "mot_de_passe";
    $base_de_donnees = "nom_base_de_donnees";

    try {
        $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $motdepasse);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    // Récupération des données du formulaire
    $numss = $_POST['numss'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // Requête d'insertion des données dans la base de données
    $sql = "INSERT INTO patients (numss, nom, prenom) VALUES (:numss, :nom, :prenom)";
    $sql = $connexion->prepare($sql);

    $sql->bindParam(':numss', $numss);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);

    try {
        $stmt->execute();
        echo "Le patient a été enregistré avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement du patient : " . $e->getMessage();
    }

    // Fermeture de la connexion à la base de données
    $connexion = null;
  }
  ?>
  
</body>
</html>