<form action="#" method="post" name="form_article" enctype="multipart/form-data">
    <div class="form-group">
        <label for="titre">Titre</label>
        <input type="text" class="form-control" id="titre_article" name="titre_article" value="<?= $titre_article ?? "" ?>" required>
    </div>
    <div class="form-group">
        <label for="contenu">Texte</label>
        <textarea class="form-control" rows="5" id="editor" name="contenu_article" required><?= $contenu_article ?? "" ?></textarea>
    </div>
    <label>Image</label>
    <div id="custom-file" class="custom-file">
        <input type="file" class="custom-file-input" id="inputCustomFile" name="imgFile" value="<?= $urlImgArticle ?? "" ?>">
        <label class="custom-file-label" for="customFile" id="labelCustomFile"><?= $urlImgArticle ?? "" ?></label>
    </div>
    <div id="divImageFile">
        <?php if(isset($urlImgArticle)) { ?>
            <img src="<?= "../uploads/" . $urlImgArticle ?>" id="imgFile" alt="" width="150px">
            <input type="button" id="deleteImage" value="Supprimer l'image">
        <?php } ?>
    </div>
    <input type="hidden" id="inputUrlImageBdd" name="urlImageBdd" value="<?= $urlImgArticle ?? "" ?>">
    <div class="form-group">
        <label for="select_categorie">Catégorie</label>
        <select class="custom-select" id="select_categorie" name="id_categorie">
<!--            <option value="0"></option>-->
            <?php foreach ($categories as $categorie){
                $catSelected = "";
                if($categorie->id_categorie == $id_categorie){
                    $catSelected = "selected=selected";
                }
            ?>
                <option value="<?= $categorie->id_categorie ?>" <?= $catSelected ?>><?= $categorie->nom_categorie ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>