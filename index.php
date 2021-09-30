<?php
include "assets/header.php";
if(isset($_SESSION["username"])){
    header("location: home.php");
    exit();
}
?>
<body class="index-page">
    <div class="body-300">
        <main class="padding-top-80">
            <p class="title-40">Happening now</p>
            <p class="title-20 margin-top-40">Join us today!</p>
            <a class="btn-m btn-t margin-top-26" href="signup.php">Sign up</a>
            <a class="btn-m btn-c margin-top-26" href="login.php">Log in</a>
        </main>
    </div>
</body>
</html>