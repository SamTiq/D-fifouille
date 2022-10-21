<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <form action="inscription_traitement.php" , method="POST">
        <div class="container">
            <label>Username : </label>
            <input type="text" placeholder="Enter Username" name="username" required>
            <label>Password : </label>
            <input type="password" placeholder="Enter password" name="password" required>
            <label>Retape-Password : </label>
            <input type="password" placeholder="Retape Password" name="retapepassword" required>
            <button type="submit">Sign in</button>
            <input type="checkbox" checked="checked"> Remember me
            <div>
                <a href="login.php"> Se connecter </a>
            </div>
        </div>
    </form>
    <div>
        <?php
        require "connectDb.php";
        require "redirection_index.php";
        if (isset($_GET['reg_err'])) {
            $err = htmlspecialchars($_GET['reg_err']);

            switch ($err) {
                case 'password':
        ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> Les 2 mot de passe sont différents
                    </div>
                <?php
                    break;

                case 'pseudo_length':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> Le pseudo fait plus de 30 caractères
                    </div>
                <?php
                    break;
                case 'already':
                ?>
                    <div class="alert alert-danger">
                        <strong>Erreur</strong> Le pseudo existe déjà
                    </div>
        <?php
            }
        }
        ?>

    </div>

</body>

</html>