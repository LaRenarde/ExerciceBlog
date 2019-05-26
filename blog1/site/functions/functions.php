<?php
/**
 * @param $id
 * @return mixed
 */
function getArticle($id){
    $pdo = Bdd::getPdo();
    $req = $pdo->prepare("SELECT * FROM article WHERE id_article=?");//prepare impératif !!!!
    $req->execute([$id]);
    $article = $req->fetchObject();
    return $article;

}

/**
 * @return array
 */
function getArticles(){
    $pdo = Bdd::getPdo();
    $req = $pdo->query("SELECT * FROM article JOIN categorie c ON article.id_categorie = c.id_categorie ORDER BY date_article DESC");//ici on peut utiliser query car il n'y a pas de données externes dans la requête
    $articles = $req->fetchAll(PDO::FETCH_OBJ);
    return $articles;
}

/**
 * @param $str
 * @return array
 */
function searchArticle($str){
    $pdo = Bdd::getPdo();
    $search = "%$str%";
    $req = $pdo->prepare("SELECT * FROM article WHERE titre_article LIKE ?");//prepare impératif !!!!
    $req->execute([$search]);
    $articles = $req->fetchAll(PDO::FETCH_OBJ);
    return $articles;
}

function filtreCategorie($value){
    $pdo = Bdd::getPdo();
    $req = $pdo->prepare("SELECT * FROM article WHERE id_categorie=?");//prepare impératif !!!!
    $req->execute([$value]);
    $articles = $req->fetchAll(PDO::FETCH_OBJ);
    return $articles;
}

function articlesRecents(){
    $pdo = Bdd::getPdo();
    $req = $pdo->prepare("SELECT * FROM article Join categorie ON article.id_categorie = categorie.id_categorie ORDER BY id_article DESC LIMIT 3");
    $req->execute();
    $articles = $req->fetchAll(PDO::FETCH_OBJ);
    return $articles;
}
