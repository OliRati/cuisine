<?php

session_start();

require("./include/pdo.php");
require("./include/auths.php");
require("./include/plats.php");


// Define default entry page

$allowedPages = [
    "home" => "./views/home.php",
    "register" => "./views/register.php",
    "login" => "./views/login.php",
    "logout" => "./views/logout.php",
    "profil" => "./views/profil.php",
    "plats" => "./views/plats.php",
    "addplats" => "./views/addplats.php",
    "editplats" => "./views/editplats.php",
    "delplats" => "./views/delplats.php"
];

$pageUrl = $allowedPages['home'];

if (isset($_GET["page"]) && !empty($_GET["page"])) {
    $reqPage = trim(htmlspecialchars($_GET["page"]));

    if (key_exists($reqPage, $allowedPages)) {
        $pageUrl = $allowedPages[$reqPage];
    }
}

require($pageUrl);
