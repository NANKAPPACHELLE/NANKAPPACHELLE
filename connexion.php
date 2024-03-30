<?php
session_start();
$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
$db=new PDO('mysql:host=localhost;dbname=la difference','root','',$pdo_options);
$db -> exec("SET NAMES'utf8'");
if(isset($_POST['envoi'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){    
       $pseudo=htmlspecialchars($_POST["pseudo"]);
       $mdp=sha1($_POST['mdp']); 
       $sql=$db->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
       $sql->execute(array($pseudo, $mdp));
          if($sql->rowCount() > 0){ 
             $_SESSION["pseudo"] = $pseudo;
             $_SESSION["mdp"] = $mdp;
             $_SESSION["id"] = $sql->fetch()["id"];
             header['Location: index.php'];

        }else{
            echo"veuillez completer tous les champs...";
        }
    }else{
        echo"veuillez completer tous les champs...";
    }
}   
?>

<!DOCTYPE html>
<html>
<head>
    <title>connexion</title>
    <meta charset="utf-8">
</head>
<body>
    <form method="POST" action="" align="center">
        <input type="text" name="pseudo" autocomplete="off">
        <br>
        <input type="password" name="mdp" autocomplete="off">
        <br><br>
        <input type="submit" name="envoi">
</form>
</body>
</html>