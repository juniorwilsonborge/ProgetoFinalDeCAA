<?php
require_once('../class/conf.php');
require_once('../autoload.php');

$login = new Login();
$login->isAuth($_SESSION['TOKEN']);

echo "<h1>Bem-vindo $login->nome!<br>Email: $login->email";

?>