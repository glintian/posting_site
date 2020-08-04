<?php 
//utilitiesの取り込み
require('includes/utilities.inc.php');
//ヘッダーの取り込み
include('includes/header.inc.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    if (!(isset($_GET['id']))){
        echo "hello";
        header("Location:index.php");
        exit;
    }
    if (isset($_GET['id'])){
 $page = page($_GET['id'], $link);
 $pageid = $_GET['id'];
 $userobj = user($page->getcreatorid(), $link);
    }
}else {
    $page = page($_POST['pageid'], $link);
    $pageid = $_POST['pageid'];
    echo "entered";
    try{
        $q =  "INSERT INTO comments VALUES(null, :creatorid, :comment,  current_timestamp(), :pageId) ";
        $result = $link->prepare($q);
        $userobj = finduser($user, $link);
        $result->execute(array(':creatorid' => $userobj->getuserid(), ':pageId' => $pageid, ':comment'=>  e($_POST['comment']) ));
        }
    catch (PDOException $e){
        $pagetitle = "Error";
        include('includes/header.inc.php');
        include('views/error.html');
        include('includes/footer.inc.php');
        exit(); //エラーが起きたときにその後の処理を中断
    } 
}
 
?>
<?php
echo "<section>";
if (isset($_SESSION['userId']) && ($page->getcreatorid()) === $_SESSION['userId']){
    $id = $page->getpageid();
    echo "<form class=\"deleteComment\" action=\"deleteComment.php\" method=\"POST\">
    <button type=\"submit\" name=\"deleteComment\" value=\"deleteComment\">記事の削除</button>
    <input type=\"hidden\" name=\"pageid\" value=\"{$id}\"></input>
</form>";
}
?>

<h1><?php echo e($page->title); ?></h1>
<p class="author"><?= "投稿者:" . e($userobj->getusername()) ?></p>
<p><?= $page->getcontent() ?></p>

<h3>コメント一覧</h3>
<ul>
    
<?php 
$comments = comments($pageid, $link);
if ($comments){
        while ($row = $comments->fetch()){ ?>
    <li>
        <?php
            echo e(user($row->getcreatorid(), $link)->getusername());
            echo " : " . e($row->getContent());
            echo " - " . e($row->getdateAdded());
            }
        } ?>
    </li>
</ul>
<?php  
if (isset($user)){
    include('views/showpage.html');
}else {
    echo "投稿をするにはログインをしてください。";
} 
echo "</section>";

if (isset($_SERVER['REQEUST_METHOD']) 
    && ($_SERVER['REQUEST_METHOD'] === 'POST')){
        try{
            $q =  "INSERT INTO comments VALUES(null, :creatorid, :comment,  current_timestamp(), :pageId) ";
            $result = $link->prepare($q);
            $userobj = finduser($user, $link);
           $result->execute(array(':creatorid' => $userobj->getuserid(), ':pageId' => $pageid, ':comment'=>  e($_POST['comment']) ));
            }
        catch (PDOException $e){
            $pagetitle = "Error";
            include('includes/header.inc.php');
            include('views/error.html');
            include('includes/footer.inc.php');
            exit(); //エラーが起きたときにその後の処理を中断
        }       
}

include('includes/footer.inc.php');