<?php
include "assets/header.php";
if(isset($_SESSION["username"])){
    header("location: home.php");
}
?>
<body class="index-page">
    <main>
        <p class="index-title">Happening now</p>
        <p class="title-s">Join us today!</p>
        <a class="btn-m btn-t" href="signup.php">Sign up</a>
        <a class="btn-m btn-c" href="login.php">Log in</a>
    </main>
</body>
</html>