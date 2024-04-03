<?php
session_start();
$pdo_options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$db = new PDO('mysql:host=localhost;dbname=la_difference', 'root', '', $pdo_options);
$db->exec("SET NAMES'utf8'");

if (isset($_POST['envoi'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['mdp'])) {
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $mdp = sha1($_POST['mdp']); // Note: Utiliser sha1 pour le hachage du mot de passe n'est plus recommandé. Considérez d'autres méthodes plus sécurisées.

        $sql = $db->prepare('SELECT * FROM users WHERE pseudo = ? AND mdp = ?');
        $sql->execute(array($pseudo, $mdp));

        if ($sql->rowCount() > 0) {
            $_SESSION["pseudo"] = $pseudo;
            $_SESSION["mdp"] = $mdp;
            $_SESSION["id"] = $sql->fetch()["id"];
            header('Location: index.php');
            exit;
        } else {
            echo "Veuillez compléter tous les champs...";
        }
    } else {
        echo "Veuillez compléter tous les champs...";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
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