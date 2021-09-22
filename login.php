<?php
include "assets/header.php";
if(isset($_SESSION["username"])){
    header("location: home.php");
}
?>
<body class="index-page">
    <form class="" action="inc/login.php" method="POST">
        <p class="index-title">Login now</p>
        <div class="input-lbl">
            <label for="email-username">Email/Username</label>
            <input name="email-username" type="text">
        </div>
        <div class="input-lbl">
            <label for="password">Password</label>
            <input name="password" type="password">
        </div>
        <input name="submit" class="btn-m btn-c no-margin-top" type="submit" value="Log in">
        <div class="links">
            <a class="hover-underline title-s" href="home.php">Forgot password</a>
            <span>·</span>
            <a class="hover-underline title-s" href="signup.php">Sign up now!</a>
        </div>
    </form>
</body>
</html>