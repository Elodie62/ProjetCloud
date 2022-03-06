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
    <title>Modifiez vos informations</title>
    <link rel="stylesheet" href="css/compte.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/modif.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
    <section>

        <h1>Modifiez vos informations :</h1>

        <div class="div_compte">
            <form method="POST">
                <h2>Vos informations</h2>
                <p>Votre nom :</p>
                <input type="text" name="newname" value="<?php echo $user['nom']; ?>">
                <p>Votre prénom : </p>
                <input type="text" name="newfirstname" value="<?php echo  $user['prenom']; ?>">
                <p>Votre date de naissance : </p>
                <input type="date" name="newbirthdate" value="<?php echo  $user['birth_date']; ?>">
                <p>Votre e-mail : </p>
                <input type="text" name="newmail" value="<?php echo  $user['mail']; ?>"><br>
                <input class="btn_valid" type="submit" name="submit" value="Modifier" />
            </form>
        </div>

        <a style="margin-bottom:30px;" class="btn_return" href="compte.php">Retourner à mon compte</a>
    </section>
</div>


</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $req = $Bdd->prepare('UPDATE user SET nom = :newname, prenom = :newfirstname, birth_date = :newbirthdate, mail = :newmail WHERE id = :id');
    $req->execute(array(
        'newname' => htmlspecialchars($_POST['newname']),
        'newfirstname' => htmlspecialchars($_POST['newfirstname']),
        'newbirthdate' => htmlspecialchars($_POST['newbirthdate']),
        'newmail' => htmlspecialchars($_POST['newmail']),
        'id' => $_SESSION['id']
    ));
    header('Location:compte.php');
}




?>
