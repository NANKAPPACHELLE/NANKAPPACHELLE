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
    function Enregistrer_eleve(){
        global  $matricule_eleve,$nom_eleve,$classe_eleve,$email_parent,$adresse_eleve,$date_naissance;
        try
        {
            include("connexion_bd.php");
            $sql="INSERT INTO eleve(matricule_eleve,nom_eleve,classe_eleve,email_parent,adresse_eleve,date_naissance) Values (:matricule,:nom,:classe,:emailp,:adresse,:daten)";
            $sql=$db->prepare($sql);
            $sql->bindvalue(':matricule',$matricule_eleve);
            $sql->bindvalue(':nom',$nom_eleve);
            $sql->bindvalue(':classe',$classe_eleve);
            $sql->bindvalue(':emailp',$email_parent);
            $sql->bindvalue(':adresse',$adresse_eleve);
            $sql->bindvalue(':daten',conversion_date_insertion($date_naissance));
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
    
       function Modifier_eleve(){
        global $matricule_eleve,$nom_eleve,$classe_eleve,$email_parent,$adresse_eleve,$date_naissance;
        try
        {

            include("connexion_bd.php");
            $sql="UPDATE eleve set nom_eleve=:nom, classe_eleve=:classe, email_parent=:emailp, adresse_eleve=:adresse, date_naissance=:daten where matricule_eleve=:matricule";

            $sql=$db->prepare($sql);
            $sql->bindvalue(':matricule',$matricule_eleve);
            $sql->bindvalue(':nom',$nom_eleve);
            $sql->bindvalue(':classe',$classe_eleve);
            $sql->bindvalue(':emailp',$email_parent);
            $sql->bindvalue(':adresse',$adresse_eleve);
            $sql->bindvalue(':daten',conversion_date_insertion($date_naissance));
            $sql->execute();
            if ($sql){
                echo "<h4><font color=blue>modification reussie</font></h4>";
            }else{
                echo "<h4><font color=blue>echec de modification</font></h4>";
            }
            $sql->closecursor();
        }
        catch(exeption $e){
            die('erreur:'.$e->getMessage());
        }
       } 
       function supprimer_eleve(){
        global $matricule_eleve,$nom_eleve,$classe_eleve,$email_parent,$adresse_eleve,$date_naissance;
        try
        {
            include("connexion_bd.php");
            $sql=" DELETE from eleve  where matricule_eleve=:matricule";
            $sql=$db->prepare($sql);
            $sql->bindvalue(':matricule',$matricule_eleve);
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
    function recuperer_un_eleve(){ 
        global $matricule_eleve, $nom_eleve, $classe_eleve, $email_parent, $adresse_eleve, $date_naissance;
        try
        { 
            include("connexion_bd.php"); 
            $sql = "SELECT nom_eleve, classe_eleve, email_parent, date_format(date_naissance,'%d/%m/%Y') as date_naissance, adresse_eleve FROM eleve WHERE matricule_eleve=:matricule";
            $sql = $db->prepare($sql);
            $sql->bindValue(':matricule', $matricule_eleve);
            $sql->execute();
            while($donnees = $sql->fetch(PDO::FETCH_ASSOC)){
                $nom_eleve = $donnees['nom_eleve'];
                $classe_eleve = $donnees['classe_eleve'];
                $email_parent = $donnees['email_parent'];
                $adresse_eleve = $donnees['adresse_eleve'];
                $date_naissance = $donnees['date_naissance'];
            }
            $sql->closeCursor();
        }
        catch(Exception $e)
        {
            die('erreur:'.$e->getMessage());
        }
    }function afficher_les_eleves(){
        try{
            include("connexion_bd.php");
            $sql = "SELECT matricule_eleve, nom_eleve, classe_eleve, email_parent, adresse_eleve, date_naissance 
        FROM eleve";

            $sql = $db->prepare($sql);
            $sql->execute();
            if($sql->rowCount() > 0){
                echo "<table width=\"80%\" border=\"0px\" align=\"center\">";
                echo "<caption>LISTE DES ELEVES</caption>";
                echo "<tr><th>Matricule</th><th>Nom</th><th>Classe</th><th>email</th><th>adresse</th><th>Date de Naissance</th>";
                while($donnees = $sql->fetch(PDO::FETCH_ASSOC)){
                    $a = $donnees['matricule_eleve'];
                    $b = $donnees['nom_eleve'];
                    $c = $donnees['classe_eleve'];
                    $d = $donnees['email_parent'];
                    $e = $donnees['adresse_eleve'];
                    $f = $donnees['date_naissance'];
                    
                    echo "<tr style=\"background-color:#CFA324;\">
                          <td>$a</td><td>$b</td><td> $c</td> <td> $d</td> <td> $e</td>
                          <td>$f</td></tr>";
                }
                $sql->closeCursor();
                echo "</table>";
            }
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }
    
    
    function conversion_date_insertion($date_insertion){ //elle nous permet de passer du formet de la date JJ/MM/AAAA->AAAA-MM-JJ
      $a= explode("/",$date_insertion);
      return $a[2]."-".$a[1]."-".$a[0];
  }
    
?>
   
  </head>
    <body>
    <?php
      include("menu_horizontal/texte_menu_horizontal_simple.txt");


    $matricule_eleve="";
    $nom_eleve="";
    $classe_eleve="";
    $email_parent="";
    $adresse_eleve="";
    $date_naissance="";
    
    if(isset($_POST['matricule_eleve'])){
        $matricule_eleve=$_POST['matricule_eleve'];
    }
    if(isset($_POST['nom_eleve'])){
        $nom_eleve=$_POST['nom_eleve'];
    }
    if(isset($_POST['classe_eleve'])){
        $classe_eleve=$_POST['classe_eleve'];
    }
    if(isset($_POST['email_parent'])){
        $email_parent=$_POST['email_parent'];
    }
    if(isset($_POST['adresse_eleve'])){
        $adresse_eleve=$_POST['adresse_eleve'];
    }
    if(isset($_POST['date_naissance'])){
        $date_naissance=$_POST['date_naissance'];
    }
    if(isset($_POST['btnenregistrer_eleve'])){
        Enregistrer_eleve();
     }
     if(isset($_POST['btnmodifier_eleve'])){
        Modifier_eleve();
     }
     if(isset($_POST['btnsupprimer_eleve'])){
        supprimer_eleve();
     }
     if(isset($_POST['btnrechercher'])){
        recuperer_un_eleve();
     } 
?>
        <form action="#" method="post">
        <table width="60%" border="0px" align="center">
        <caption>GESTION DES ELEVES</caption>
        <tr><td>matricule eleve</td><td>
        <INPUT type="text" name="matricule_eleve" size="20" value="<?php echo $matricule_eleve;?>">
        <INPUT type="submit" name="btnrechercher" value="Rechercher">
        </TD></TR>
        <tr><td>nom de l'eleve</td><td>
            <INPUT type="text" name="nom_eleve" size="20" value="<?php echo $nom_eleve;?>">
            
            </TD></TR>

            <tr><td>classe eleve</td><td>
            <INPUT type="text" name="classe_eleve" size="20" value="<?php echo $classe_eleve;?>">
            
            </TD></TR>

            <tr>
    <td>email du parent</td>
    <td>
        <input type="mail" name="email_parent" size="20" value="<?php echo $email_parent;?>">
    </td>
</tr>
            <tr><td>adresse eleve</td><td>
            <INPUT type="text" name="adresse_eleve" size="20" value="<?php echo $adresse_eleve;?>">
            
            </TD></TR>
            

            <tr><td>date naissance</td><td>
                <INPUT type="text" name="date_naissance" size="20" value="<?php echo $date_naissance;?>">
                </TD></TR> 

                    <TR><TD colspan="2" align="center">
                    <INPUT type="submit" name="btnenregistrer_eleve" value="Enregistrer"> 
                    &nbsp;&nbsp;
                    <INPUT type="submit" name="btnmodifier_eleve" value="Modifier">
                    &nbsp;&nbsp;
                    <INPUT type="submit" name="btnsupprimer_eleve" value="Supprimer">
                    </TD></TR>
                    </table>
            <br><?php afficher_les_eleves();?>     
         </form>
</body>
</html>