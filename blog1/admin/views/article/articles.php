<h1>Articles</h1>
<a href="index.php?p=ajoutArticle"><i class="fas fa-plus-square"></i></a>
<hr>

<section>
    <table class="table">
        <tr><th>id</th><th>Titre</th><th>Contenu</th><th>Image</th><th>Date</th><th>Catégorie</th><th></th><th></th></tr>
        <?php foreach ($articles as $article) : ?>
            <tr>
                <td><?= $article->id_article ?></td>
                <td><?= $article->titre_article ?></td>
                <td><?= $article->contenu_article ?></td>
                <td>
                    <?php if(isset($article->urlImgArticle)) : ?>
                        <img src="<?= "../uploads/" . $article->urlImgArticle ?>" alt="" width="150px">
                    <?php endif; ?>
                </td>
                <td><?= date('d/m/Y',strtotime($article->date_article)) ?></td>
                <td><?= $article->nom_categorie ?></td>
                <td><a href="index.php?p=editArticle&id=<?= $article->id_article ?>"><i class="fas fa-edit"></i></a></td>
                <td><a href="index.php?p=deleteArticle&id=<?= $article->id_article ?>"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>