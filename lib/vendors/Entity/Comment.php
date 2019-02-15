<?php

namespace Entity;

use TheFrameWork\Entity;

class Comment extends Entity
{
    protected $news;
    protected $auteur;
    protected $contenu;
    protected $date;

    const AUTEUR_INVALIDE = 0;
    const CONTENU_INVALIDE = 1;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (!$this->isNew())
        {
            $this->date = new \DateTime($this->date);
        }
    }

    public function getNews()
    {
        return $this->news;
    }

    public function setNews($news)
    {
        $this->news = $news;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function setAuteur($auteur)
    {
        if (!is_string($auteur) || empty($auteur))
        {
            $this->errors[] = self::AUTEUR_INVALIDE;
        }

        $this->auteur = $auteur;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        if (!is_string($contenu) || empty($contenu))
        {
            $this->errors[] = self::CONTENU_INVALIDE;
        }

        $this->contenu = $contenu;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function isValid()
    {
        return !(empty($this->auteur) || empty($this->contenu));
    }
}