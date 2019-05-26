<?php

require_once '../config/config.php';
require_once '../config/configBdd.php';
require_once 'classes/Bdd.php';
require_once PROJECT_PATH . '/site/functions/functions.php';
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<section>
    <h1>Bienvenue sur mon blog</h1>
    <div>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci at atque distinctio dolorem doloremque dolores dolorum facilis harum hic illo in, libero magnam maxime nihil nisi sed tempore voluptates?
        </p>
        <img src="img/fleurs1.jpg" alt="">
    </div>
</section>
<aside>
    <h2>Derniers articles</h2>

<?php
$articlesRecents = articlesRecents();
foreach($articlesRecents as $article){
include 'template/_article_preview.php';
}
?>
</aside>

