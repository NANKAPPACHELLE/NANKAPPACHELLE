<?php

global $nom, $mot_passe;
include('connexion_bd.php');
function Connexion($nom, $mot_passe, $connexion) {
    $requete = "SELECT * FROM utilisateur WHERE Pseudo_user = '$nom' and Mot_passe_user='$mot_passe'";
    $resultat = $connexion->query($requete);
    if ($resultat->num_rows > 0) {
        echo "Connexion réussie !";
        $row = $resultat->fetch_assoc();
        $_SESSION['Id_user'] = $row['Id_user'];
        header("location: liste-ele-parents.php");
    } else {
        echo "Mot de passe incorrect.";
    }
    
}

?>

<html>
    <head>
        <title>Connexion</title>
        <meta charset="UTF-8" />
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" ></link>
        <link href="form-connexion-admin2.css" rel="stylesheet" ></link>
        <link href="bootstrap/css/bootstrap.grid.min.css" rel="stylesheet" ></link>
        <style>
            .container {
                margin-top: 50px;
            }
            .image {
                text-align: right;
            }
            .titre {
                text-align: center;
                margin-bottom: 30px;
            }
            .form {
                border: 1px solid #ccc;
                padding: 20px;
                border-radius: 5px;
                background-color: #f5f5f5;
            }
        </style>
    </head>
    <body>
        <?php
        $nom = "";
        $mot_passe = "";

        if (isset($_POST['nom'])) {
            $nom = $_POST['nom'];
        }
        if (isset($_POST['mot_passe'])) {
            $mot_passe = $_POST['mot_passe'];
        }
        if(isset($_POST['btnconnexion'])){
            Connexion($nom, $mot_passe, $connexion);}
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="image">
                        <img src="img.png" alt="" align="right">
                    </div>
                    <div class="titre">
                        <h1>Connexion</h1>
                    </div>
                    <div class="form">
                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="nom">Pseudo:</label>
                                <input type="text" class="form-control" placeholder="Votre nom" name="nom" id="nom">
                            </div>
                            <div class="form-group">
                                <label for="mot_passe">Mot de passe:</label>
                                <input type="password" class="form-control" placeholder="Votre mot de passe" name="mot_passe" id="mot_passe">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark" name="btnconnexion">Connexion</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html><?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des informations d'identification (simulées ici, vous devez vérifier à partir de votre base de données)
    if ($username === 'utilisateur' && $password === 'motdepasse') {
        // Les informations d'identification sont correctes
        // Création de la session utilisateur
        $_SESSION['username'] = $username;

        // Redirection vers la page d'accueil par exemple
        header('Location: index.php');
        exit;
    } else {
        // Les informations d'identification sont incorrectes
        $error = "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
</head>
<body>
    <div id="container">
        <!-- Formulaire de connexion -->
        <form action="" method="POST">
            <div id="gbs"><img src="logo_gbs_ms.jpg" alt="GBS la différence"></div>
            <h1>Connexion</h1>

            <?php if(isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>

            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required>

            <input type="submit" id='submit' value='LOGIN'>
        </form>
    </div>
</body>
</html>
