<?php 

try{
    $db = parse_url(getenv('CLEARDB_DATABASE_URL'));
    $database = substr($db['path'], 1);
    $hostname = $db["host"];
    $dbuser = $db["user"];
    $password = $db["pass"];
    $dsn ="mysql:host={$hostname};dbname={$database};charset=utf8";
    $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
  );
    $link = new PDO($dsn,$dbuser,$password,$options);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
        $pagetitle = "Error";
        include('includes/header.inc.php');
        include('views/error.html');
        include('includes/footer.inc.php');
        exit(); //エラーが起きたときにその後の処理を中断
    }

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
  $q = "CREATE TABLE comments(
    id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    userType enum('public', 'author', 'admin') NOT NULL,
    username varchar(30) UNIQUE,
    email varchar(40) UNIQUE, 
    pass char(40),
    dateAdded timestamp DEFAULT CURRENT_TIMESTAMP)";
  $result = $link->exec($q);