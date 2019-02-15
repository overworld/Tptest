<?php

namespace TheFrameWork;

class HTTPRequest extends ApplicationComponent
{
    public function getCookie($key)
    {
        return $this->cookieExists($key) ? $_COOKIE[$key] : null;
    }

    public function cookieExists($key)
    {
        return isset($_COOKIE[$key]);
    }

    public function getQuery($key)
    {
        return $this->queryExists($key) ? $_GET[$key] : null;
    }

    public function queryExists($key)
    {
        return isset($_GET[$key]);
    }

    public function getPost($key)
    {
        return $this->postExists($key) ? $_POST[$key] : null;
    }

    public function postExists($key)
    {
        return isset($_POST[$key]);
    }

    public function getRequestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
