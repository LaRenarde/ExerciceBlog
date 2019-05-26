<?php
if(!isset($_GET["id"])){//si pas d'id dans l'url, on redirige vers la views des articles
    header('Location:articles.php');
}else{
    require_once '../config/config.php';
    require_once PROJECT_PATH . '/config/configBdd.php';
    require_once PROJECT_PATH . '/site/classes/Bdd.php';
    require_once PROJECT_PATH . '/site/functions/functions.php';
    $id_article = $_GET["id"];
    $article = getArticle($id_article);
    if($article){
        include 'template/_articleView.php';
    }else{
        header('Location:articles.php');
    }
}
?>

