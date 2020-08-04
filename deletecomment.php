<?php 
//utilitiesの取り込み
require('includes/utilities.inc.php');
//ヘッダーの取り込み
include('includes/header.inc.php');
include('class/validation.php');


//gobackボタンのためにレファラを取得
if (isset($_SERVER["HTTP_REFERER"]) && 
   !strpos($_SERVER["HTTP_REFERER"], "logout")){
    $referer = $_SERVER["HTTP_REFERER"];
}

if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] === "POST")){
    if (isset($_POST['deleteComment'])){
        $var = $_POST['pageid'];
        $pageobj = page($_POST['pageid'], $link);
        if (($pageobj->getcreatorid()) === $_SESSION['userId']){
            include('views/deleteComment.html');
        }
    }
    if (isset($_POST['deleteComment2'])){
        $pageobj = page($_POST['pageid'], $link);
        if (($pageobj->getcreatorid()) === $_SESSION['userId'])
         try{
            $q = "DELETE FROM pages where  id={$pageobj->getpageid()}";
            $result = $link->exec($q);
                echo "<section>";
                echo "記事を削除しました。";
                echo "</section>";
            }
        catch (PDOException $e){
            $pagetitle = "Error";
            include('includes/header.inc.php');
            include('views/error.html');
            include('includes/footer.inc.php');
            exit(); //エラーが起きたときにその後の処理を中断
        }      
      
     }
    if (isset($_POST['goback'])){
        $e = isset($referer) ? $referer : "index.php";
        header("Location: {$e}");
        // header("Location:.index.php");
    }
}



include('includes/footer.inc.php'); 
