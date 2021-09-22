<?php
include "assets/header.php";
if(isset($_GET["post"])){
    $likers = $postInteraction->fetchLike($_GET["post"]);
}
elseif(isset($_GET["comment"])){
    $likers = $commentInteraction->fetchLike($_GET["comment"]);
}
?>
<body>
    <nav class="sidebar">
        <div class="icon-links">
            <i onclick="location.href='home.php';" class="fab fa-twitter icon-hover-m current"></i>
            <i onclick="location.href='home.php';" class="fas fa-home icon-hover-m"></i>
            <i onclick="location.href='search.php';" class="fas fa-search icon-hover-m"></i>
            <i onclick="location.href='notif.php';" class="far fa-bell icon-hover-m"></i>
            <i onclick="location.href='message.php';" class="far fa-envelope icon-hover-m"></i>
            <i onclick="location.href='profile.php?username=<?php
            echo $_SESSION["username"];
            ?>';" class="far fa-user icon-hover-m current"></i>
            <i class="fas fa-cog icon-hover-m"></i>
        </div>
        <div>
            <img class="profile-picture-50" src="profiles/profile-picture/default.png" alt="">
        </div>
    </nav>

    <main class="sidebar-margin-left main-body">
        <header class="main-header padding-15 border-bottom">
            <i class="fas fa-arrow-left icon-hover-s current margin-right-15" onclick="window.history.go(-1); return false;"></i>
            <div>
                <p class="title-m">Liked by</p>
            </div>
        </header>
        <div class="header-margin-top"></div>
        <?php
            $userIDs = array();
            foreach($likers as $liker){
                array_push($userIDs, $liker["postedID"]);
            }
            include "assets/profile.php";
        ?>
    </main>
</body>
</html>