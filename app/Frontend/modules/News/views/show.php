<p>Par <em><?= $news['auteur'] ?></em>, le <?= $news['dateAjout']->format('d/m/Y à H\hi') ?></p>
<h2><?= $news['titre'] ?></h2>
<p><?= nl2br($news['contenu']) ?></p>

<?php if ($news['dateAjout'] != $news['dateModif']) { ?>
    <p style="text-align: right;"><small><em>Modifiée le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>

<p><b>Liste des commentaires :</b></p>
<? foreach ($comments as $comment)
    {
        echo '<p>Par ' . $comment['auteur'] . ' le ' . $comment['date']->format('d/m/Y à H:i:s') . '</p>';
        echo '<p>' . nl2br($comment['contenu']) . '</p>';
    }
?>
<a href="/news-<?php echo $news['id']; ?>/ajouter-un-commentaire"><button class="btn btn-primary">Ajouter un commentaire</button></a>
