<?php
include "assets/header.php";
if(isset($_GET["following"])){
    $relation = "following";
    $relationID = "followingID";
    $userData = $user->fetchData($_GET["following"]);
    $users = $relationship->fetchFollowing($userData["userID"]);
}
elseif(isset($_GET["follower"])){
    $relation = "follower";
    $relationID = "followerID";
    $userData = $user->fetchData($_GET["follower"]);
    $users = $relationship->fetchFollower($userData["userID"]);
}
$profileData = $profile->fetchData($userData["userID"]);
?>
<body>
    <div class="body-400 border-if">

        <?php
            include "assets/sidebar.php";
        ?>
    
        <main class="sidebar-margin-left main-body" style="">
            <header class="main-header padding-15">
                <i class="fas fa-arrow-left icon-hover-s current margin-right-15" onclick="window.history.go(-1); return false;"></i>
                <div>
                    <p class="title-18"><?php
                    echo $profileData["name"];
                    ?></p>
                    <p class="subtitle-14">@<?php
                    echo $userData["username"];
                    ?></p>
                </div>
            </header>
            <div class="header-margin-top"></div>
            <header class="padding-10 tabs">
                <a href="" class="subtitle-18 tab">Followers you know</a>
                <a href="relationship.php?follower=<?php
                echo $userData["username"];
                ?>" class="subtitle-18 tab <?php
                if(isset($_GET["follower"])){
                    echo "current";
                }
                ?>">Followers</a>
                <a href="relationship.php?following=<?php
                echo $userData["username"];
                ?>" class="subtitle-18 tab <?php
                if(isset($_GET["following"])){
                    echo "current";
                }
                ?>">Following</a>
            </header>
            <div class="display: none;">
    
                <?php
                $userIDs = array();
                foreach($users as $userResult){
                    array_push($userIDs, $userResult[$relationID]);
                }
                include "assets/profile.php";
                ?>
            </div>
        </main>
    </div>
</body>
</html>