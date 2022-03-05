<?php
session_start();
include 'include/database.php';

$database = getPDO();

$allowedExtensions = array('.jpg', '.jpeg', '.gif', '.png', '.mp4', '.avi', '.mov');
$maxSize = 5242880;
$addFile = $_FILES['add'];


if (isset($_POST['submit'])) {

    if (isset($addFile)) {
        try {
            if ($addFile['size'] > $maxSize) {
                throw new Exception("Votre fichier ne doit pas dépasser 5MB");
            }

            $uploadExtension = strtolower(strchr($addFile['name'], "."));
            $isValidExtension = in_array($uploadExtension, $allowedExtensions);
            if (!$isValidExtension) {
                throw new Exception("Votre photo de profil doit être en jpg, jpeg, gif ou png");
            }

            $chemin = "./media/" . basename($addFile['name']);

            $result = move_uploaded_file($addFile['tmp_name'], $chemin);

            if (!$result) {
                throw new Exception("Erreur lors de l'importation de votre photo");
            }

            $insertFile = $database->prepare('INSERT INTO addMedia (fichier)
VALUES (:addFile)');
            $insertFile->execute(array('addFile' => $chemin));
            //header('Location: addMedia.php');




        } catch (Exception $err) {
            echo ($err);
        }
    }

    // $req = $database->prepare('UPDATE users SET mail = :newmail, adresse = :newaddress, codePostal= :newpostcode, ville= :newcity, tel= :newphonenumber  WHERE id = :id');
    // $req->execute(array(
    //   'newmail' => htmlspecialchars($_POST['newmail']),
    //   'newaddress' => htmlspecialchars($_POST['newaddress']),
    //   'newpostcode' => htmlspecialchars($_POST['newpostcode']),
    //   'newcity' => htmlspecialchars($_POST['newcity']),
    //   'newphonenumber' => htmlspecialchars($_POST['newphonenumber']),
    //   'id' => $_SESSION['id']
    // ));
}
