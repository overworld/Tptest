<h2>Liste des news</h2>
<p>Il y a actuellement <?php echo count($news); ?> news en base de données</p>
<table class="table">
    <thead>
    <tr>
        <th>Date</th>
        <th>Auteur</th>
        <th>Titre</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($news as $actu) { ?>
        <tr>
            <td><?php echo $actu['dateAjout']->format('d/m/Y à H:i:s'); ?></td>
            <td><?php echo $actu['auteur']; ?></td>
            <td><?php echo $actu['titre']; ?></td>
            <td><a href="/admin/news-<?php echo $actu['id']; ?>/modifier">Modifier</a></td>
            <td><a href="/admin/news-<?php echo $actu['id']; ?>/supprimer">Supprimer</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<h2>Liste des commentaires</h2>
<p>Il y a actuellement <?php echo count($comments); ?> commentaires en base de données</p>
<table class="table">
    <thead>
    <tr>
        <th>Date</th>
        <th>Auteur</th>
        <th>Contenu</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($comments as $comment) { ?>
        <tr>
            <td><?php echo $comment['date']->format('d/m/Y à H:i:s'); ?></td>
            <td><?php echo $comment['auteur']; ?></td>
            <td><?php echo $comment['contenu']; ?></td>
            <td><a href="/admin/commentaire-<?php echo $comment['id']; ?>/modifier">Modifier</a></td>
            <td><a href="/admin/commentaire-<?php echo $comment['id']; ?>/supprimer">Supprimer</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>