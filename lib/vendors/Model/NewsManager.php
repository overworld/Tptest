<?php

namespace Model;

use Entity\News;
use TheFrameWork\Manager;

abstract class NewsManager extends Manager
{
    abstract public function getAll($offset = -1, $limit = -1);
    abstract public function get($id);
    abstract public function add(News $news);
    abstract public function edit(News $news);
    abstract public function delete(News $news);

    public function save(News $news)
    {
        $news->isNew() ? $this->add($news) : $this->edit($news);
    }
}