<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !isset($pagetitle) ? $pagetitle = "Page" : $pagetitle ?></title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<h1>this is header</h1>
<nav>
    <p style="text-align: right"> <?php if(isset($user)) {
        echo $user;} ?> </p>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Archive</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><?php echo isset($user) ? "<a href=\".\logout.php?={$pagetitle}\">Logout</a>" :  "<a href=\"login.php\">Login</a>" ?></li>
        <li><a href="register.php">register</a></li>
        <li><a href="submit.php">submit</a></li>
    </ul>
</nav> 
