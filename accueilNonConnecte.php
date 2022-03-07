<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accueil</title>
    <link rel="stylesheet" href="./css/styleAccueil.css" />

    <script src="https://kit.fontawesome.com/68789f64a4.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E
    <link rel=" preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <img class="logo" src="./img/motionPictures.png" alt="logo" />
        <a style="background-color: white; padding:10px; margin:20px; text-decoration: none; border-radius: 5px;" href="connexion.php">Connexion</a>
    </nav>
    <div class="flex">

        <h1>Découvrez MotionPictures !</h1>
        <p>Motion pictures vous permet un stockage de vos médias en toute simplicité ! Découvrez nos offres en vous inscrivant.</p>
        <button class="suscribe">Je m'inscris </button>
        <img src="./img/accueilNonConnecte.png" alt="">
    </div>

</body>

</html>