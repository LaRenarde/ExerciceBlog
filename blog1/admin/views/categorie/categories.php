<h1>Catégories</h1>
<a href="index.php?p=ajoutCategorie"><i class="fas fa-plus-square"></i></a>
<hr>

<section>
    <table class="table">
        <tr><th>id</th><th>Nom</th><th></th><th></th></tr>
        <?php foreach ($categories as $categorie) : ?>
            <tr>
                <td><?= $categorie->id_categorie ?></td>
                <td><?= $categorie->nom_categorie ?></td>
                <td><a href="index.php?p=editCategorie&id=<?= $categorie->id_categorie ?>"><i class="fas fa-edit"></i></a></td>
                <td><a href="index.php?p=deleteCategorie&id=<?= $categorie->id_categorie ?>"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>