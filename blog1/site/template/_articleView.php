<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <?php include 'template/_nav.php' ?>
    </header>
    <hr>
    <h1><?= $article->titre_article ?></h1>
    <img class ="articleImg" src="../uploads/<?= $article->urlImgArticle ?>"/>
    <p>Date de dernière modification : <?= date('d/m/Y',strtotime($article->date_article)) ?></p>
    <p><?= $article->contenu_article ?></p>
</body>
</html>
