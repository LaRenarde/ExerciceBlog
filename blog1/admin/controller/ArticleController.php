<?php
require_once ADMIN_PATH . '/vendor/webew/AbstractController.php';
require_once ADMIN_PATH . '/model/ArticleModel.php';
require_once ADMIN_PATH . '/model/CategorieModel.php';

class ArticleController extends AbstractController
{
    public function __construct()
    {
        $this->model = new ArticleModel();
    }

    public function articles(){
        $articles = $this->model->findAll();
        $this->renderView('article/articles.php', compact('articles'));
    }

    public function ajoutArticle(){
        if(!empty($_POST)){
            if($_POST["titre_article"] != "" AND $_POST["contenu_article"] != "" AND $_POST["id_categorie"] != "0"){
                $this->model->save();
                //redirection
                header("location:index.php?p=articles");exit();
            }
        }
        $categoriesModel = new CategorieModel();
        $categories = $categoriesModel->findAll();
        $this->renderView("article/ajoutArticle.php", compact('categories'));
    }

    public function editArticle(){
        $article = $this->model->findArticleById($_GET["id"]);
        if(!empty($_POST)){
            if($_POST["titre_article"] != "" AND $_POST["contenu_article"] != "" AND $_POST["id_categorie"] != "0"){
                if($article){
                    $this->model->update($article);
                }
                //redirection
                header("location:index.php?p=articles");exit();
            }
        }
        $categoriesModel = new CategorieModel();
        $categories = $categoriesModel->findAll();
        $this->renderView("article/editArticle.php", compact('article','categories'));
    }

    public function deleteArticle(){
        if(!isset($_GET["id"])){header("location:index.php?p=articles");exit();}
        $article = $this->model->findArticleById($_GET["id"]);
        //suppression de l'article et de l'image
        if($article){
            $this->model->deleteArticle($article);
        }
        //redirection
        header("location:index.php?p=articles");exit();
    }
}