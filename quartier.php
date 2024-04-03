<!DOCTYPE html>
<html>
<head>
    <title>GESTION DES ELEVES</title>
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
    function Enregistrer_quartier(){
        global  $libelle_quartier;
        try
        {
            include("connexion_bd.php");
            $sql="INSERT INTO quartier(libelle_quartier) Values (:libelle)";
            $sql=$db->prepare($sql);
            $sql->bindvalue(':libelle',$libelle_quartier);
            $sql->execute();
            if ($sql){
                echo "<h4><font color=blue>insertion reussie</font></h4>";
            }else{
                echo "<h4><font color=blue>echec d'insertion</font></h4>";
            }
            $sql->closecursor();
        }
        catch(exeption $e){
            die('erreur:'.$e->getMessage());
        }
       } 
    
       function Modifier_quartier(){
        global $ancien_libelle_quartier, $nouveau_libelle_quartier ; // Assurez-vous d'avoir accès à votre connexion à la base de données
    
        try {
            include("connexion_bd.php");
            // Préparation de la requête SQL
            $sql = "UPDATE quartier SET libelle_quartier = :nouveau_libelle_quartier WHERE libelle_quartier = :ancien_libelle_quartier";
    
            // Exécution de la requête SQL
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':nouveau_libelle_quartier', $nouveau_libelle_quartier);
            $stmt->bindValue(':ancien_libelle_quartier', $ancien_libelle_quartier);
            $stmt->execute();
    
            // Affichage d'un message de succès
            echo "<h4><font color=blue>Modification du libellé du quartier réussie</font></h4>";
      
            // Fermeture du curseur
            $stmt->closeCursor();
        } catch(Exception $e) {
            // Gestion des erreurs
            die('Erreur : ' . $e->getMessage());
        }
    }
    

    
     
       function supprimer_quartier(){
        global $libelle_quartier;
        try
        {
            include("connexion_bd.php");
            $sql=" DELETE from quartier  where libelle_quartier=:libelle";
            $sql=$db->prepare($sql);
            $sql->bindvalue(':libelle',$libelle_quartier);
            $sql->execute();
            if ($sql){
                echo "<h4><font color=blue>suppression reussie</font></h4>";
            }else{
                echo "<h4><font color=blue>echec de suppression</font></h4>";
            }
            $sql->closecursor();
        }
        catch(exeption $e){
            die('erreur:'.$e->getMessage());
        }
      
    }
    function recuperer_les_quartiers(){ 
        global $libelle_quartier;
        try
        { 
            include("connexion_bd.php"); 
            $sql = "SELECT  libelle_quartier FROM quartier";
            $sql = $db->prepare($sql);
            $sql->execute();
            $quartiers = $sql->fetchAll(PDO::FETCH_ASSOC);
            $sql->closeCursor();
        }
        catch(Exception $e)
        {
            die('erreur:'.$e->getMessage());
        }
    }
    
    function afficher_les_quartiers(){
        try{
            include("connexion_bd.php");
            $sql = "SELECT libelle_quartier  FROM quartier";

            $sql = $db->prepare($sql);
            $sql->execute();
            if($sql->rowCount() > 0){
                echo "<table width=\"80%\" border=\"0px\" align=\"center\">";
                echo "<caption>LISTE DES QUARTIERS</caption>";
                echo "<tr><th>Libelle</th>";
                while($donnees = $sql->fetch(PDO::FETCH_ASSOC)){
                    $a = $donnees['libelle_quartier'];
                    
                    echo "<tr style=\"background-color:#CFA324;\">
                          <td align=\"center\">$a</td>";
                }
                $sql->closeCursor();
                echo "</table>";
            }
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }
    
    
    
    
?>
   
  </head>
    <body>
    <?php
      include("menu_horizontal/texte_menu_horizontal_simple.txt");


    $libelle_quartier="";
    
    
    if(isset($_POST['libelle_quartier'])){
        $libelle_quartier=$_POST['libelle_quartier'];
    }
    if(isset($_POST['btnenregistrer_quartier'])){
        Enregistrer_quartier();
     }
     if(isset($_POST['btnmodifier_quartier'])){
        Modifier_quartier();
     }
     if(isset($_POST['btnsupprimer_quartier'])){
        supprimer_quartier();
     }
     if(isset($_POST['btnrechercher'])){
        recuperer_un_quartier();
     } 
?>
        <form action="#" method="post">
        <table width="60%" border="0px" align="center">
        <caption>GESTION DES QUARTIERS</caption>
        <tr><td>libelle quartier </td><td>
        <INPUT type="text" name="libelle_quartier" size="20" value="<?php echo $libelle_quartier;?>">
        <INPUT type="submit" name="btnrechercher" value="Rechercher">
        </TD></TR>
         

                    <TR><TD colspan="2" align="center">
                    <INPUT type="submit" name="btnenregistrer_quartier" value="Enregistrer"> 
                    &nbsp;&nbsp;
                    <INPUT type="submit" name="btnmodifier_quartier" value="Modifier">
                    &nbsp;&nbsp;
                    <INPUT type="submit" name="btnsupprimer_quartier" value="Supprimer">
                    </TD></TR>
                    </table>
            <br><?php afficher_les_quartiers();?>     
         </form>
</body>
</html>