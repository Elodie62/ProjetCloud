<?php
session_start();

if (isset($_SESSION['mail']) && !empty($_SESSION['mail'])) {
    include 'accueilConnecte.php';
} else {
    include 'accueilNonConnecte.php';
}
