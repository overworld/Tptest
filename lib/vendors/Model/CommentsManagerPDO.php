<?php

namespace Model;

use Entity\Comment;

class CommentsManagerPDO extends CommentsManager
{
    public function getAll($newsId)
    {
        $sql = 'SELECT * FROM comments WHERE news = :news ORDER BY date DESC';

        $req = $this->dao->prepare($sql);
        $req->bindValue('news', $newsId);
        $req->execute();

        $req->setFetchMode(\PDO::FETCH_CLASS, 'Entity\Comment');
        $comments = $req->fetchAll();

        $req->closeCursor();

        return $comments;
    }

    public function add(Comment $comment)
    {
        $sql = 'INSERT INTO comments(news, auteur, contenu, date) VALUE(:news, :auteur, :contenu, NOW())';

        $req = $this->dao->prepare($sql);
        $req->bindValue('news', $comment->getNews());
        $req->bindValue('auteur', $comment->getAuteur());
        $req->bindValue('contenu', $comment->getContenu());
        $req->execute();

        $comment->setId($this->dao->lastInsertId());
    }

    public function getAllNews()
    {
        $sql = 'SELECT * FROM comments ORDER BY date DESC';

        $req = $this->dao->query($sql);
        $req->setFetchMode(\PDO::FETCH_CLASS, 'Entity\Comment');
        $comments = $req->fetchAll();
        $req->closeCursor();

        return $comments;
    }

    public function edit(Comment $comment)
    {
        $sql = 'UPDATE comments SET auteur = :auteur, contenu = :contenu WHERE id = :id';

        $req = $this->dao->prepare($sql);
        $req->bindValue('id', $comment->getId());
        $req->bindValue('auteur', $comment->getAuteur());
        $req->bindValue('contenu', $comment->getContenu());
        $req->execute();
    }

    public function get($id)
    {
        $sql = 'SELECT * FROM comments WHERE id = :id';

        $req = $this->dao->prepare($sql);
        $req->bindValue('id', $id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS, 'Entity\Comment');

        if ($comment = $req->fetch())
        {
            return $comment;
        }

        return null;
    }

    public function delete(Comment $comment)
    {
        $sql = 'DELETE FROM comments WHERE id = ' . $comment->getId();
        $req = $this->dao->query($sql);
    }
}