<?php


class CategorieModel
{
    /**
     * @return array
     * retourne toutes les catégories
     */
    public function findAll() : array {
        $pdo = Bdd::getPdo();
        $req = $pdo->query("SELECT * FROM categorie");
        $categories = $req->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    /**
     * @return array
     */
    public function findCategorieById($id_categorie) : array{
        $categorie = null;
        //affichage de la catégorie à modifier
        $pdo = Bdd::getPdo();
        $req = $pdo->prepare("SELECT * FROM categorie WHERE id_categorie=?");
        $req->execute([$id_categorie]);
        $categorie = $req->fetch(PDO::FETCH_ASSOC);
        return $categorie;
    }

    public function save(){
        $this->insertCategorie();
    }

    private function insertCategorie(){
        extract($_POST);
        $nom_categorie = strip_tags($nom_categorie);//aucune balise acceptée
        //enregistrement de la catégorie
        $pdo = Bdd::getPdo();
        $stmt = $pdo->prepare("INSERT INTO categorie (id_categorie, nom_categorie) VALUES (?,?)");
        $stmt->execute([NULL, $nom_categorie]);
    }

    public function update($id_categorie){
        extract($_POST);
        $nom_categorie = strip_tags($nom_categorie);//aucune balise acceptée
        //mise à jour de la catégorie
        $pdo = Bdd::getPdo();
        $stmt = $pdo->prepare("UPDATE categorie SET nom_categorie= :nom_categorie WHERE id_categorie= :id_categorie");
        $stmt->execute([
            "nom_categorie" => $nom_categorie,
            "id_categorie" => $id_categorie
        ]);
    }

    public function deleteCategorie($categorie){
        //suppression de la catégorie
        $pdo = Bdd::getPdo();
        $stmt = $pdo->prepare("DELETE FROM categorie WHERE id_categorie= :id_categorie");
        $stmt->execute([
            "id_categorie" => $categorie["id_categorie"]
        ]);
    }
}