<?php #utilies.inc.php 
#全体の設定に関するファイル

#クラスのオートロード
function class_loader($class){
    require('class/' . $class . '.php');
}spl_autoload_register('class_loader');

//セッションの開始
session_start();

//ユーザーの確認
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
// $_SERVER['REQUEST_URI']
//データベースへの接続
try{
    $link = new PDO("mysql:host = localhost;dbname=cms", "root", "mysqlpass");
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e){
        $pagetitle = "Error";
        include('includes/header.inc.php');
        include('views/error.html');
        include('includes/footer.inc.php');
        exit(); //エラーが起きたときにその後の処理を中断
    }

//idによるuser, およびpageの情報取得
function page($id, $link){
    $q = "SELECT title, content, creatorId, DATE_FORMAT(dateAdded, \"%e %M  %Y\") As dateAdded FROM pages where id={$id}";
    $result = $link->query($q);
    //Pageクラスでフェッチ
    $result->setFetchMode(PDO::FETCH_CLASS, 'Page');
    $page = $result->fetch();
    return $page;
}

function user($id, $link){
$q = "SELECT username, userType, email, pass, DATE_FORMAT(dateAdded, \"%e %M  %Y\") As dateAdded FROM users where id={$id}";
    $result = $link->query($q);
    $result->setFetchMode(PDO::FETCH_CLASS, 'User');
    $user = $result->fetch();
    return $user;
}

function comments($id, $link){
    $q = "SELECT id, creatorId, comment, DATE_FORMAT(dateAdded, \"%e %M  %Y\") As dateAdded FROM comments where pageid={$id}";
    $result = $link->query($q);
    $result->setFetchMode(PDO::FETCH_CLASS, 'Comment');
    // $result = $result->fetch();
    return $result;
}

//usernameによるユーザー検索 userオブジェクトを返す $emailを渡せばemailもあっているか確認し、合っていればやはりuserオブジェクトを返す,　$emailを渡さなければusernameだけを検索有ればユーザーオブジェクトを返す。一致なければfalseを返す。
function finduser($username, $link, $email = False){
    $result = $link->prepare('SELECT * FROM users where username=:username');
    $result->bindvalue(':username', $username);
    $result->execute();
    $result->setFetchMode(PDO::FETCH_CLASS, 'User');
    $row = $result->fetch();
    if ($row && isset($email) && (trim($email) === trim($row->getemail())))
        return $row;
    else if ($row && (trim($row->getusername()) === trim($username)))
        return $row;
    else
        return false;
}

//htmlエンコーディングの処理関数

function e(string $str, string $charset = 'UTF-8'): string {
    return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, $charset);
 }


//error handler


