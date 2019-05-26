<?php


class UserModel
{
    public function makeUser(){
        $email = "toto@toto.fr";
        $pwd = password_hash("toto");
        $pdo = Bdd::getPdo();
        $stmt = $pdo->prepare("INSERT INTO user (NULL, email_user, pwd_user) VALUES (?,?,?)");
        $stmt->execute([NULL, $email, $pwd]);
    }
}