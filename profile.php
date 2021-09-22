<?php
include "assets/header.php";
if(!isset($_SESSION["username"])){
    header("Location: index.php");
}
$username = $_SESSION["username"];
if(empty($_GET["username"])){
    header("Location: profile.php?username=$username");
}
$userData = $user->fetchData($_GET["username"]);
$profileData = $profile->fetchData($userData["userID"]);
$userPost = $post->fetchDataByUser($userData["userID"]);
$following = $relationship->fetchFollowing($userData["userID"]);
$follower = $relationship->fetchFollower($userData["userID"]);
$checkFollow = $relationship->checkFollow($userData["userID"], $_SESSION["userID"]);
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
        <header class="main-header padding-15">
            <i class="fas fa-arrow-left icon-hover-s current margin-right-15" onclick="window.history.go(-1); return false;"></i>
            <div>
                <p class="title-m"><?php
                echo $userData["username"];
                ?></p>
                <p class="subtitle-xs"><?php
                echo count($userPost);
                ?> Tweets</p>
            </div>
        </header>
        <div class="header-margin-top"></div>
        <a class="aspect-3x1">
            <img src="profiles/cover/default.png" alt="">
        </a>
        <header class="main-profile-header padding-15 padding-bottom-10 border-bottom">
            <div class="profile-picture-header">
                <a class="aspect-1x1" href="">
                    <img src="profiles/profile-picture/default.png" alt="">
                </a>
                <form action="inc/follow.php" method="POST">
                    <input type="hidden" name="following" value="<?php
                    echo $userData["userID"];
                    ?>">
                    <?php
                    if(isset($_SESSION["userID"])){
                        if($_SESSION["userID"] === $userData["userID"]){
                            ?>
                            <a class="btn-m btn-t" href="edit-profile.php">Edit profile</a>
                            <?php
                        }
                        else{
                            if($checkFollow === 0){
                                ?>
                                <input type="submit" name="submit" class="btn-m btn-t" value="Follow">
                                <?php
                            }
                            elseif($checkFollow > 0){
                                ?>
                                <input type="submit" name="unsubmit" class="btn-m btn-c hover-color" value="Following">
                                <?php
                            }
                        }
                    }
                    else{
                        ?>
                        <a href="index.php">Follow</a>
                        <?php
                    }
                    
                    ?>
                </form>
            </div>
            <p class="title-l margin-top-6"><?php
            echo $profileData["name"];
            ?></p>
            <p class="subtitle-s">@<?php
            echo $userData["username"];
            ?></p>
            <p class="title-m margin-top-10">
                <?php
                echo $profileData["bio"];
                ?>
            </p>
            <div class="margin-top-10">
                <a class="subtitle-s hover-underline" href="following.php?username=<?php
                echo $userData["username"];
                ?>">
                    <span><?php
                    echo count($following);
                    ?></span>
                    Following
                </a>
                <a class="subtitle-s hover-underline" href="follower.php?username=<?php
                echo $userData["username"];
                ?>">
                    <span><?php
                    echo count($follower);
                    ?></span>
                    Followers
                </a>
            </div>
        </header>
        <div class="space"></div>
        <?php
        $postArray = array();
        $selfPosts = $post->fetchDataByUser($_SESSION["userID"]);
        foreach($selfPosts as $selfPost){
            array_push($postArray, $selfPost);
        }
        ?>
        <main class="posts">
            <?php
            include "assets/post.php";
            ?>
        </main>
    </main>
</body>
</html>