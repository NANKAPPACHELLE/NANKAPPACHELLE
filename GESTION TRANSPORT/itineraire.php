<html>
    <head>
        <title>Gestion des ITINERAIRES</title>
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
function recuperer_numero_voiture(){
    global $numero_voiture;
    try
    {
        include("connexion_bd.php");
        $sql="SELECT voiture.numero_voiture  FROM voiture "; 
        $sql=$db->prepare($sql);
        $sql->execute();
        echo "<select name=\"voiture.numero_voiture\" onchange=\"submit()\">";
        $a="";
        echo '<option value="'.$a.'">'.$a.'</option>'; 
        while($donnees=$sql->fetch(PDO::FETCH_ASSOC)){
            $a=$donnees['numero_voiture'];
            {
            if($numero_voiture==$a){
                echo '<option value="'.$a.'" selected>'.$numero_voiture.'</option>';
            }else{
                echo '<option value="'.$a.'">'.$numero_voiture.'</option>'; // Affichez le numéro de la voiture dans l'option
            }
        }
        $sql->closecursor();
        echo "</select>";
    }}
    catch(Exception $e){
       die('erreur:'.$e->getMessage());
   }
}

function enregistrer_itineraire(){
    global $id_itineraire, $libelle_itineraire, $numero_voiture;
    try{
        include("connexion_bd.php");
        $sql = "INSERT INTO itineraire (id_itineraire, libelle_itineraire, numero_voiture) values (:id, :libelle, :numero)";
        $sql = $db->prepare($sql);
        $sql->bindValue(':id', $id_itineraire);
        $sql->bindValue(':libelle', $libelle_itineraire);
        $sql->bindValue(':numero', $numero_voiture);
        $sql->execute();
        if ($sql){
            echo "<h3><font color=\"blue\">Insertion réussie</font></h3>";
        } else{
            echo "<h3><font color=\"blue\">Échec de l'insertion</font></h3>";
        }
        $sql->closeCursor();
    }
    catch(Exception $e){
        die('Erreur :'.$e->getMessage());
    }
}
function Modifier_itineraire(){
    global $id_itineraire,$libelle_itineraire,$numero_voiture;
    try
    {
        include("connexion_bd.php");
        $sql="UPDATE itineraire set libelle_itineraire=:libelle,numero_voiture=:numero
        where id_libelle=:id";
        $sql=$db->prepare($sql);
        $sql->bindvalue(':id',$id_itineraire);
        $sql->bindvalue(':libelle',$libelle_itineraire);
        $sql->bindvalue(':numero',$numero_voiture);
        $sql->execute();
        if ($sql){
            echo "<h4><font color=blue>modification reussie</font></h4>";
        }else{
            echo "<h4><font color=blue>echec de modification</font></h4>";
        }
        $sql->closecursor();
    }
    catch(Exception $e){
        die('erreur:'.$e->getMessage());
    }
}
function supprimer_itineraire(){
    global $id_itineraire, $libelle_itineraire;
    try{
        include("connexion_bd.php");
        $sql = "DELETE FROM itineraire WHERE id_itineraire = :id ";
        $sql = $db->prepare($sql);
        $sql->bindValue(':id', $id_itineraire);
        $sql->execute();
        if ($sql){
            echo "<h4><font color=\"blue\">Suppression réussie</font></h4>";
        } else {
            echo "<h4><font color=\"blue\">Échec de la suppression</font></h4>";
        }
        $sql->closeCursor();
    }
    catch(Exception $e){
        die('Erreur : '. $e->getMessage());
    }
}

function verification_id_itineraire(){
    global $id_itineraire;
    try  {
        include("connexion_bd.php"); 
        $sql="SELECT * FROM itineraire where id_itineraire=:id";
        $sql=$db->prepare($sql);
        $sql->bindvalue(':id',$id_itineraire);
        $sql->execute();
        $n=0;
        if($sql->rowcount()>0){
            $n=$sql->rowcount();
        }
            $sql->closecursor();
            return $n;
        }
    catch(Exception $e){
        die('erreur:'.$e->getMessage());
    }
}
function afficher_les_itineraires(){
    try{
        include("connexion_bd.php");
        $sql="SELECT id_itineraire,libelle_itineraire,voiture.numero_voiture 
        from itineraire,voiture where voiture.numero_voiture=itineraire.numero_voiture";
        $sql=$db->prepare($sql);
        $sql->execute();
        if($sql->rowcount()>0){
            echo "<table width=\"80%\" border=\"0px\" align=\"center\">";
            echo "<caption>LISTE DES ITINERAIRES</caption>";
            echo "<tr><th>id</th><th>libelle</th><th>chauffeur</th></tr>";
            while($donnees=$sql->fetch(PDO::FETCH_ASSOC)){
                $a=$donnees['id_itineraire'];
                $b=$donnees['libelle_itineraire'];
                $c=$donnees['numero_voiture'];
                echo "<tr style=\"background-color:#CFA324;\"><td>$a</Td><Td>$b</Td><Td>$c</Td>";
            }
            $sql->closecursor();
            echo "</table>";
        }
    }
    catch(Exception $e){
        die('Erreur:'.$e->getMessage());
    }
}

?>
<body>
<?php              
             include("menu_horizontal/texte_menu_horizontal_simple.txt");
             $id_itineraire="";
             $libelle_itineraire="";
             $numero_voiture="";
             $code_chauffeur="";
             $nom_chauffeur="";
             if(isset($_POST['numero_voiture'])){
                 $numero_voiture=$_POST['numero_voiture'];
                 recuperer_nom_chauffeur();
             }
             if(isset($_POST['id_itinerairee'])){
             $id_itineraire=$_POST['id_itineraire'];
             }
             if(isset($_POST['code_chauffeur'])){
             $code_chauffeur=$_POST['code_chauffeur'];
             }
             if(isset($_POST['btnenregistrer_itineraire'])){
                 if(verification_id_itineraire()==0){
                     Enregistrer_itineraire();
                 }else{
                     echo "<center><h2><font color=red>
                     Votre id de l'itineraire existe déja</font></H2></center>";
             }
             }
             if(isset($_POST['btnmodifier_itineraire'])){
                 modifier_itineraire();
             }
             if(isset($_POST['btnsupprimer_itineraire'])){
                 supprimer_itineraire();
             }
             if(isset($_POST['btnrechercher'])){
                 recuperer_un_itineraire();
             }
         ?>
 <form action="#" method="post">
     <table width="60%" border="0px" align="center">
         <caption> GESTION DES ITINERAIRES</caption>
             <tr><td>id_itineraire</td>
             <td>
                 <INPUT type="text" name="id_itineraire" size="20" value="<?php echo $id_itineraire;?>">
                 <INPUT type="submit" name="btnrechercher" value="Rechercher">
             </td>
         </tr>
 
                 <tr><td>libelle_itineraire</td><td>
                 <INPUT type="text" name=" libelle_itineraire" size="20" value="<?php echo $libelle_itineraire;?>">
         </td></tr>
 
            <tr><td>numero_voiture</td>
               <td>    
               <?php recuperer_numero_voiture();?>
               </Td> </Tr>
            
                <td colspan="2" align="center">
                     <INPUT type="submit" name="btnenregistrer_itineraire" value="Enregistrer"> 
                     &nbsp;&nbsp;
                     <INPUT type="submit" name="btnmodifier_itineraire" value="Modifier">
                     &nbsp;&nbsp;
                     <INPUT type="submit" name="btnsupprimer_itineraire" value="Supprimer">
         </td>
         </table>
         <br>
         <?php afficher_les_itineraires();?>
         </form>
     </body>
 </html>