<?php
//session_start();
//    if(!isset($_SESSION["admin"])){
//        header("location:../index.php");
//        exit;
//    }
require_once ADMIN_PATH . '/classes/UploadedFile.php';
require_once ADMIN_PATH . '/classes/UploadHandler.php';
$date = date("Y-m-d");
$urlImgArticle = null;
$contenu_article = strip_tags($contenu_article,'<p><a><div>');//balises acceptées
//upload de l'image le cas échéant
if($_FILES["imgFile"]["name"] != "" AND getimagesize($_FILES["imgFile"]["tmp_name"])){
    $uploadedFile = new UploadedFile($_FILES["imgFile"]);
    $uploadHandler = new UploadHandler($uploadedFile);
    if ($uploadHandler->check()) {
        $uploadHandler->upload();
        $urlImgArticle = $uploadHandler->getTargetFileName();
    }
}
//enregistrement de l'article
$pdo = Bdd::getPdo();
$stmt = $pdo->prepare("INSERT INTO article (id_article, titre_article, contenu_article,urlImgArticle, date_article, id_categorie) VALUES (?,?,?,?,?,?)");
$stmt->execute([NULL, $titre_article, $contenu_article,$urlImgArticle, $date, $id_categorie]);
//redirection
header("location:index.php?p=articles");exit();
?>