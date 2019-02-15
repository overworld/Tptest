<?php

namespace App\Backend\Modules\Connexion;

use TheFrameWork\BackController;
use TheFrameWork\HTTPRequest;

class ConnexionController extends BackController
{
    public function executeLogin(HTTPRequest $request)
    {
        if ($request->getMethod() == 'POST')
        {
            $username = $request->getPost('username');
            $password = $request->getPost('password');

            if ($username == 'admin' && $password == 'admin1234')
            {
                $this->getApp()->getUser()->setAuthenticated();
                $this->getApp()->getHttpResponse()->redirect('/admin');
            }

            $this->getApp()->getUser()->setFlash('Le nom d\'utilisateur ou le mot de passe est incorrect');
        }
    }

    public function executeLogout()
    {
        if ($this->getApp()->getUser()->isAuthenticated())
        {
            $this->getApp()->getUser()->setAuthenticated(false);
            $this->getApp()->getUser()->setFlash('Vous avez bien été déconnecté');
        }

        $this->getApp()->getHttpResponse()->redirect('/');
    }
}