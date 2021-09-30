<?php
include "assets/header.php";
if(isset($_SESSION["username"])){
    header("location: home.php");
    exit();
}
?>
<body class="index-page">
    <div class="body-300">
        
        <form class="padding-top-80" action="inc/signup.php" method="POST">
            <p class="title-40">Signup now</p>
            <div class="input-lbl margin-top-40">
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
            <input name="submit" class="btn-m btn-c width-100" type="submit" value="Sign up">
            <div class="links text-center margin-top-26">
                <a class="hover-underline title-primary-s" href="home.php">Forgot password</a>
                <span>·</span>
                <a class="hover-underline title-primary-s" href="signup.php">Sign up now!</a>
            </div>
        </form>
    </div>
</body>
</html>