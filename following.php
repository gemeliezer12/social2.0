<?php
include "assets/header.php";
$userData = $user->fetchData($_GET["username"]);
$profileData = $profile->fetchData($userData["userID"]);
$followings = $relationship->fetchFollowing($userData["userID"]);
?>
<body>
    <?php
        include "assets/sidebar.php";
    ?>

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
        <div class="display: none;">

            <?php
            $userIDs = array();
            foreach($followings as $following){
                array_push($userIDs, $following["followingID"]);
            }
            include "assets/profile.php";
            ?>
        </div>
    </main>
</body>
</html>