<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="connexion_traitement.php" , method="POST">
        <div class="container">
            <label>Username : </label>
            <input type="text" placeholder="Enter Username" name="username" required>
            <label>Password : </label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <button type="submit">Login</button>
            <input type="checkbox" checked="checked"> Remember me
            <div>
                <a href="#"> Forgot password? </a>
            </div>
            <div>
                <a href="inscription.php"> Pas encore inscrit </a>
            </div>
        </div>
    </form>
    <div>
        <?php
        require "connectDb.php";
        require "redirection_index.php";
        if (isset($_GET['login_err'])) {
            $err = htmlspecialchars($_GET['login_err']);

            switch ($err) {
                case 'password':
        ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> mot de passe incorrect
                    </div>
                <?php
                    break;

                case 'already':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> compte non existant
                    </div>
                <?php
                    break;

                case 'inscription':
                ?>
                    <div class="alert alert-danger">
                        <strong>Votre compte a bien été crée</strong> Vous pouvez vous connecter
                    </div>
        <?php
                    break;
            }
        }
        ?>

    </div>

</body>

</html>