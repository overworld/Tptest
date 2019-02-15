<?php

namespace Model;

use Entity\News;

class NewsManagerPDO extends NewsManager
{
    public function getAll($offset = -1, $limit = -1)
    {
        $sql = 'SELECT * FROM news ORDER BY id DESC';

        if ($limit != -1)
        {
            $sql .= ' LIMIT ' . $limit;
        }

        if ($offset != -1)
        {
            $sql .= ' OFFSET ' . $offset;
        }

        $req = $this->dao->query($sql);
        $req->setFetchMode(\PDO::FETCH_CLASS, 'Entity\News');

        $news = $req->fetchAll();

        $req->closeCursor();

        return $news;
    }

    public function get($id)
    {
        $sql = 'SELECT * FROM news WHERE id = :id';

        $req = $this->dao->prepare($sql);
        $req->bindValue('id', $id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS, 'Entity\News');

        if ($news = $req->fetch())
        {
            return $news;
        }

        return null;
    }

    public function add(News $news)
    {
        $sql = 'INSERT INTO news(auteur, titre, contenu, dateAjout, dateModif) VALUE(:auteur, :titre, :contenu, :dateAjout, :dateModif)';

        $req = $this->dao->prepare($sql);
        $req->bindValue('auteur', $news->getAuteur());
        $req->bindValue('titre', $news->getTitre());
        $req->bindValue('contenu', $news->getContenu());
        $req->bindValue('dateAjout', $news->getDateAjout()->format('Y/m/d H:i:s'));
        $req->bindValue('dateModif', $news->getDateModif()->format('Y/m/d H:i:s'));
        $req->execute();

        $news->setId($this->dao->lastInsertId());
    }

    public function edit(News $news)
    {
        $sql = 'UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() WHERE id = :id';

        $req = $this->dao->prepare($sql);
        $req->bindValue('auteur', $news->getAuteur());
        $req->bindValue('titre', $news->getTitre());
        $req->bindValue('contenu', $news->getContenu());
        $req->bindValue('id', $news->getId());
        $req->execute();
    }

    public function delete(News $news)
    {
        $sql = 'DELETE FROM news WHERE id = ' . $news->getId();
        $req = $this->dao->query($sql);
    }
}