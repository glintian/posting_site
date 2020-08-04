<?php 
//ページクラス

class Page{
    private $id;
    private $creatorID;
    private $dateAdded;
    private $dateUpdated;
    private $content;
    private $contenthead;


    public function getpageid(){
        return $this->id;
    }

    public function getcreatorid(){
        return $this->creatorID;
    }

    public function getdateAdded(){
        return $this->dateAdded;
    }

    public function getdateUpdated(){
        return $this->dateUpdated;
    }

    public function getContent(){
        return $this->content;
    }

    public function getcontenthead(){
        $this->contenthead = substr($this->getContent(), 3, 50) . "...";
        // $this->contenthead
        return $this->contenthead;
    }

}

