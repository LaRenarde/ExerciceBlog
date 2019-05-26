<?php
require_once ADMIN_PATH . '/classes/UploadedFile.php';
require_once ADMIN_PATH . '/classes/UploadHandler.php';

class ArticleModel
{
    public function save(){
        $urlImgArticle = $this->uploadImage();
        $this->insertArticle($urlImgArticle);
    }

    public function findAll(){
        $pdo = Bdd::getPdo();
        $req = $pdo->query("SELECT * FROM article JOIN categorie c ON article.id_categorie = c.id_categorie ORDER BY date_article DESC");
        $articles = $req->fetchAll(PDO::FETCH_OBJ);
        return $articles;
    }

    public function findArticleById(){
        $article = null;
        //affichage de l'article à modifier
        if(isset($_GET["id"])){
            $id_article = $_GET["id"];
            $pdo = Bdd::getPdo();
            $req = $pdo->prepare("SELECT * FROM article WHERE id_article=?");
            $req->execute([$id_article]);
            $article = $req->fetch(PDO::FETCH_ASSOC);
        }
        return $article;
    }

    public function update($article){
        extract($article);
//        var_dump($article);
        $urlNewImgArticle = $urlImgArticle ?? null;
//        var_dump($_POST);
//        var_dump($_FILES);
        if($_FILES["imgFile"]["name"] != "" OR $_POST["urlImageBdd"] == ""){
            $this->deleteImage($urlImgArticle);
            $urlNewImgArticle = null;
            if($_FILES["imgFile"]["name"] != ""){
                $urlNewImgArticle = $this->uploadImage();
            }
        }
        $this->updateArticle($urlNewImgArticle);
    }

    private function deleteImage($urlImgArticle){
        //suppression de l'image
        if($urlImgArticle != null AND file_exists(UPLOADS_PATH . $urlImgArticle)){
            unlink(UPLOADS_PATH . $urlImgArticle);
        }
    }

    private function uploadImage(){
        $urlNewImgArticle = null;
        //upload de l'image le cas échéant
        if( $_FILES["imgFile"]["name"] != "" /*AND getimagesize($_FILES["imgFile"]["tmp_name"])*/){
            $uploadedFile = new UploadedFile($_FILES["imgFile"]);
            $uploadHandler = new UploadHandler($uploadedFile);
            if ($uploadHandler->check()) {
                $uploadHandler->upload();
                $urlNewImgArticle = $uploadHandler->getTargetFileName();
            }
        }
        return $urlNewImgArticle;
    }

    private function insertArticle($urlImgArticle){
        extract($_POST);
        $date = date("Y-m-d");
        $contenu_article = strip_tags($contenu_article,'<p><a><div>');//balises acceptées
        //enregistrement de l'article
        $pdo = Bdd::getPdo();
        $stmt = $pdo->prepare("INSERT INTO article (id_article, titre_article, contenu_article,urlImgArticle, date_article, id_categorie) VALUES (?,?,?,?,?,?)");
        $stmt->execute([NULL, $titre_article, $contenu_article,$urlImgArticle, $date, $id_categorie]);
    }

    private function updateArticle($urlImgArticle){
        extract($_POST);
        $date = date("Y-m-d");
        $contenu_article = strip_tags($contenu_article,'<p><a><div>');//balises acceptées
        //mise à jour de l'article
        $pdo = Bdd::getPdo();
        $stmt = $pdo->prepare("UPDATE article SET titre_article= :titre_article, contenu_article= :contenu_article,urlImgArticle= :urlImgArticle, date_article= :date_article, id_categorie= :id_categorie WHERE id_article= :id_article");
        $stmt->execute([
            "titre_article" => $titre_article,
            "contenu_article" => $contenu_article,
            "urlImgArticle" => $urlImgArticle,
            "date_article" => $date,
            "id_categorie" => $id_categorie,
            "id_article" => $_GET["id"]
        ]);
    }

    public function deleteArticle($article){
        //suppression de l'image
        unlink(UPLOADS_PATH . $article["urlImgArticle"]);
        //suppression de l'article
        $pdo = Bdd::getPdo();
        $stmt = $pdo->prepare("DELETE FROM article WHERE id_article= :id_article");
        $stmt->execute([
            "id_article" => $article["id_article"]
        ]);
    }
}