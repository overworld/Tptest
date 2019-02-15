<h2>Modifier un commentaire</h2>
<form method="post">
    <div class="form-group <?php if (isset($errors) && in_array(\Entity\Comment::AUTEUR_INVALIDE, $errors)) { echo 'has-error'; } ?>">
        <label for="auteur">Auteur :</label>
        <input type="text" class="form-control" name="auteur" value="<?php echo $comment['auteur']; ?>">
        <?php if (isset($errors) && in_array(\Entity\Comment::AUTEUR_INVALIDE, $errors)) { ?>
            <span class="help-block">L'auteur ne peut être vide</span>
        <?php } ?>
    </div>
    <div class="form-group <?php if (isset($errors) && in_array(\Entity\Comment::CONTENU_INVALIDE, $errors)) { echo 'has-error'; } ?>">
        <label for="contenu">Commentaire :</label>
        <textarea name="contenu" class="form-control"><?php echo $comment['contenu']; ?></textarea>
        <?php if (isset($errors) && in_array(\Entity\Comment::CONTENU_INVALIDE, $errors)) { ?>
            <span class="help-block">Le commentaire ne peut être vide</span>
        <?php } ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Modifier le commentaire">
    </div>
</form>