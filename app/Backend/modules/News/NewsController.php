<?php

namespace App\Backend\Modules\News;

use Entity\News;
use TheFrameWork\BackController;
use TheFrameWork\HTTPRequest;

class NewsController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('News');
        $news = $manager->getAll();

        $manager = $this->managers->getManagerOf('Comments');
        $comments = $manager->getAllNews();

        $this->getPage()->addVar('news', $news);
        $this->getPage()->addVar('comments', $comments);
    }

    public function executeAdd(HTTPRequest $request)
{
    if ($request->getMethod() == 'POST')
    {
        $this->handleNews($request);
    }
}

    public function executeEdit(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('News');
        $news = $manager->get($request->getQuery('id'));

        if ($request->getMethod() == 'GET')
        {
            $this->getPage()->addVar('news', $news);
        }

        if ($request->getMethod() == 'POST')
        {
            $this->handleNews($request);
        }
    }

    private function handleNews(HTTPRequest $request)
    {
        $news = new News([
            'auteur' => $request->getPost('auteur'),
            'titre' => $request->getPost('titre'),
            'contenu' => $request->getPost('contenu'),
        ]);

        if ($request->queryExists('id'))
        {
            $news->setId($request->getQuery('id'));
        }

        $flash = 'La news a bien été ';
        $news->isNew() ? $flash .= 'ajoutée' : $flash .= 'modifiée';
        $this->getApp()->getUser()->setFlash($flash);

        $manager = $this->managers->getManagerOf('News');
        $manager->save($news);

        $this->getApp()->getHttpResponse()->redirect('/admin');
    }

    public function executeDelete(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('News');
        $news = $manager->get($request->getQuery('id'));

        if ($request->getMethod() == 'GET')
        {
            $hash = md5($news->getTitre());
            $this->getPage()->addVar('hash', $hash);
        }

        if ($request->getMethod() == 'POST')
        {
            if ($request->postExists('hash') && $request->getPost('hash') == md5($news->getTitre()))
            {
                $manager->delete($news);

                $this->getApp()->getUser()->setFlash('La news a bien été supprimée');
                $this->getApp()->getHttpResponse()->redirect('/admin');
            }
        }
    }
}