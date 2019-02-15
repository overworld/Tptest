<?php

namespace App\Backend\Modules\Comments;

use Entity\Comment;
use TheFrameWork\BackController;
use TheFrameWork\HTTPRequest;

class CommentsController extends BackController
{
    public function executeEdit(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('Comments');
        $comment = $manager->get($request->getQuery('id'));

        if ($request->getMethod() == 'GET')
        {
            $this->getPage()->addVar('comment', $comment);
        }

        if ($request->getMethod() == 'POST')
        {
            $comment = new Comment(array(
                'id' => $request->getQuery('id'),
                'auteur' => $request->getPost('auteur'),
                'contenu' => $request->getPost('contenu')
            ));

            if ($comment->isValid())
            {
                $manager = $this->managers->getManagerOf('Comments');
                $manager->save($comment);

                $this->getApp()->getUser()->setFlash('Le commentaire a été modifié');
                $this->getApp()->getHttpResponse()->redirect('/admin');
            }

            $this->getPage()->addVar('errors', $comment->getErrors());
        }
    }

    public function executeDelete(HTTPRequest $request)
    {
        $manager = $this->managers->getManagerOf('Comments');
        $comment = $manager->get($request->getQuery('id'));

        if ($request->getMethod() == 'GET')
        {
            $hash = md5($comment->getId());
            $this->getPage()->addVar('hash', $hash);
        }

        if ($request->getMethod() == 'POST')
        {
            if ($request->postExists('hash') && $request->getPost('hash') == md5($comment->getId()))
            {
                $manager->delete($comment);

                $this->getApp()->getUser()->setFlash('Le commentaire a bien été supprimé');
                $this->getApp()->getHttpResponse()->redirect('/admin');
            }
        }
    }
}