<?php 
//utilitiesの取り込み
require('includes/utilities.inc.php');
//ヘッダーの取り込み
include('includes/header.inc.php');
include('class/validation.php');


//gobackボタンのためにレファラを取得
if (isset($_SERVER["HTTP_REFERER"]) && !strpos($_SERVER["HTTP_REFERER"], "logout")){
    $referer = $_SERVER["HTTP_REFERER"];
}

if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] === "POST")){
    echo "received";
    if (isset($_POST['logout'])){ 
    // Clear the variable:
    $user = null;
    
    // Clear the session data:
    $_SESSION = array();
    
    // Clear the cookie:
    setcookie(session_name(), false, time()-3600);
    
    // Destroy the session data:
    session_destroy();
    //ログアウト後のヘッダーのリンクがloginとなるようにページを再読み込み
    header("Location:./logout.php");
    // header("Location:../login.php");
    }
    if (isset($_POST['goback'])){
        $e = isset($referer) ? $referer : "index.php";
        header("Location: {$e}");
        // header("Location:.index.php");
    }
}

if ($user){
include('views/logout.html');
}else{
    echo "ログアウトをしました";
    // header("Location:index.php");
}

include('includes/footer.inc.php'); 
