<?php
session_start();
include 'bdd.php';
$database = getPDO();

$allowedExtensions = array('.jpg', '.jpeg', '.gif', '.png', '.mp4', '.avi', '.mov');

$tag = $database->query("SELECT * FROM tags");
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

        <label class="labelAdd" for="addMedia">
          <p>Glissez/déposez votre média</p>
          <img src="./img/dragAndDrop.jpg" alt="" />

          <input type="file" name="addMedia" id="addMedia" accept="<?= implode(',', $allowedExtensions) ?>" />
        </label>
        <div class="hidden formPart2">
          <label for="photoName">Nom</label>
          <input type="text" name="photoName" id="photoName">
          <input type="date" name="photoDate" id="photoDate">
          <h2>Tag</h2>
          <select multiple name="tags[]">
            <?php
            $results = $tag->fetchAll();
            foreach ($results as $result) {
            ?>
              <option value="<?= $result->tag ?>"><?= $result->tag ?></option>
            <?php
            }
            ?>
          </select>
          <input class="btn" type="submit" name="submit" id="submit" value="Valider" />
        </div>
      </form>

    </section>
  </div>
  <script src="./script.js"></script>
</body>

</html>