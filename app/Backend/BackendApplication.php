<?php

namespace App\Backend;

use TheFrameWork\Application;

class BackendApplication extends Application
{
    public function __construct()
    {
        parent::__construct();
        $this->name = 'Backend';
    }

    public function run()
    {
        if ($this->getUser()->isAuthenticated() || $this->httpRequest->getRequestURI() == '/login')
        {
            $controller = $this->getController();
        }
        else
        {
            $this->httpResponse->redirect('/login');
        }

        $controller->execute();

        $this->httpResponse->setPage($controller->getPage());
        $this->httpResponse->send();
    }
}