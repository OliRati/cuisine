<header>
    <div class="navbar">
        <?php if (isLoggedIn()) { ?>
            <div><?= $_SESSION["name"] ?></div>
            <div><a href="?page=logout">Logout</a></div>
            <div><a href="?page=plats">Mes plats</a></div>
            <div><a href="?page=profil">Mon profil</a></div>
        <?php } else { ?>
            <div><a href="?page=register">Register</a></div>
            <div><a href="?page=login">Login</a></div>
        <?php } ?>
    </div>
</header>