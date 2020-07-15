<?php 
//utilitiesの取り込み
require('includes/utilities.inc.php');
//ヘッダーの取り込み
include('includes/header.inc.php');


//最新の記事の取り込み
try {
    $q = 'SELECT id, title, content, DATE_FORMAT(dateAdded, "%e %M  %Y") As dateAdded FROM pages order by dateAdded DESC';
    $result = $link->query($q);
    //Pageクラスでフェッチ
    $result->setFetchMode(PDO::FETCH_CLASS, 'Page');
    }

catch(PDOException $e){
    include('views/error.html');
}

require('views/index.html');

include('includes/footer.inc.php');