<?php
// Récupérer les informations du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Connexion à la base de données
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbname = "la_difference";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Vérifier si la connexion a réussi
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Préparer la requête SQL pour vérifier les informations de l'utilisateur
$sql = "SELECT * FROM users WHERE pseudo = '$username' AND mdp = '$password'";
$result = $conn->query($sql);

// Vérifier si la requête a renvoyé des résultats
if ($result->num_rows > 0) {
    // L'utilisateur existe dans la base de données, connexion valide
    header('Location: ../dashbord.php');
    exit();
} else {
    // L'utilisateur n'existe pas dans la base de données, connexion invalide
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}

// Fermer la connexion à la base de données
$conn->close();
?>