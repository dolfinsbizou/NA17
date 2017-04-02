<?php

$username = $_SERVER['PHP_AUTH_USER'];
echo '<pre>';
print_r($_SERVER);
echo '</pre>';
$page_title = "Accueil";
require_once("view/index.php");
