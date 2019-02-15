<?php

namespace TheFrameWork;

class Router
{
    private $routes = [];

    const NO_ROUTE_FOUND = 1;

    public function addRoute(Route $route)
    {
        if (!in_array($route, $this->routes))
        {
            $this->routes[] = $route;
        }
    }

    public function getRoute($url)
    {
        // On parcours toutes les routes du routeur
        foreach ($this->routes as $route)
        {
            // Si la route correspond à l'URL, on assigne la liste des variables a $varsValues
            if (($varsValues = $route->match($url)) !== false)
            {
                // Si elle a des variables
                if ($route->hasVars())
                {
                    $varsNames = $route->varsNames();
                    $listVars = [];

                    // On crée un nouveau tableau clé/valeur
                    // (clé = nom de la variable, valeur = sa valeur)
                    foreach ($varsValues as $key => $match)
                    {
                        // La première valeur contient entièrement la chaine capturée (voir la doc sur preg_match)
                        if ($key !== 0)
                        {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }

                    // On assigne ce tableau de variables � la route
                    $route->setVars($listVars);
                }

                return $route;
            }
        }

        throw new \RuntimeException('Aucune route ne correspond à l\'URL suivante : ' . $url, self::NO_ROUTE_FOUND);
    }
}