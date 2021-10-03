<?php
include "assets/header.php";
if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
if(empty($_GET["username"])){
    header("Location: profile.php?username=$username");
    exit();
}
$userData = $user->fetchData($_GET["username"]);
$profileData = $profile->fetchData($userData["userID"]);
$userPost = $article->fetchByUser($userData["userID"], "post");
$following = $relationship->fetchFollowing($userData["userID"]);
$follower = $relationship->fetchFollower($userData["userID"]);
$checkFollow = $relationship->checkFollow($userData["userID"], $_SESSION["userID"]);
?>
<script>
    $(document).ready(function(){
        $("#follow-input<?php
        echo $userData["userID"];
        ?>").click(function(){
            $(".follow-loader").load("inc/follow.php",{
                follower: <?php
                echo $_SESSION["userID"]
                ?>,
                following: <?php
                echo $userData["userID"]
                ?>,
                submit: $("#follow-input<?php
                echo $userData["userID"];
                ?>").attr("name")
            });
        })
    })
</script>
<body>
    <div class="body-400  relative border-if">
    <?php
        include "assets/sidebar.php";
    ?>

    <main class="sidebar-margin-left main-body">
        <header class="main-header padding-15 z-30 border-bottom">
            <i class="fas fa-arrow-left icon-hover-s current margin-right-15" onclick="window.history.go(-1); return false;"></i>
            <div>
                <p class="title-18"><?php
                echo $userData["username"];
                ?></p>
                <p class="subtitle-14"><?php
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
                    <img onerror="this.onerror=null; this.src='profiles/profile-picture/default.png'" class="profile-picture-50" src="<?php
                    echo $profilePictureDestination;
                    echo $profileData["profilePicture"];
                    ?>" alt="">
                </a>
                <?php
                if(isset($_SESSION["userID"])){
                    if($_SESSION["userID"] === $userData["userID"]){
                        ?>
                        <a class="btn-m btn-t" href="edit-profile.php">Edit profile</a>
                        <?php
                    }
                    else{
                        ?>
                        <input id="follow-input<?php
                            echo $userData["userID"];
                        ?>" type="submit" name="<?php
                        if($checkFollow === 0){
                            echo "submit"
                            ?>" class="btn-m btn-t following" value="Follow">
                            <?php
                        }
                        else{
                            echo "unsubmit"
                            ?>" class="btn-m btn-c hover-color following" value="Following">
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
            </div>
            <p class="title-20 margin-top-6"><?php
            echo $profileData["name"];
            ?></p>
            <p class="subtitle-16">@<?php
            echo $userData["username"];
            ?></p>
            <p class="title-18 margin-top-10">
                <?php
                echo $profileData["bio"];
                ?>
            </p>
            <?php
            if(!empty($profileData["website"])){
                ?>
                <span class="padding-top-10 inline-block">
                    <i class="fas fa-link fs-18"></i>
                    <a  class="title-primary-s hover-underline" href="<?php
                    echo $profileData["website"];
                    ?>"><?php
                    echo $profileData["website"];
                    ?></a>
                </span>
                <?php
            }
            ?>
            <div class="margin-top-10">
                <a class="subtitle-16 hover-underline" href="relationship.php?following=<?php
                echo $userData["username"];
                ?>">
                    <span><?php
                    echo count($following);
                    ?></span>
                    Following
                </a>
                <a class="subtitle-16 hover-underline" href="relationship.php?follower=<?php
                echo $userData["username"];
                ?>">
                    <span class="follower-count"><?php
                    echo count($follower);
                    ?></span>
                    Followers
                </a>
            </div>
        </header>
        <div class="space"></div>
        <?php
        $postArray = array();
        foreach($userPost as $result){
            array_push($postArray, $result);
        }
        ?>
        <main class="posts">
            <?php
            include "assets/article.php";
            ?>
        </main>
        <div style="height: calc(100vh - 54px);"></div>
    </main>
</body>
</html>

<div class="follow-loader"></div>
    <?php
}