

<h1>THis is footer</h1>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Archive</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><?php echo isset($user) ? "<a href=\"logout.php\">Logout</a>" :  "<a href=\"login.php\">Login</a>" ?></li>
        <li><a href="register.php">register</a></li>
    </ul>
</nav>
    
</body>
</html>