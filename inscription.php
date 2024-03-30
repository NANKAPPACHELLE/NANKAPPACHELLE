<?php
session_start();
$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
$db=new PDO('mysql:host=localhost;dbname=la_difference','root','',$pdo_options);
$db -> exec("SET NAMES'utf8'");

if(isset($_POST['envoi'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){    
       $pseudo=htmlspecialchars($_POST['pseudo']);
       $mdp=sha1($_POST['mdp']); 
       $insertUser = $db->prepare('INSERT INTO users(pseudo,mdp)VALUES(?, ?)'); 
       $insertUser ->execute(array($pseudo,$mdp)); 
       
      
      
       $recupUser=$db->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
       $recupUser->execute(array($pseudo, $mdp));
          if($recupUser->rowCount() > 0){ 
             $_SESSION['pseudo'] = $pseudo;
             $_SESSION['mdp'] = $mdp;
             $_SESSION['id'] = $recupUser->fetch()['id'] ;
        }

               echo $_SESSION['id'];
    }else{
            echo"veuillez completer tous les champs...";
        }
    }else{
        echo"veuillez completer tous les champs...";
    }
   
?>


<!DOCTYPE html>
<html>
<head>
    <title>inscription</title>
    <meta charset="utf-8">
</head>
<body>
    <form method="POST" action="" align="center">
        <input type="text" name="pseudo" autocomplete="off">
        <br>
        <input type="password" name="mdp" autocomplete="off">
        <input type="submit" name="envoi">
</br>
</form>
</body>
</html>