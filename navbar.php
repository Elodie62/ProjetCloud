<nav>
    <img class="logo" src="./img/motionPictures.png" alt="logo" />
    <div class="user">
        <i class="fa-solid fa-user"></i>
        <a href="#">Mon compte</a>
    </div>
    <div class="media">
        <i class="fa-solid fa-photo-film"></i>
        <a href="#">Mes médias</a>
    </div>
    <div class="addMedia">
        <i class="fa-solid fa-square-plus"></i>
        <a href="./addMedia.php">Ajoutez des médias</a>
    </div>
    <?php
    if (isset($_SESSION['mail']) && !empty($_SESSION['mail'])) { ?>
        <div class="logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <a href="#">Se déconnecter</a>
        </div>
    <?php
    }
    ?>
</nav>