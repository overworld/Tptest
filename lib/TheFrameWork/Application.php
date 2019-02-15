<?php

namespace TheFrameWork;

abstract class Application
{
    protected $httpRequest;
    protected $httpResponse;
    protected $name;
    protected $user;

    public function __construct()
    {
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        $this->name = '';
        $this->user = new User();
    }

    abstract public function run();

    public function getHttpRequest()
    {
        return $this->httpRequest;
    }

    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getController()
    {
        // Nous instanctions notre routeur
        $router = new Router;

        // On ouvre le fichier XML et on en extrait les routes
        $xml = new \DOMDocument;
        $xml->load(__DIR__.'/../../app/'.$this->name.'/config/routes.xml');

        $routes = $xml->getElementsByTagName('route');

        // On parcourt les routes du fichier XML.
        foreach ($routes as $route)
        {
            $vars = [];

            // On regarde si des variables sont présentes dans l'URL.
            if ($route->hasAttribute('vars'))
            {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            // On ajoute la route au routeur.
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
        }

        try
        {
            // On récupère la route correspondante à l'URL.
            $matchedRoute = $router->getRoute($this->httpRequest->getRequestURI());
        }
        catch (\RuntimeException $e)
        {
            if ($e->getCode() == Router::NO_ROUTE_FOUND)
            {
                // Si aucune route ne correspond, c'est que la page demandée n'existe pas.
                // On redirige vers une erreur 404
                $this->httpResponse->redirect404();
            }
        }

        // On ajoute les variables de l'URL au tableau $_GET.
        $_GET = array_merge($_GET, $matchedRoute->vars());

        // On instancie le controleur souhaité à oartir du nom de l'application et du module de la route
        $controllerClass = 'App\\'.$this->name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
    }
}