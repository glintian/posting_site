<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !isset($pagetitle) ? $pagetitle = "Page" : $pagetitle ?></title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<h1>コメント投稿サイト</h1>
<nav>
    <p style="text-align: right"> <?php if(isset($user)) {
        echo "こんにちは、" . $user;} ?> </p>
    <ul>
        <li><a href="index.php">ホーム</a></li>
        <li><a href="#">アーカイブ</a></li>
        <li><a href="contact.php">コンタクト</a></li>
        <li><?php echo isset($user) ? "<a href=\".\logout.php?={$pagetitle}\">ログアウト</a>" :  "<a href=\"login.php\">ログイン</a>" ?></li>
        <li><a href="register.php">登録</a></li>
        <li><a href="submit.php">submit</a></li>
    </ul>
</nav> 
