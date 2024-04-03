<html>
    <head>
        <title>Gestion des POINTS ARRETS</title>
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
}
</style>
<?php
 function recuperer_id_itineraire(){
    global $id_itineraire;
    try
    {
        include("connexion_bd.php");
        $sql="SELECT id_itineraire FROM itineraire ";
        $sql=$db->prepare($sql);
        $sql->execute();
        echo "<select name=\"id_itineraire\"onchange=\"submit()\">";
        $a="";
        echo '< option value="'.$a.'">'.$a.'</option>';
        while($donnees=$sql->fetch(PDO::FETCH_ASSOC)){
            $a=$donnees['id_itineraire'];
            if($id_itineraire==$a){
                echo '<option value="'.$a.'" selected>'.$a.'</option>';  
            }else{
                echo '<option value="'.$a.'">'.$a.'</option>';
            }
        }
        $sql->closecursor();
        echo "</select>";
    }
    catch(Exeption $e){
       die('erreur:'.$e->getMessage());
   }
}
function recuperer_nom_chauffeur(){
    global $code_chauffeur,$nom_chauffeur;
    try
    {
        include("connexion_bd.php");
        $sql="SELECT nom_chauffeur FROM chauffeur where code_chauffeur=:code";
        $sql=$db->prepare($sql);
        $sql->bindvalue(':code',$code_chauffeur);
        $sql->execute();
        while($donnees=$sql->fetch(PDO::FETCH_ASSOC)){
            $nom_chauffeur=$donnees['nom_chauffeur'];
        }
            $sql->closecursor(); 
        }  
        catch(Exeption $e)
        {
            die('erreur:'.$e->getMessage());
        }
     }
     
  

     function Enregistrer_point_arret(){
        global $libelle_arret, $quartier;
        try {
            include("connexion_bd.php");
            $sql = "INSERT INTO point_arret (libelle_arret, quartier) VALUES (:libelle, :quartier)";
            $sql = $db->prepare($sql);
            $sql->bindValue(':libelle', $libelle_arret);
            $sql->bindValue(':quartier', $quartier);
            $sql->execute();
            if ($sql) {
                echo "<h3><font color=blue>Insertion réussie</font></h3>";
            } else {
                echo "<h3><font color=red>Échec de l'insertion</font></h3>";
            }
            $sql->closeCursor();
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    


    function Modifier_point_arret(){
        global $libelle_arret, $quartier, $ancien_libelle_arret;
        try {
            include("connexion_bd.php");
            $sql = "UPDATE point_arret SET libelle_arret = :libelle, quartier = :quartier WHERE libelle_arret = :ancien_libelle";
            $sql = $db->prepare($sql);
            $sql->bindValue(':libelle', $libelle_arret);
            $sql->bindValue(':quartier', $quartier);
            $sql->bindValue(':ancien_libelle', $ancien_libelle_arret);
            $sql->execute();
            if ($sql) {
                echo "<h4><font color=blue>Modification réussie</font></h4>";
            } else {
                echo "<h4><font color=red>Échec de la modification</font></h4>";
            }
            $sql->closeCursor();
        } catch(PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    


    function supprimer_point_arret(){
        global $libelle_arret;
        try {
            include("connexion_bd.php");
            $sql = "DELETE FROM point_arret WHERE libelle_point = :libelle";
            $sql = $db->prepare($sql);
            $sql->bindValue(':libelle', $libelle_arret);
            $sql->execute();
            if ($sql) {
                echo "<h4><font color=blue>Suppression réussie</font></h4>";
            } else {
                echo "<h4><font color=red>Échec de la suppression</font></h4>";
            }
            $sql->closeCursor();
        } catch(PDOException $e) {
            die('Erreur : '.$e->getMessage());
        }
    }
    

    function recuperer_un_point_arret(){
        global $libelle_arret, $quartier;
        try {
            include("connexion_bd.php");
            $sql = "SELECT libelle_arret, quartier FROM point_arret WHERE libelle_arret = :libelle";
            $sql = $db->prepare($sql);
            $sql->bindValue(':libelle', $libelle_arret);
            $sql->execute();
            while ($donnees = $sql->fetch(PDO::FETCH_ASSOC)) {
                $libelle_arret = $donnees['libelle_arret'];
                $quartier = $donnees['quartier'];
                // Si vous avez besoin de plus de données, vous pouvez les récupérer ici
            }
            $sql->closeCursor();
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    



    function afficher_les_points_arrets(){
        try {
            include("connexion_bd.php");
            $sql = "SELECT libelle_arret, quartier FROM point_arret";
            $sql = $db->prepare($sql);
            $sql->execute();
            if ($sql->rowCount()>0) {
                echo "<table width=\"80%\" border=\"0px\" align=\"center\">";
                echo "<caption>LISTE DES POINTS DES ARRETS</caption>";
                echo "<tr><th>Libelle</th><th>Quartier</th></tr>";
    
                while ($donnees = $sql->fetch(PDO::FETCH_ASSOC)) {
                    $libelle_arret = $donnees['libelle_arret'];
                    $quartier = $donnees['quartier'];
                    echo "<tr style=\"background-color:#CFA324;\"><td>$libelle_arret</td><td>$quartier</td>";
                }
    
                $sql->closeCursor();
                echo "</table>";
            }
        } catch(Exception $e) {
            die('erreur : ' . $e->getMessage());
        }
    }
    
    function obtenirHeureAutomatique() {
        return date('H:i:s'); // Renvoie l'heure actuelle au format HH:MM:SS
    }
    date_default_timezone_set('Europe/Paris');
    // Appel à la fonction pour obtenir l'heure actuelle
    $heureActuelle = obtenirHeureAutomatique();


  
?>

</head>
<body>
<?php
     
     
     
    include("menu_horizontal/texte_menu_horizontal_simple.txt");
    
    $libelle_arret="";
    $quartier="";
    
    
    if(isset($_POST['libelle_arret'])){
    $libelle_arret=$_POST['libelle_arret'];
    }
    if(isset($_POST['quartier'])){
    $quartier=$_POST['quartier'];
    }
    if(isset($_POST['btnenregistrer_point_arret'])){
            Enregistrer_point_arret();
    }
    if(isset($_POST['btnmodifier_point_arret'])){
        modifier_point_arret();
    }
    if(isset($_POST['btnsupprimer_point_arret'])){
        supprimer_point_arret();
    }
    if(isset($_POST['btnrechercher'])){
        recuperer_un_point_arret();
    }
?>
<form action="#" method="post">
<table width="60%" border="0px" align="center">
<caption> GESTION DES POINTS ARRETS</caption>
    <tr><td>libelle_arret</td>
    <td>
        <INPUT type="text" name="libelle_arret" size="20" value="<?php echo $libelle_arret;?>">
        <INPUT type="submit" name="btnrechercher" value="Rechercher">
    </td>
</tr>


       <tr><td>quartier</td><td>
       <INPUT type="text" name=" quartier" size="20" value="<?php echo $quartier;?>">
</td></tr>

      

<td colspan="2" align="center">
     <INPUT type="submit" name="btnenregistrer_point_arret" value="Enregistrer"> 
     &nbsp;&nbsp;
     <INPUT type="submit" name="btnmodifier_point_arret" value="Modifier">
     &nbsp;&nbsp;
     <INPUT type="submit" name="btnsupprimer_point_arret" value="Supprimer">
     <p>L'heure actuelle est : <?php echo obtenirHeureAutomatique(); ?></p>

</td>
</table>
<br>
<?php afficher_les_points_arrets();?>
</form>
</body>
</html>