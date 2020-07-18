<?php 

try{
    $db = parse_url(getenv('CLEARDB_DATABASE_URL'));
    $database = substr($db['path'], 1);
    // $hostname = getenv('hostname');
    $hostname = $db["host"];
    $dbuser = $db["user"];
    $password = $db["pass"];
    // $database = getenv('database');
    $user = $hostname . "database is " . $database;
    $dsn ="mysql:host={$hostname};dbname={$database};charset=utf8";
    // $dbuser = getenv('username'); 
    // $password = getenv('password');
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