<form method="post">
    <div class="form-group">
        <label for="auteur">Auteur :</label>
        <input type="text" class="form-control" name="auteur" value="<?php if (isset($news)) { echo $news['auteur']; } ?>">
    </div>
    <div class="form-group">
        <label for="auteur">Titre :</label>
        <input type="text" class="form-control" name="titre" value="<?php if (isset($news)) { echo $news['titre']; } ?>">
    </div>
    <div class="form-group">
        <label for="auteur">Contenu :</label>
        <textarea class="form-control" name="contenu"><?php if (isset($news)) { echo $news['contenu']; } ?></textarea>
    </div>
    <input type="submit" class="btn btn-primary" value="Enregistrer">
</form>