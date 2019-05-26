<?php
require_once ADMIN_PATH . '/vendor/webew/AbstractController.php';

class MainController extends AbstractController
{
    public function index(){
        $this->renderView("accueil.php");
    }

    public function connexion(){
        $this->renderView("connexion/connexion.php");
    }

    public function login(){
        $pdo = Bdd::getPdo();
        $req = $pdo->prepare("SELECT * FROM user WHERE email_user=?");
        $req->execute([$_POST["email"]]);
        $user = $req->fetchObject();
        if($user){
            if(password_verify($_POST["mdp"], $user->pwd_user)){
                $_SESSION["user"]["id"] = $user->id_user;
                $_SESSION["user"]["email"] = $user->email_user;
            }
        }
        header("location:index.php");
    }

    public function deconnexion(){
        session_destroy();
        header("location:index.php");
    }

}