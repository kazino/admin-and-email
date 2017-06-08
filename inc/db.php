<?php
$pdo = new PDO('mysql:dbname=space;host=localhost', 'root','zak');
// attribut PDO : affiche les exceceptions
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// attribut PDO : manière de récupération
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);