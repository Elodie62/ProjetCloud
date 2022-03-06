<?php
session_start();
include 'bdd.php';

$database = getPDO();

$allowedExtensions = array('.jpg', '.jpeg', '.gif', '.png', '.mp4', '.avi', '.mov');
$maxSize = 5242880;
$addFile = $_FILES['addMedia'];
$photoDate = strtotime($_POST['photoDate']);
$photoName = $_POST['photoName'];
$tags = $_POST['tags'];

error_log(implode($tags));

if (isset($_POST['submit'])) {

    if (isset($addFile)) {
        try {
            if ($addFile['size'] > $maxSize) {
                error_log("Votre fichier ne doit pas dépasser 5MB");
                throw new Exception("Votre fichier ne doit pas dépasser 5MB");
            }

            $uploadExtension = strtolower(strchr($addFile['name'], "."));
            $isValidExtension = in_array($uploadExtension, $allowedExtensions);
            if (!$isValidExtension) {
                error_log("Votre photo de profil doit être en jpg, jpeg, gif ou png");
                throw new Exception("Votre photo de profil doit être en jpg, jpeg, gif ou png");
            }

            $chemin = "./media/" . basename($addFile['name']);

            $result = move_uploaded_file($addFile['tmp_name'], $chemin);

            if (!$result) {
                error_log("Erreur lors de l'importation de votre photo");
                throw new Exception("Erreur lors de l'importation de votre photo");
            }

            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $insertFile = $database->prepare('INSERT INTO photo(nom, lien, date) VALUES (:name, :addFile, :date)');

            $insertFile->execute(array(
                'addFile' => $chemin,
                'name' => $photoName,
                'date' => date("Y-m-d H:i:s", $photoDate)
            ));

            $fileId = $database->lastInsertId();
            $tagInsertStatement = $database->prepare('INSERT INTO `photo-tag`(idPhoto, idTags) VALUES (:idPhoto, :idTag)');

            foreach ($tags as $tag) {
                // echo ($tag);
                // $a = $database->prepare('SELECT tag FROM tags WHERE id = 1');
                // echo ($a);
                // $tagInsertStatement = $database->prepare('INSERT INTO `photo-tag` VALUES (:idPhoto, :idTags)');
                $tagInsertStatement->execute(array(
                    'idPhoto' => $fileId,
                    'idTag' => $tag,
                ));
                echo ("out");
            }

            $currentSizeUpdateStatement = $database->prepare('UPDATE `user` SET espace_restant = espace_restant + :fileSize WHERE id = :userId');

            $currentSizeUpdateStatement->execute(array(
                'fileSize' => $_SESSION['id'],
                'userId' => $addFile['size'],
            ));

            //header('Location: addMedia.php');
        } catch (Exception $err) {
            error_log($err->getMessage());
        }
    }
}
