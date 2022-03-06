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
    <title>Modifiez votre mot de passe</title>
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
    <section style="height:100vh">
        <h1>Modifiez votre mot de passe :</h1>
        <div class="div_compte">
            <form method="POST">
                <h2>Votre mot de passe</h2>
                <span>Ancien mot de passe:</span><br>
                <input type="password" name="old_password" required><br>

                <span>Nouveau mot de passe:</span><br>
                <input type="password" name="password" required><br>

                <span>Confirmer le nouveau mot de passe:</span><br>
                <input type="password" name="confirm_password" required><br>

                <input class="btn_valid" type="submit" name="submitPass" value="Valider" />
            </form>
        </div>

        <a class="btn_return" href="compte.php">Retourner à mon compte</a>
    </section>
</div>


</body>
</html>

<?php
if (isset($_POST['submitPass'])) {
    $req = $Bdd->prepare("SELECT mdp FROM user WHERE mail = :mail");
    $req->execute([
        ':mail' => $_SESSION['mail']
    ]);
    $currentPassword = $req->fetchColumn();
    if ($currentPassword === $_POST['old_password']) {
        if ($_POST['password'] === $_POST['confirm_password']) {
            $request = $Bdd->prepare("UPDATE user SET mdp = :newPassword WHERE mail = :mail");
            $request->execute([
                ':newPassword' => $_POST['password'],
                ':mail' => $_SESSION['mail']
            ]);
        } else {
            echo 'Les mots de passe ne sont pas identiques!';
        }
    } else {
        echo 'Le mot de passe est incorrect...';
    }
    echo 'cest bon';
    //header('Location:compte.php');
}


?>
