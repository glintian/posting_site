<?php 
//utilitiesの取り込み
require('includes/utilities.inc.php');
//ヘッダーの取り込み
include('includes/header.inc.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
 $page = page($_GET['id'], $link);
 $pageid = $_GET['id'];
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
 $userobj = user($page->creatorId, $link);
?>

<h1><?php echo e($page->title); ?></h1>
<p class="author"><?= e($userobj->getusername()) ?></p>
<p><?= $page->getcontent() ?></p>
<p>Comments</p>
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

if (isset($_SERVER['REQEUST_METHOD']) 
    && ($_SERVER['REQUEST_METHOD'] === 'POST')){
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

include('includes/footer.inc.php');