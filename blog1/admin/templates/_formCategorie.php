<form action="#" method="post" name="form_categorie" >
    <div class="form-group">
        <label for="titre">Nom</label>
        <input type="text" class="form-control" id="nom_categorie" name="nom_categorie" value="<?= $nom_categorie ?? "" ?>">
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
