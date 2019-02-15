<?php
foreach ($news as $actu)
{
    ?>
    <h2><a href="/news-<?php echo $actu['id']; ?>"><?php echo $actu['titre']; ?></a></h2>
    <p><?php
        $contenu = $actu['contenu'];
        if (strlen($contenu) > 200)
        {
            $contenu = substr($contenu, 0, 200);
            $contenu = substr($contenu, 0, strrpos($contenu, ' ')) . '...';
        }
        echo nl2br($contenu);
    ?></p>
    <?php
}