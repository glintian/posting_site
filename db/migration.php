<?php 
require('includes/utilities.inc.php');

print $database;
#pages テーブルの作成
  $q = "CREATE TABLE pages(
    id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    creatorID int(10) UNSIGNED NOT NULL,
    title varchar(100) NOT NULL,
    content text NOT NULL,
    dateUpdated timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    dateAdded timestamp NOT NULL)";
    $result = $link->exec($q);  
     

#commentsテーブルの作成
  $q = "CREATE TABLE comments(
    id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    creatorID int(10) UNSIGNED NOT NULL,
    comment text,
    dateAdded timestamp DEFAULT CURRENT_TIMESTAMP, 
    pageId int(11))";
    $result = $link->exec($q);

#usersテーブルの作成
  $q = "CREATE TABLE users(
    id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    userType enum('public', 'author', 'admin') NOT NULL,
    username varchar(30) UNIQUE,
    email varchar(40) UNIQUE, 
    pass char(40),
    dateAdded timestamp DEFAULT CURRENT_TIMESTAMP)";
  $result = $link->exec($q);