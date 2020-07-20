

<h1>コメント投稿サイト</h1>
<nav>
    <ul>
        <li><a href="index.php">ホーム</a></li>
        <li><a href="contact.php">コンタクト</a></li>
        <li><?php echo isset($user) ? "<a href=\"logout.php\">ログアウト</a>" :  "<a href=\"login.php\">ログイン</a>" ?></li>
        <li><a href="register.php">登録</a></li>
    </ul>
</nav>
    
</body>
</html>