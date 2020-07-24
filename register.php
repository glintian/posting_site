<?php 
//utilitiesの取り込み
require('includes/utilities.inc.php');
//ヘッダーの取り込み
include('includes/header.inc.php');
include('class/validation.php');

if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] === "POST")){
    $v = new MyValidator();
    if ($v->emailcheck($_POST['email'])){
        if (finduser($_POST['username'], $link)){
            $v->adderror("そのusernameはすでに使われています。{$_POST['username']}");
        } else{
            try{
            $q =  "INSERT INTO users values(null, \"public\", :username, :email, \"pass\", current_timestamp())";
            $result = $link->prepare($q);
            $result->execute(array(':username' => $_POST['username'], ':email' => sha1(($_POST['email']))));
            print "登録が完了しました。";
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
}

include('views/register.html');
