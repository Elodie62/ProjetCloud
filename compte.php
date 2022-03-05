<?php
session_start();
include("bdd.php");
$Bdd = getPDO();
$userReq = $Bdd->prepare("SELECT * FROM user WHERE mail = :mail");
$userReq->execute([
    ':mail' => $_SESSION['mail']
]);
$user = $userReq->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Votre compte</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
</head>
<body>

<!--NAVBAR VERTICALE-->
<div class="row">
    <div class="nav-bar">

        <ul class="ul_navbar">
            <li class="li_logo_navbar">MotionPictures</li>
            <li class="li_navbar">
                <img class="img_navbar" src="img/user_icon_navbar.svg">
                <a class="a_navbar" href="compte.php">Mon compte</a>
            </li>
            <li class="li_navbar">
                <img class="img_navbar" src="img/galery_icon_navbar.svg">
                <a class="a_navbar" href="galerie.php">Voir mes photos</a>
            </li>
            <li class="li_navbar">
                <img class="img_navbar" src="img/add_icon_navbar.svg">
                <a class="a_navbar" href="ajout_photo.php">Ajouter des photos</a>
            </li>
        </ul>
    </div>

    <div class="contenu">
        <img src="img/undraw_male_avatar_323b.png" id="avatar_compte">
        <p id="profile_name"><?php echo $user['prenom']," " ,$user['nom']; ?></p>

        <div class="div_compte">
            <h2>Votre espace restant :</h2>
            <p>Votre espace utilisé : ...gO</p>
            <p>Votre espace autorisé : ...gO</p>
            <p>Il vous reste : ...gO</p>
        </div>

        <div class="div_compte">
            <h2>Vos informations</h2>
            <p>Votre nom : <?php echo $user['nom']; ?></p>
            <p>Votre prénom : <?php echo  $user['prenom']; ?></p>
            <p>Votre date de naissance : <?php echo  $user['birth_date']; ?></p>
            <p>Votre e-mail : <?php echo  $user['mail']; ?></p>
            <div class="row">
                <button class="btn_modif">Modifier mes informations</button>
                <button class="btn_modif">Modifier mon mot de passe</button>
            </div>
        </div>

        <div class="div_compte">
            <h2>Votre abonnement :</h2>
            <div class="row">
                <img id="img_abonnement" src="img/8712709_camera_photo_photography_icon.png">
                <div style="width: 80%">
                    <p id="abonnement">Motion Pictures free</p>
                    <button class="btn_modif btn_ab">Changer d'abonnement</button>
                </div>
            </div>

        </div>


        <a href="deconnexion.php" class="btn_supp">Se déconnecter</a>
    </div>

</div>

</body>
</html>
