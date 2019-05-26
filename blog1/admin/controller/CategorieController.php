<?php
require_once ADMIN_PATH . '/vendor/webew/AbstractController.php';
require_once ADMIN_PATH . '/model/CategorieModel.php';

class CategorieController extends AbstractController
{
    public function __construct()
    {
        $this->model = new CategorieModel();
    }

    public function categories(){
        $categories = $this->model->findAll();
        $this->renderView('categorie/categories.php', compact('categories'));
    }

    public function ajoutCategorie(){
        if(!empty($_POST)){
            if($_POST["nom_categorie"] != ""){
                $this->model->save();
                //redirection
                header("location:index.php?p=categories");exit();
            }
        }
        $this->renderView("categorie/ajoutCategorie.php");
    }

    public function editCategorie(){
        $categorie = $this->model->findCategorieById($_GET["id"]);
        if(!empty($_POST)){
            if($_POST["nom_categorie"] != ""){
                $this->model->update($categorie["id_categorie"]);
                //redirection
                header("location:index.php?p=categories");exit();
            }
        }
        $this->renderView("categorie/editCategorie.php", compact('categorie'));
    }

    public function deleteCategorie(){
        if(!isset($_GET["id"])){header("location:index.php?p=categories");exit();}
        $categorie = $this->model->findCategorieById($_GET["id"]);
        //suppression de la catégorie
        if($categorie){
            $this->model->deleteCategorie($categorie);
        }
        //redirection
        header("location:index.php?p=categories");exit();
    }
}