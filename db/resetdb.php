<?php 
//utilitiesの取り込み
require('includes/utilities.inc.php');
$tables = ['pages', 'comments', 'users'];
foreach ($tables as $table){
    $q = "DROP TABLE {$table};";
    $result = $link->exec($q);
};  
