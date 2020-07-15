<?php 
//ページクラス

class User{
    protected $id;
    protected $username;
    protected $email;
    protected $usertype;

    public function getuserid(){
        return $this->id;
    }

    public function getusername(){
        return $this->username;
    }

    public function getemail(){
        return $this->email;
    }
    
    public function getusertype(){
        return $this->usertype;
    }

    public function isauthor(){
        if (($this->getusertype() === "author") 
        || ($this->getusertype() === "admin"))
            return true;
        else
            return false;
    }
}
