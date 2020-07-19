<?php 
//utilitiesの取り込み
require('includes/utilities.inc.php');

$q = "DROP DATABASE {$database}";
$result = $link->exec($q);  