<?php

session_start();

require("./include/pdo.php");
require("./include/auths.php");
require("./include/plats.php");


// Define default entry page
$page = "home";

if (isset($_GET["page"]) && !empty($_GET["page"])) {
    $reqPage = trim(htmlspecialchars($_GET["page"]));

    $allowedPages = ['home', 'register', 'login', 'logout', "profil",
                     "plats", "addplats", "editplats", "delplats" ];
    if (in_array($reqPage, $allowedPages)) {
        $page = $reqPage;
    }
}

if ($page === "home") {
    require("./views/home.php");
} elseif ($page === "register") {
    require("./views/register.php");
} elseif ($page === "login") {
    require("./views/login.php");
} elseif ($page === "logout") {
    require("./views/logout.php");
} elseif ($page === "profil") {
    require("./views/profil.php");
} elseif ($page === "plats") {
    require("./views/plats.php");
} elseif ($page === "addplats") {
    require("./views/addplats.php");
} elseif ($page === "editplats") {
    require("./views/editplats.php");
} elseif ($page === "delplats") {
    require("./views/delplats.php");
}
