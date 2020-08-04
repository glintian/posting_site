<?php 
//utilitiesの取り込み
require('includes/utilities.inc.php');
//ヘッダーの取り込み
include('includes/header.inc.php');
include('class/validation.php');

if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $v = new MyValidator();
    $v->requiredCheck($_POST['username'], 'ISBNコード');   // 必須検証
    
    if ($v->emailcheck($_POST['email'])){
        if ($currentUser = finduser($_POST['username'], $link, sha1($_POST['email']))){
            $_SESSION['user'] = $_POST['username'];
            $_SESSION['userId'] = $currentUser->getuserid(); 
            if (isset($_POST['remember'])){
                setcookie('email', $_POST['email'], time() + (60 * 60 * 24 * 90));
                setcookie('username', $_POST['username'], time() + (60 * 60 * 24 * 90));
            }
            header("Location:index.php");
        }
         else{
        echo "正しいユーザーネームとパスワードを入力してください.";
         }

    }
}

include('views/login.html');

include('includes/footer.inc.php'); 
