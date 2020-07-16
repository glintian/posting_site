<?php 
//utilitiesの取り込み
require('includes/utilities.inc.php');
//ヘッダーの取り込み
include('includes/header.inc.php');


if (!isset($user)){
    echo "ログインをしてください。";
    exit;
}

include('views/submit.html');
if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD']=== "POST")){
    // var_dump($user);
    $userinfo = finduser($user, $link);
        var_dump($userinfo->getuserid());
    if ($userinfo = finduser($user, $link)){
        echo "hello";
        try{
        $q =  "INSERT INTO pages VALUES(null, :creatorid, :title, :content, current_timestamp(), current_timestamp())";
        $result = $link->prepare($q);
        $result->execute(array(':creatorid' => $userinfo->getuserid(), ':title' => e($_POST['title']), ':content'=> '<p>' . e($_POST['article']) . '</p>' ));
        }
        catch (PDOException $e){
            $pagetitle = "Error";
            include('includes/header.inc.php');
            include('views/error.html');
            include('includes/footer.inc.php');
            exit(); //エラーが起きたときにその後の処理を中断
        }
    }
}
    


include('includes/footer.inc.php');




include('includes/footer.inc.php');