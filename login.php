<?php
include "assets/header.php";
if(isset($_SESSION["username"])){
    header("location: home.php");
}
?>
<body class="index-page">
    <div class="body-300">
        <form class="margin-top-80" action="inc/login.php" method="POST">
            <p class="title-40">Login now</p>
            <div class="input-lbl margin-top-40">
                <label for="email-username">Email/Username</label>
                <input name="email-username" type="text">
            </div>
            <div class="input-lbl">
                <label for="password">Password</label>
                <input name="password" type="password">
            </div>
            <input name="submit" class="btn-m btn-c no-margin-top width-100" type="submit" value="Log in">
            <div class="links text-center margin-top-26">
                <a class="hover-underline title-primary-s" href="home.php">Forgot password</a>
                <span>·</span>
                <a class="hover-underline title-primary-s" href="signup.php">Sign up now!</a>
            </div>
        </form>
    </div>
</body>
</html>