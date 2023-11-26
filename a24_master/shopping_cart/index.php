<?php
session_start();
// Include functions and connect to the database using PDO MySQL
include 'functions.php';
$pdo = pdo_connect_mysql();
// Page is set to home (home.php) by default, so when the visitor visits, that will be the page they see.
$page = $page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
//AQUI ARRIBA CAMBIE DE "cart" A LO QUE ESTA AHORITA
// Include and show the requested page
include $page . ".php";
?>
