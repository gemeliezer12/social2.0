<?php
include "assets/header.php";
if(isset($_SESSION["username"])){
    header("location: home.php");
}
?>
<body class="sign-up-page">
    <form class="index logsign" action="inc/signup.php" method="POST">
        <p class="title">Signup now</p>
        <div class="input-lbl">
            <label for="username">Username</label>
            <input name="username" type="text">
        </div>
        <div class="input-lbl">
            <label for="email">Email</label>
            <input name="email" type="text">
        </div>
        <div class="input-lbl">
            <label for="password">Password</label>
            <input name="password" type="password">
        </div>
        <div class="input-lbl">
            <label for="password-repeat">Repeat Password</label>
            <input name="password-repeat" type="password">
        </div>
        <input name="submit" class="btn-m btn-c no-margin-top" type="submit" value="Sign up">
        <div class="option">
            <a class="hover" href="home.php">Forgot password</a>
            <span>·</span>
            <a class="hover" href="signup.php">Log in now!</a>
        </div>
    </form>
</body>
</html>