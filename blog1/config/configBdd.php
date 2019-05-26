<?php
//variables globales de la Bdd
$conn = new PDO ("mysql:host=localhost;dbname=base2;charset=utf8;port=3306", "root","");

$req = $conn->prepare("SELECT * FROM article Join categorie ON article.id_categorie = categorie.id_categorie");
$req->execute();
$articles = $req->fetchAll(PDO::FETCH_OBJ);

$req2 = $conn->prepare("SELECT * FROM categorie");
$req2->execute();
$categories = $req2->fetchAll(PDO::FETCH_OBJ);


define('HOST', 'localhost');
define('DB', 'base2');
define('PORT', '3306');
define('ID', 'root');
define('PWD', '');
