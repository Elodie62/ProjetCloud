<?php
session_start();
include("bdd.php");
$Bdd = getPDO();
$userReq = $Bdd->prepare("SELECT * FROM user WHERE mail = :mail");
$PhotoReq = $Bdd->prepare("SELECT * FROM photo INNER JOIN `user-photo` ON photo.id = `user-photo`.`idPhoto` INNER JOIN user ON :id = `user-photo`.`idUser`;");
$userReq->execute([
    ':mail' => $_SESSION['mail']
]);
$PhotoReq->execute([
    ':id' => $_SESSION['id']
]);
$user = $userReq->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Votre galery</title>
    <link rel="stylesheet" href="css/galery.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/68789f64a4.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <?php
    include 'navbar.php'
    ?>
    <section style="height:100vh">
        <h1>Votre galery</h1>
        <div class="tags">
            <button class="tag" style="background-color: lightblue">Famille</button>
            <button class="tag" style="background-color: lightpink">Amis</button>
            <button class="tag" style="background-color: lightgreen">Vacances</button>
            <button class="tag" style="background-color: lightsalmon">Loisirs</button>
        </div>

        <?php
            $ORes = $PhotoReq->fetchAll();
            
            ?>
            <div class="galery_photo">
            <?php
            foreach($ORes as $res){
                if($res->id == $user['id']){
                     ?>
                    <img src="<?php echo $res->lien?>" alt="">';
                    <?php
                }
               
            }
            ?>
            </div>
            <?php


        ?>

    </section>
</div>


</body>
</html>
