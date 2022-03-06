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
    <link rel="stylesheet" href="css/compte.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <?php
    include 'navbar.php'
    ?>
    <section>
        <img src="img/undraw_male_avatar_323b.png" id="avatar_compte">
        <p id="profile_name"><?php echo $user['prenom']," " ,$user['nom']; ?></p>

        <div class="div_compte">
            <h2>Votre espace restant :</h2>
            <p>Votre espace utilisé : <?php echo $user['espace_total']; ?> k0</p>
            <p>Votre espace autorisé : <?php echo $user['espace_utilise']; ?> k0</p>
            <p>Il vous reste : <?php echo $user['espace_total'] - $user['espace_utilise']; ?> k0</p>
        </div>

        <div class="div_compte">
            <h2>Vos informations</h2>
            <p>Votre nom : <?php echo $user['nom']; ?></p>
            <p>Votre prénom : <?php echo  $user['prenom']; ?></p>
            <p>Votre date de naissance : <?php echo  $user['birth_date']; ?></p>
            <p>Votre e-mail : <?php echo  $user['mail']; ?></p>
            <div style="display:flex;">
                <a href="modif_infos.php" class="btn_modif">Modifier mes informations</a>
                <a href="modif_mdp.php" class="btn_modif">Modifier mon mot de passe</a>
            </div>
        </div>

        <div class="div_compte">
            <h2>Votre abonnement :</h2>
            <div style="display:flex;">
                <img style="width:15%; height:auto;" id="img_abonnement" src="img/8712709_camera_photo_photography_icon.png">
                <div style="width:85%; margin-left:50px;">
                    <p id="abonnement">Motion Pictures free</p>
                    <a class="btn_modif">Changer d'abonnement</a>
                </div>
            </div>
        </div>

        <a href="deconnexion.php" class="btn_supp">Se déconnecter</a>
    </section>
</div>


</body>
</html>
