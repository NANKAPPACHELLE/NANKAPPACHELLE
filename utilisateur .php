<!DOCTYPE html>
<html>
<head>
    <title>GESTION DES UTILISATEURS</title>
    <meta charset="utf-8">
        <script src="menu_horizontal/SpryMenuBar.js" type="text/javascript"></script>
     <link href="menu_horizontal/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

        <link hel="stylesheet" media="screen" type="text/css" href="formatage.css"/>

        <style>body{
    background-color: #c1c4f5;
}
table{
    background-color: #ccffff;
    font-size: 18px;
    color: black;
}
caption{
    background-color: black;
    color: white;
    text-align: center;
    font-size: 20px;
}
input,select,textarea{
    background-color: white;
    font-size: 18px;
    color: black;
}
input:focus,textarea:focus{
    background-color: #ffff99;
    font-size: 20px;
    color:blue;
}</style>


<?php

function affichage_utilisateur()
include("connexion_bd.php"); 
{
    $sql = "SELECT nom_utilisateur, mot_passe, niveau_securite FROM utilisateur";
    
    try {
        $cn = new PDO(chaine_mysql());
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $cn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $cn = null;
        
        echo '<table>';
        echo '<tr><th>nom_utilisateur</th><th>mot_passe</th><th>niveau_securite</th></tr>';
        
        foreach ($result as $row) {
            echo '<tr>';
            echo '<td>'.$row['nom_utilisateur'].'</td>';
            echo '<td>'.$row['mot_passe'].'</td>';
            echo '<td>'.$row['niveau_securite'].'</td>';
            echo '</tr>';
        }
        
        echo '</table>';
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

function insert_utilisateur($nom_utilisateur, $mot_passe, $niveau_securite)
include("connexion_bd.php");
{
    if (empty($nom_utilisateur)) {
        echo 'Veillez saisir le nom de l\'utilisateur';
        return;
    }
    
    if (empty($mot_passe)) {
        echo 'Veillez saisir le mot de passe';
        return;
    }
    
    if (empty($niveau_securite)) {
        echo 'Veillez saisir le niveau de sécurité';
        return;
    }
    
    $sql = "INSERT INTO utilisateur (nom_utilisateur, mot_passe, niveau_securite) VALUES (:nomu, :motp, :nive)";
    
    try {
        $cn = new PDO(chaine_mysql());
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $cn->prepare($sql);
        $stmt->bindParam(':nomu', $nom_utilisateur);
        $stmt->bindParam(':motp', $mot_passe);
        $stmt->bindParam(':nive', $niveau_securite);
        
        $stmt->execute();
        
        $cn = null;
        
        affichage_utilisateur();
        
        echo 'Insertion réussie';
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

function update_utilisateur($nom_utilisateur, $mot_passe, $niveau_securite)
include("connexion_bd.php");
{
    if (empty($nom_utilisateur)) {
        echo 'Veillez saisir le nom de l\'utilisateur';
        return;
    }
    
    if (empty($mot_passe)) {
        echo 'Veillez saisir le mot de passe';
        return;
    }
    
    if (empty($niveau_securite)) {
        echo 'Veillez saisir le niveau de sécurité';
        return;
    }
    
    $sql = "UPDATE utilisateur SET nom_utilisateur = :nomu, niveau_securite = :nive WHERE mot_passe = :motp";
    
    try {
        $cn = new PDO(chaine_mysql());
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $cn->prepare($sql);
        $stmt->bindParam(':nomu', $nom_utilisateur);
        $stmt->bindParam(':motp', $mot_passe);
        $stmt->bindParam(':nive', $niveau_securite);
        
        $stmt->execute();
        
        $cn = null;
        
        affichage_utilisateur();
        
        echo 'Modification réussie';
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

function delete_utilisateur($mot_passe)
include("connexion_bd.php");
{
    if (empty($mot_passe)) {
        echo 'Veillez saisir le mot de passe';
        return;
    }
    
    $sql = "DELETE FROM utilisateur WHERE mot_passe = :motp";
    
    try {
        $cn = new PDO(chaine_mysql());
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $cn->prepare($sql);
        $stmt->bindParam(':motp', $mot_passe);
        
        $stmt->execute();
        
        $cn = null;
        
        affichage_utilisateur();
        
        echo 'Suppression réussie';
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

function recherche_utilisateur($mot_passe)
{
    if (empty($mot_passe)) {
        echo 'Veeuillez saisir le mot de passe';
        return;
    }

    $sql = "SELECT nom_utilisateur, mot_passe, niveau_securite FROM utilisateur WHERE mot_passe = :motp";

    try {
        $cn = new PDO(chaine_mysql());
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $cn->prepare($sql);
        $stmt->bindParam(':motp', $mot_passe);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cn = null;

        echo '<table>';
        echo '<tr><th>nom_utilisateur</th><th>mot_passe</th><th>niveau_securite</th></tr>';

        foreach ($result as $row) {
            echo '<tr>';
            echo '<td>'.$row['nom_utilisateur'].'</td>';
            echo '<td>'.$row['mot_passe'].'</td>';
            echo '<td>'.$row['niveau_securite'].'</td>';
            echo '</tr>';
        }

        echo '</table>';
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}
?>
<form action="#" method="post">
<table width="60%" border="0px" align="center">
<caption>GESTION DES UTILISATEURS</caption>
<tr><td>nom utilisateur</td><td>
<INPUT type="text" name="nom_utilisateur" size="20" value="<?php echo $nom_utilisateur;?>">
<INPUT type="submit" name="btnrechercher" value="Rechercher">
</TD></TR>

    <tr><td>mot de passe</td><td>
    <INPUT type="text" name="mot_passe" size="20" value="<?php echo $mot_passe;?>">
    
    </TD></TR>

    <tr>
<td>niveau de securite</td>
<td>
<input type="text" name="niveau_securite" size="20" value="<?php echo $niveau_securite;?>">
</td>
</tr>

            <TR><TD colspan="2" align="center">
            <INPUT type="submit" name="btnenregistrer_utilisateur" value="Enregistrer"> 
            &nbsp;&nbsp;
            <INPUT type="submit" name="btnmodifier_utilisateur" value="Modifier">
            &nbsp;&nbsp;
            <INPUT type="submit" name="btnsupprimer_utilisateur" value="Supprimer">
            </TD></TR>
            </table>
    <br><?php afficher_les_eleves();?>     
 </form>
</body>
</html>