<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require "connectDb.php"; // On inclu la connexion à la bdd
require "redirection_index.php";

echo $_POST['username'];
echo $_POST['password'];
echo $_POST['retapepassword'];
// Si les variables existent et qu'elles ne sont pas vides
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['retapepassword'])) {
    // Patch XSS
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $retapepassword = htmlspecialchars($_POST['retapepassword']);;

    // On vérifie si l'utilisateur existe
    $check = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $check->execute(array($username));
    $data = $check->fetch();
    $row = $check->rowCount();

    // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
    if ($row == 0) {
        if (strlen($username) <= 30) { // On verifie que la longueur du pseudo <= 15
            if ($retapepassword === $password) { // si les deux mdp saisis sont bon

                $status = 1;
                // On insère dans la base de données
                $insert = $pdo->prepare('INSERT INTO users(username, password) VALUES(?, ?)');
                $insert->execute(array($username, $password));
                // On redirige avec le message de succès
                header('Location: login.php?login_err=inscription');
                die();
            } else {
                header('Location: inscription.php?reg_err=password');
                die();
            }
        } else {
            header('Location: inscription.php?reg_err=pseudo_length');
            die();
        }
    } else {
        header('Location: inscription.php?reg_err=already');
        die();
    }
}
