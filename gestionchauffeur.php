<?php
session_start();

// Vérifier si la variable de session 'passe' est définie
if (!isset($_SESSION['passe'])) {
    header('Location: pagedeconnexion.php');
    exit();
}

echo "UTILISATEUR : " . $_SESSION['nom'];

// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=espace_comptes;charset=utf8;', 'root', '');

// Recherche des demandes
$requeteDemandes = $bdd->query('SELECT * FROM demande ORDER BY id DESC');
$demandes = $requeteDemandes->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="./image5.png">
    <title >ACCEUIL BUSSINESS CAMPUS</title>
<link rel="stylesheet" type="text/css" href="./acceuil.css">


<style>
.table {
  border-collapse: collapse;
  width: 100%;
}

.table th,
.table td {
  border: 1px solid #ddd;
  padding: 8px;
}

.table tr:nth-child(even) {
  background-color: #f2f2f2;
}

.table th {
  background-color: #4CAF50;
  color: white;
}

.table tr:hover {
  background-color: #ddd;
}



</style>

</head>
<body>
<nav class="navbar">
  <div class="logo">
     <img src="./image5.png" height="100px" width="100px" alt="logo">
  </div>
  <form class="search-form" action="#" method="get">
    <input type="text" name="search" placeholder="Rechercher..." class="search-input">
    <button type="submit" class="search-button" >Lancer </button>
  
   
  </form>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a href="./acceuil1.php" class="nav-link">Acceuil</a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">Mes demandes</a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link">Assistance chat</a>
    </li>
    
	<li class="nav-item">
       <a href="./deconnexion.php" class="nav-link" type= "button"><input type="submit" value="SE DECONNECTER" class="color-button"></a>
    </li>
  </ul>
</nav>



<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>CNI</th>
            <th>Ville</th>
            <th>Genre</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>CV</th>
            <th>Localisation</th>
            <th>Diplôme</th>
            <th>Lettre</th>
            <th>Demande</th>
            <th>Action</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($demandes)) {
            foreach ($demandes as $demande) {
                ?>
                <tr>
                    <td><?= $demande['nom']; ?></td>
                    <td><?= $demande['prenom']; ?></td>
                    <td><?= $demande['cni']; ?></td>
                    <td><?= $demande['ville']; ?></td>
                    <td><?= $demande['genre']; ?></td>
                    <td><?= $demande['email']; ?></td>
                    <td><?= $demande['tel']; ?></td>
                    <td><?= $demande['cv']; ?></td>
                    <td><?= $demande['localisation']; ?></td>
                    <td><?= $demande['diplome']; ?></td>
                    <td><?= $demande['lettre']; ?></td>
                    <td><?= $demande['demande']; ?></td>
                    <td>
                        <div style="background-color: black;">
                            <a href="?action=supprimer&id=<?= $demande['id']; ?>" style="color: white;"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">Supprimer</a>
                        </div>
                    </td>
                    <td>
                        <form >
                           
                             <?= $demande['statut']; ?>

                           
                        </form>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='14'>Aucune demande trouvée.</td></tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>
