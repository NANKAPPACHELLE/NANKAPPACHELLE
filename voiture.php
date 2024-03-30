<html>
    <head>
        <title>Gestion des chauffeurs</title>
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
        function recuperer_codes_chauffeur(){
            global $code_chauffeur;
            try
            {
                include("connexion_bd.php");
                $sql="SELECT code_chauffeur FROM chauffeur ";
                $sql=$db->prepare($sql);
                $sql->execute();
                echo "<select name=\"code_chauffeur\"onchange=\"submit()\">";
                $a="";
                echo '< option value="'.$a.'">'.$a.'</option>';
                while($donnees=$sql->fetch(PDO::FETCH_ASSOC)){
                    $a=$donnees['code_chauffeur'];
                    if($code_chauffeur==$a){
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


            function Enregistrer_voiture(){
                global $numero_voiture,$marque_voiture,$nbre_place,$code_chauffeur;
                try
                {
                    include("connexion_bd.php");
                    $sql="INSERT INTO voiture(numero_voiture,marque_voiture,nbre_place,code_chauffeur) 
                    Values (:numero,:marque,:nbre,:code)";
                    $sql=$db->prepare($sql);
                    $sql->bindvalue(':numero',$numero_voiture);
                    $sql->bindvalue(':marque',$marque_voiture);
                    $sql->bindvalue(':nbre',$nbre_place);
                    $sql->bindvalue(':code',$code_chauffeur);
                    $sql->execute();
                    if ($sql){
                        echo "<h3><font color=blue>insertion reussie</font></h3>";
                    }else{
                        echo "<h3><font color=blue>echec d'insertion</font></h3>";
                    }
                    $sql->closecursor();
                }
                catch(exception $e){
                    die('erreur:'.$e->getMessage());
                }
            }



            function Modifier_voiture(){
                global $numero_voiture,$marque_voiture,$nbre_place,$code_chauffeur;
                try
                {
                    include("connexion_bd.php");
                    $sql="UPDATE voiture set marque_voiture=:marque,nbre_place=:nbre,code_chauffeur=:code 
                    where numero_voiture=:numero";
                    $sql=$db->prepare($sql);
                    $sql->bindvalue(':numero',$numero_voiture);
                    $sql->bindvalue(':marque',$marque_voiture);
                    $sql->bindvalue (':nbre',$nbre_place);
                    $sql->bindvalue(':code',$code_chauffeur);
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


            function supprimer_voiture(){
                global $numero_voiture;
                try
                {
                    include("connexion_bd.php");
                    $sql=" DELETE from  voiture  where numero_voiture=:numero";
                    $sql=$db->prepare($sql);
                    $sql->bindvalue(':numero',$numero_voiture);
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


            function recuperer_une_voiture(){
                global $numero_voiture,$marque_voiture,$nbre_place,$code_chauffeur;
                Try{
                    include("connexion_bd.php");
                    $sql="SELECT marque_voiture,nbre_place,code_chauffeur FROM voiture 
                    WHERE numero_voiture=:numero";
                    $sql = $db -> prepare($sql);
                    $sql -> bindvalue(':numero',$numero_voiture);
                    $sql -> execute();
                    while($donnees=$sql -> fetch(PDO::FETCH_ASSOC)){
                        $marque_voiture=$donnees['marque_voiture'];
                        $nbre_place=$donnees['nbre_place'];
                        $code_chauffeur=$donnees['code_chauffeur'];
                    }
                    $sql -> closecursor();
                }
                catch(Exception $e){
                    die('Erreur' .$e -> getMessage());
                }
            }


            function verification_numero_voiture(){
                global $numero_voiture;
                try  
                {
                    include("connexion_bd.php"); 
                    $sql="SELECT * FROM voiture where numero_voiture=:numero ";
                    $sql=$db->prepare($sql);
                    $sql->bindvalue(':numero',$numero_voiture);
                    $sql->execute();
                    $n=0;
                    if($sql->rowcount()>0){
                        $n=$sql->rowcount();
                    }
                        $sql->closecursor();
                        return $n;
                    }
                catch(Exeption $e){
                    die('erreur:'.$e->getMessage());
                }
            }


            function afficher_les_voitures(){
                try{
                    include("connexion_bd.php");
                    $sql="SELECT numero_voiture,marque_voiture,nbre_place,nom_chauffeur 
                    from voiture,chauffeur where chauffeur.code_chauffeur=voiture.code_chauffeur";
                    $sql=$db->prepare($sql);
                    $sql->execute();
                    if($sql->rowcount()>0){
                        echo "<table width=\"80%\" border=\"0px\" align=\"center\">";
                        echo "<caption>LISTE DES VOITURES</caption>";
                        echo "<tr><th>Numero</th><th>Marque</th><th>Capacité</th>
                        <th>chauffeur</th></tr>";
                        while($donnees=$sql->fetch(PDO::FETCH_ASSOC)){
                            $a=$donnees['numero_voiture'];
                            $b=$donnees['marque_voiture'];
                            $c=$donnees['nbre_place'];
                            $d=$donnees['nom_chauffeur'];
                            echo "<tr style=\"background-color:#CFA324;\"><td>$a</Td><Td>$b</Td>
                            <Td>$c</Td><td>$d</td></tr>";
                        }
                        $sql->closecursor();
                        echo "</table>";
                    }
                }
                catch(Exeption $e){
                    die('Erreur:'.$e->getMessage());
                }
            }
    ?>
    
</head>
 <body>
        <?php
             
             
             
            include("menu_horizontal/texte_menu_horizontal_simple.txt");
            $numero_voiture="";
            $marque_voiture="";
            $nbre_place="";
            $code_chauffeur="";
            $nom_chauffeur="";
            if(isset($_POST['code_chauffeur'])){
                $code_chauffeur=$_POST['code_chauffeur'];
                recuperer_nom_chauffeur();
            }
            if(isset($_POST['numero_voiture'])){
            $numero_voiture=$_POST['numero_voiture'];
            }
            if(isset($_POST['marque_voiture'])){
            $marque_voiture=$_POST['marque_voiture'];
            }
            if(isset($_POST['nbre_place'])){
            $nbre_place=$_POST['nbre_place'];
            }
            if(isset($_POST['code_chauffeur'])){
            $code_chauffeur=$_POST['code_chauffeur'];
            }
            if(isset($_POST['btnenregistrer_voiture'])){
                if(verification_numero_voiture()==0){
                    Enregistrer_voiture();
                }else{
                    echo "<center><h2><font color=red>
                    Votre numéro de voiture existe déja</font></H2></center>";
            }
            }
            if(isset($_POST['btnmodifier_voiture'])){
                modifier_voiture();
            }
            if(isset($_POST['btnsupprimer_voiture'])){
                supprimer_voiture();
            }
            if(isset($_POST['btnrechercher'])){
                recuperer_une_voiture();
            }
        ?>
<form action="#" method="post">
    <table width="60%" border="0px" align="center">
        <caption> GESTION DES VOITURES</caption>
            <tr><td>Numero de voiture</td>
            <td>
                <INPUT type="text" name="numero_voiture" size="20" value="<?php echo $numero_voiture;?>">
                <INPUT type="submit" name="btnrechercher" value="Rechercher">
            </td>
        </tr>

                <tr><td>Marque de voiture</td><td>
                <INPUT type="text" name=" marque_voiture" size="20" value="<?php echo $marque_voiture;?>">
        </td></tr>

               <tr><td>Nombre de place</td><td>
               <INPUT type="text" name=" nbre_place" size="20" value="<?php echo $nbre_place;?>">
        </td></tr>

              <tr><td>Code du chauffeur</td>
              <td>    
                <?php recuperer_codes_chauffeur();?>
              </Td> </Tr>
              <tr><td>Nom du chauffeur</td><td>
                   <?php echo $nom_chauffeur;?>
        </td></tr>
               <td colspan="2" align="center">
                    <INPUT type="submit" name="btnenregistrer_voiture" value="Enregistrer"> 
                    &nbsp;&nbsp;
                    <INPUT type="submit" name="btnmodifier_voiture" value="Modifier">
                    &nbsp;&nbsp;
                    <INPUT type="submit" name="btnsupprimer_voiture" value="Supprimer">
        </td>
        </table>
        <br>
        <?php afficher_les_voitures();?>
        </form>
    </body>
</html>