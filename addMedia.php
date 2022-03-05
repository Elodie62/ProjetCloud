<?php
session_start();
include 'include/database.php';
$database = getPDO();

$allowedExtensions = array('.jpg', '.jpeg', '.gif', '.png', '.mp4', '.avi', '.mov');

// $userReq = $database->prepare("SELECT * FROM users WHERE mail = :mail");
// $userReq->execute([
//   ':mail' => $_SESSION['mail']
// ]);
//$user = $userReq->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ajout de média</title>
  <link rel="stylesheet" href="./css/style.css" />
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
      <h1>Ajoutez des médias</h1>
      <form action="./file.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="add" id="add" accept="<?= implode(',', $allowedExtensions) ?>" />
        <input class="btn" type="submit" name="submit" value="Valider" />
      </form>

      <article>
        <label for="addMedia">
          <p>Glissez/déposez votre média</p>
          <img src="./img/dragAndDrop.jpg" alt="" />
          <!-- <i class="fa-solid fa-folder-plus"></i> -->
          <input type="file" name="addMedia" id="addMedia" />
        </label>
      </article>
    </section>
  </div>
</body>

</html>