<?php

namespace App\Frontend\Modules\Comments;

use Entity\Comment;
use TheFrameWork\BackController;
use TheFrameWork\HTTPRequest;

class CommentsController extends BackController
{
    public function executeInsert(HTTPRequest $request)
    {
        if ($request->getMethod() == 'POST')
        {
            $comment = new Comment(array(
                'auteur' => $request->getPost('auteur'),
                'contenu' => $request->getPost('contenu'),
                'news' => $request->getQuery('id'),
            ));

            if ($comment->isValid())
            {
                $manager = $this->managers->getManagerOf('Comments');
                $manager->save($comment);

                $this->getApp()->getUser()->setFlash('Le commentaire a été ajouté');
                $this->getApp()->getHttpResponse()->redirect('/news-' . $request->getQuery('id'));
            }

            $this->getPage()->addVar('errors', $comment->getErrors());
        }
    }
}