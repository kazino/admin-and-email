<?php
session_start();
setcookie('remember', NULL, -1);
unset($_SESSION['auth']);
$_SESSION['flash']['warning'] = "Vous êtes maintenant déconnecté";
header('Location: login.php');
