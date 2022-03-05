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
    <link rel="stylesheet" href="./css/navbar.css" />
    <script src="https://kit.fontawesome.com/68789f64a4.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E
    <link rel=" preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">

        <?php
        include 'navbar.php'
        ?>
        <section>

            <h1 class="welcome">Bienvenue dans votre espace </h1>
            <img class="accueilConnecte" src="./img/accueilConnecte.png" alt="">
        </section>
    </div>
</body>

</html>