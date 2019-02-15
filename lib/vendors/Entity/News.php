<?php

namespace Entity;

use TheFrameWork\Entity;

class News extends Entity
{
    protected $auteur;
    protected $titre;
    protected $contenu;
    protected $dateAjout;
    protected $dateModif;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if ($this->isNew())
        {
            $this->dateAjout = new \DateTime();
            $this->dateModif = new \DateTime();
        }
        else
        {
            $this->dateAjout = new \DateTime($this->dateAjout);
            $this->dateModif = new \DateTime($this->dateModif);
        }
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function setAuteur($auteur)
    {
        if (!is_string($auteur) || empty($auteur))
        {
            $this->errors[] = 'Auteur invalide';
        }

        $this->auteur = $auteur;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        if (!is_string($titre) || empty($titre))
        {
            $this->errors[] = 'Titre invalide';
        }

        $this->titre = $titre;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        if (!is_string($contenu) || empty($contenu))
        {
            $this->errors[] = 'Contenu invalide';
        }

        $this->contenu = $contenu;
    }

    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    public function getDateModif()
    {
        return $this->dateModif;
    }

    public function setDateModif(\DateTime $dateModif)
    {
        $this->dateModif = $dateModif;
    }
}