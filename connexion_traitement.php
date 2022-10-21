<?php
session_start(); // Démarrage de la session
require "connectDb.php"; // On inclut la connexion à la base de données
require "redirection_index.php";
if (!empty($_POST['username']) && !empty($_POST['password'])) // Si il existe les champs email, password et qu'il sont pas vident
{
    // Patch XSS
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // On regarde si l'utilisateur est inscrit dans la table utilisateurs
    $check = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $check->execute(array($username));
    $data = $check->fetch();
    $row = $check->rowCount();



    // Si > à 0 alors l'utilisateur existe
    if ($row > 0) {
        // Si le mot de passe est le bon
        if ($password == $data['password']) {
            // On créer la session et on redirige sur landing.php
            $_SESSION['username'] = $data['username'];

            header('Location: index.php');
            die();
        } else {
            header('Location: login.php?login_err=password');
            die();
        }
    } else {
        header('Location: login.php?login_err=already');
        die();
    }
} else {
    header('Location: login.php');
    die();
} // si le formulaire est envoyé sans aucune données
