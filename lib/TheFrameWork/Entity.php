<?php

namespace TheFrameWork;

abstract class Entity implements \ArrayAccess
{
    protected $errors = [];
    protected $id;

    public function __construct(array $data = [])
    {
        if (!empty($data))
        {
            $this->hydrate($data);
        }
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $methode = 'set'.ucfirst($key);

            if (is_callable([$this, $methode]))
            {
                $this->$methode($value);
            }
        }
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function offsetGet($var)
    {
        $method = 'get' . ucfirst($var);
        if ($this->offsetExists($var))
        {
            return $this->$method();
        }
    }

    public function offsetSet($var, $value)
    {
        $method = 'set'.ucfirst($var);

        if (isset($this->$var) && is_callable([$this, $method]))
        {
            $this->$method($value);
        }
    }

    public function offsetExists($var)
    {
        $method = 'get' . ucfirst($var);
        return isset($this->$var) && is_callable([$this, $method]);
    }

    public function offsetUnset($var)
    {
        throw new \Exception('Impossible de supprimer une quelconque valeur');
    }
}