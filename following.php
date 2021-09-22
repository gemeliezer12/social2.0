<?php
include "assets/header.php";
$userData = $user->fetchData($_GET["username"]);
$profileData = $profile->fetchData($userData["userID"]);
$userPosts = $post->fetchDataByUser($userData["userID"]);
$followings = $relationship->fetchFollowing($userData["userID"]);
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

    <main class="sidebar-margin-left main-body" style="">
        <header class="main-header padding-15">
            <i class="fas fa-arrow-left icon-hover-s current margin-right-15" onclick="window.history.go(-1); return false;"></i>
            <div>
                <p class="title-m"><?php
                echo $profileData["name"];
                ?></p>
                <p class="subtitle-xs">@<?php
                echo $userData["username"];
                ?></p>
            </div>
        </header>
        <div class="header-margin-top"></div>
        <header class="padding-10 tabs">
            <a href="" class="subtitle-m tab">Followers you know</a>
            <a href="follower.php?username=<?php
            echo $userData["username"];
            ?>" class="subtitle-m tab">Followers</a>
            <a href="following.php?username=<?php
            echo $userData["username"];
            ?>" class="subtitle-m tab current">Following</a>
        </header>
        <?php
            $userIDs = array();
            foreach($followings as $following){
                array_push($userIDs, $following["followingID"]);
            }
            include "assets/profile.php";
        ?>
    </main>
</body>
</html>