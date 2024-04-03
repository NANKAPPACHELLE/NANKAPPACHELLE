<!DOCTYPE html>
<html>
<head>
  <title>Enregistrement d'un patient</title>
  <style>
    /* Votre CSS personnalisé ici */
  </style>
</head>
<body>
  <h1>Enregistrement d'un patient</h1>
  
  <form action="enregistrer_patient.php" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>

    <label for="date_naissance">Date de naissance :</label>
    <input type="date" id="date_naissance" name="date_naissance" required>

    <label for="adresse">Adresse :</label>
    <textarea id="adresse" name="adresse" required></textarea>

    <label for="telephone">Téléphone :</label>
    <input type="tel" id="telephone" name="telephone" required>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>

    <input type="submit" value="Valider">
    <button type="button" onclick="annuler()">Annuler</button>
  </form>

  <script>
    function annuler() {
      // Rediriger vers une autre page ou effectuer une action d'annulation
      alert("Annulation de l'enregistrement du patient");
    }
  </script>

  <?php
  // Vérifier si le formulaire a été soumis
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $dateNaissance = $_POST["date_naissance"];
    $adresse = $_POST["adresse"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];

    // Effectuer la logique d'enregistrement dans la base de données
    // Remplacez les informations de connexion à la base de données par les vôtres
    $servername = "localhost";
    $username = "votre_nom_utilisateur";
    $password = "votre_mot_de_passe";
    $dbname = "nom_de_votre_base_de_donnees";

    // Créer une connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier si la connexion a réussi
    if ($conn->connect_error) {
      die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Préparer et exécuter la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO patients (nom, prenom, date_naissance, adresse, telephone, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nom, $prenom, $dateNaissance, $adresse, $telephone, $email);

    if ($stmt->execute()) {
      echo "Patient enregistré avec succès !";
    } else {
      echo "Erreur lors de l'enregistrement du patient : " . $stmt->error;
    }

    // Fermer la connexion à la base de données
    $stmt->close();
    $conn->close();
  }
  ?>
</body>
</html>