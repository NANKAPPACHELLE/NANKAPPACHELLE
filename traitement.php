<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "la_difference";


// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données du formulaire
$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp'];

// Requête d'insertion
$sql = "INSERT INTO users (pseudo, mdp) VALUES ('$pseudo', '$mdp')";

if ($conn->query($sql) === TRUE) {
    echo "Inscription réussie";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

// Fermer la connexion
$conn->close();
?>