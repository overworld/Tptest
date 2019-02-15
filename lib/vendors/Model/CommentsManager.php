<?php

namespace Model;

use Entity\Comment;
use TheFrameWork\Manager;

abstract class CommentsManager extends Manager
{
    abstract public function get($id);
    abstract public function getAll($newsId);
    abstract public function getAllNews();
    abstract public function add(Comment $comment);
    abstract public function edit(Comment $comment);
    abstract public function delete(Comment $comment);

    public function save(Comment $comment)
    {
        $comment->isNew() ? $this->add($comment) : $this->edit($comment);
    }
}