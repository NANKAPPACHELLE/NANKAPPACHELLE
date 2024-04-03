<html>
    <head>
        <title>Gestion des chauffeurs</title>
        <meta charset="utf-8">
        <script src="menu_horizontal/SpryMenuBar.js" type="text/javascript"></script>
     <link href="menu_horizontal/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

        <link hel="stylesheet" media="screen" type="text/css" href="formatage.css"/>
        <link rel="stylesheet" type="text/css" href="styles.css">
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
   function Enregistrer_chauffeur(){
    global $code_chauffeur,$nom_chauffeur,$date_naissance,$type_permis;
    try
    {
        include("connexion_bd.php");
        $sql="INSERT INTO chauffeur(code_chauffeur,nom_chauffeur,date_naissance,type_permis) Values (:code,:nom,:daten,:typep)";
        $sql=$db->prepare($sql);
        $sql->bindvalue(':code',$code_chauffeur);
        $sql->bindvalue(':nom',$nom_chauffeur);
        $sql->bindvalue(':daten',conversion_date_insertion($date_naissance));
        $sql->bindvalue(':typep',$type_permis);
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


   function Modifier_chauffeur(){
    global $code_chauffeur,$nom_chauffeur,$date_naissance,$type_permis;
    try
    {
        include("connexion_bd.php");
        $sql="UPDATE chauffeur set nom_chauffeur=:nom,date_naissance=:daten,type_permis=:typep where code_chauffeur=:code";
        $sql=$db->prepare($sql);
        $sql->bindvalue(':code',$code_chauffeur);
        $sql->bindvalue(':nom',$nom_chauffeur);
        $sql->bindvalue(':daten',conversion_date_insertion($date_naissance));
        $sql->bindvalue(':typep',$type_permis);
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


   function supprimer_chauffeur(){
    global $code_chauffeur,$nom_chauffeur,$date_naissance,$type_permis;
    try
    {
        include("connexion_bd.php");
        $sql=" DELETE from  chauffeur  where code_chauffeur=:code";
        $sql=$db->prepare($sql);
        $sql->bindvalue(':code',$code_chauffeur);
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
   
   
   function recuperer_un_chauffeur(){ 
    global $code_chauffeur,$nom_chauffeur,$date_naissance,$type_permis;
    try
    { 
        include("connexion_bd.php"); 
        $sql="SELECT  nom_chauffeur,date_format(date_naissance,'%d/%m/%Y') as date_naissance,type_permis from chauffeur where code_chauffeur=:code";
        $sql=$db->prepare($sql);
        $sql->bindvalue(':code',$code_chauffeur);
        $sql->execute();
        while($donnees=$sql->fetch(PDO::FETCH_ASSOC)){
            $nom_chauffeur=$donnees['nom_chauffeur'];
            $date_naissance=$donnees['date_naissance'];
            $type_permis=$donnees['type_permis'];
        }
        $sql->closecursor();
    }
     catch(exeption $e)
     {
        die('erreur:'.$e->getMessage());
    }
}
function afficher_les_chauffeurs(){
    try{
        include("connexion_bd.php");
        $sql = "SELECT code_chauffeur, nom_chauffeur, date_naissance, type_permis 
                FROM chauffeur";
        $sql = $db->prepare($sql);
        $sql->execute();
        if($sql->rowCount() > 0){
            echo "<table width=\"80%\" border=\"0px\" align=\"center\">";
            echo "<caption>LISTE DES CHAUFFEURS</caption>";
            echo "<tr><th>Code</th><th>Nom</th><th>Date de Naissance</th>
                  <th>Type de Permis</th></tr>";
            while($donnees = $sql->fetch(PDO::FETCH_ASSOC)){
                $a = $donnees['code_chauffeur'];
                $b = $donnees['nom_chauffeur'];
                $c = $donnees['date_naissance'];
                $d = $donnees['type_permis'];
                echo "<tr style=\"background-color:#CFA324;\">
                      <td>$a</td><td>$b</td><td> $c</td>
                      <td>$d</td></tr>";
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


    $code_chauffeur="";
    $nom_chauffeur="";
    $date_naissance="";
    $type_permis="";
    if(isset($_POST['code_chauffeur'])){
        $code_chauffeur=$_POST['code_chauffeur'];
    }
    if(isset($_POST['nom_chauffeur'])){
        $nom_chauffeur=$_POST['nom_chauffeur'];
    }
    if(isset($_POST['date_naissance'])){
        $date_naissance=$_POST['date_naissance'];
    }
    if(isset($_POST['type_permis'])){
        $type_permis=$_POST['type_permis'];
    }
    if(isset($_POST['btnenregistrer_chauffeur'])){
        Enregistrer_chauffeur();
     }
     if(isset($_POST['btnmodifier_chauffeur'])){
        modifier_chauffeur();
     }
     if(isset($_POST['btnsupprimer_chauffeur'])){
        supprimer_chauffeur();
     }
     if(isset($_POST['btnrechercher'])){
        recuperer_un_chauffeur();
     }
    ?>
        <form action="#" method="post">
        <table width="60%" border="0px" align="center">
        <caption>GESTION DES CHAUFFEURS</caption>
        <tr><td>code du chauffeur</td><td>
        <INPUT type="text" name="code_chauffeur" size="20" value="<?php echo $code_chauffeur;?>">
        <INPUT type="submit" name="btnrechercher" value="Rechercher">
        </TD></TR>
        <tr><td>nom du chauffeur</td><td>
            <INPUT type="text" name="nom_chauffeur" size="20" value="<?php echo $nom_chauffeur;?>">
            
            </TD></TR>
            <tr><td>date de naissance</td><td>
                <INPUT type="text" name="date_naissance" size="20" value="<?php echo $date_naissance;?>">
                
                </TD></TR>
                <tr><td>type de permis </td><td>
                    <INPUT type="text" name="type_permis" size="20" value="<?php echo $type_permis;?>">
                    
                    </TD></TR>
                    <TR><TD colspan="2" align="center">
                    <INPUT type="submit" name="btnenregistrer_chauffeur" value="Enregistrer"> 
                    &nbsp;&nbsp;
                    <INPUT type="submit" name="btnmodifier_chauffeur" value="Modifier">
                    &nbsp;&nbsp;
                    <INPUT type="submit" name="btnsupprimer_chauffeur" value="Supprimer">
                    </TD></TR>
                    
            </table>
            <br><?php afficher_les_chauffeurs();?>
        </form>
</body>

</html>