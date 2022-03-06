<?php
session_start();
include("user.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
</head>

<body>

<div class="section_connexion">
    <div class="part_left">
        <img class="img_co" src="img/motionPictures.png">
    </div>
    <div class="part_right">
        <h1>Connectez-vous ! </h1>
          <form action="" method="POST">
            <?php if (isset($_SESSION['error'])) { ?> <p style="color:red;"> <?= $_SESSION['error'] ?> </p> <?php } ?>
              <p>Adresse mail</p>
            <input class="input_form" type="email" name="mail" /><br>
              <p>Mot de passe</p>
            <input class="input_form" type="password" name="mdp" /><br>
            <input class="btn_valid" type="submit" value="Connexion" /><br>

              <a class="a_form" href="">Mot de passe oublié</a><br>
              <a class="a_form" href="inscription.php">Pas de compte ? Inscrivez-vous !</a>
          </form>
    </div>
</div>

</body>

</html>

<?php
if (isset($_POST['mail']) && isset($_POST['mdp'])) {
  $user = new User($_POST['mail'], $_POST['mdp']);
  header('Location:accueil.php');
}

?>