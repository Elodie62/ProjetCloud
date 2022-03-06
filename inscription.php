<?php
session_start();
include("user.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/inscription.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
</head>

 <body>
    <div class="div_inscription">
        <div class="part_up">
            <img class="img_co" src="img/motionPictures.png">
        </div>
        <div class="part_down">
            <h1>Inscrivez-vous !</h1>
            <form class="form_inscription" action="" method="POST">
                <?php if (isset($_SESSION['errorMail'])) { ?> <p style="color:red;"> <?= $_SESSION['errorMail'] ?> </p> <?php } ?>
                <label for="Lastname">
                        <p>Nom :</p>
                        <input class="input_form" name="nom" id="Lastname" type="text" /><br>
                </label>

                <label for="Firstname">
                    <p>Prénom :</p>
                    <input class="input_form" name="prenom" id="Firstname" type="text"/><br>
                </label>

                <label for="dateBirthday">
                    <p>Date de naissance :</p>
                    <input class="input_form" name="birth_date" id="birth_date" type="date"/><br>
                </label>

                <label for="Email" class="mail">
                    <p>Email :</p>
                    <input class="input_form" name="mail" id="Email" type="email" /><br>
                </label>

                <label for="password">
                    <p>Mot de passe :</p>
                    <input class="input_form" name="mdp" id="password" type="password" required" /><br>
                </label>

                <input class="btn_valid" type="submit" value="Valider" /><br>
                <a class="a_form" href="connexion.php">Vous avez déjà un compte ? Connectez-vous !</a>
            </form>
        </div>
    </div>
 </body>


</html>

    <?php
    if (isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['birth_date'])) {
        $user = new User($_POST['mail'], $_POST['mdp'], $_POST['nom'], $_POST['prenom'], $_POST['birth_date']);
    } ?>







