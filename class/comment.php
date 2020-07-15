<?php 
//ページクラス

class Comment{
    private $id;
    private $creatorId;
    public $dateAdded;
    private $comment;
    private $pageId;

    public function getid(){
        return $this->id;
    }

    public function getcreatorid(){
        return $this->creatorId;
    }

    public function getdateAdded(){
        return $this->dateAdded;
    }

    public function getContent(){
        return $this->comment;
    }

    public function getpageId(){
        return $this->pageId;
    }

}

