<?php

namespace App\Frontend\Modules\News;

use TheFrameWork\BackController;
use TheFrameWork\HTTPRequest;

class NewsController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        // On récupère le manager des news.
        $manager = $this->managers->getManagerOf('News');

        // On récupère nos 5 dernières news
        $newsList = $manager->getAll(0, 5);

        // On ajoute la variable $news à la vue
        $this->page->addVar('news', $newsList);
    }

    public function executeShow(HTTPRequest $request)
    {
        // On récupère le manager des news.
        $manager = $this->managers->getManagerOf('News');

        // On récupère notre news
        $news = $manager->get($request->getQuery('id'));

        // Si la news n'existe pas, on redirige vers une page 404
        if (empty($news))
        {
            $this->app->getHttpResponse()->redirect404();
        }

        // Chargement des commentaires
        $commentsManager = $this->managers->getManagerOf('Comments');
        $comments = $commentsManager->getAll($news->getId());

        // On ajoute la variable $news à la vue
        $this->page->addVar('news', $news);
        $this->page->addVar('comments', $comments);
    }
}