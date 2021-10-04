<?php

include "assets/header.php";
if(isset($_GET["post"])){
    $mainArticleType = "post";
    $mainArticleID = "postID";
}
elseif(isset($_GET["comment"])){
    $mainArticleType = "comment";
    $mainArticleID = "commentID";
}
$mainArticle = $article->fetchByArticle($_GET[$mainArticleType], $mainArticleType);
$mainUser = $user->fetchData($mainArticle["userID"]);
$mainProfile = $profile->fetchData($mainArticle["userID"]);
$mainFetchLike = $like->fetchLike($mainArticle[$mainArticleType."ID"], $mainArticleType);
$mainFetchRepost = $article->fetchByReposted($mainArticle[$mainArticleType."ID"], $mainArticleType);
$mainFetchComment = $article->fetchByCommented($mainArticle[$mainArticleType."ID"], $mainArticleType);
if(isset($_SESSION["username"])){
    $mainCheckLike = $like->checkLike($_SESSION["userID"], $mainArticle[$mainArticleType."ID"], $mainArticleType);
    $mainCheckRepost = $article->checkReposted($mainArticle[$mainArticleType."ID"], $_SESSION["userID"], $mainArticleType);
    $mainCheckComment = $article->checkCommented($mainArticle[$mainArticleType."ID"], $_SESSION["userID"], $mainArticleType);
}

?>
<body>
    <div class="body-400 border-if">

        <?php
        include "assets/sidebar.php";
        ?>
        <script>
            $(document).ready(function(){
                setInterval(function(){
                    $(".ajax-loader").load("ajax/fetch-like.php",{
                        articleID: <?php echo $mainArticle[$mainArticleID]?>,
                        type: "<?php echo $mainArticleType?>",
                        main: "true"
                    });
                }, 5000);
                
            })
        </script>
        <main class="sidebar-margin-left main-body">
            <header class="main-header padding-15 border-bottom">
                <i class="fas fa-arrow-left icon-hover-s current margin-right-15" onclick="window.history.go(-1); return false;"></i>
                <div>
                    <p class="title-18">Tweet</p>
                </div>
            </header>
            <div class="header-margin-top"></div>
            <main class="post padding-15">
                <div class="border-bottom padding-top">
                    <header>
                        <div class="margin-10" href="profile.php?username=<?php
                        echo $mainUser["username"];
                        ?>">
                            <img onerror="this.onerror=null; this.src='profiles/profile-picture/default.png'" class="profile-picture-50" src="<?php
                            echo $profilePictureDestination;
                            echo $mainProfile["profilePicture"];
                            ?>" alt="" class="profile-picture-60">    
                        </div>
                        <div>
                            <a href="profile.php?username=<?php
                            echo $mainUser["username"];
                            ?>" class="title-20"><?php
                            echo $mainProfile["name"];
                            ?></a>
                            <p class="subtitle-16">@<?php
                            echo $mainUser["username"];
                            ?></p>
                        </div>
                    </header>
                    <article class="fs-20 margin-top-10">
                        <?php
                        echo $mainArticle["content"];
                        ?>
                    </article>
                    <div class="padding-y-15">
                        <span class="subtitle-14 hover-underline"><?php
                        echo $time->hour($mainArticle["dateCreated"]);
                        ?></span>
                        <span class="subtitle-14">·</span>
                        <span class="subtitle-14 hover-underline"><?php
                        echo $time->date($mainArticle["dateCreated"]);
                        ?></span>
                    </div>
                    <div class="padding-y-15 border-top <?php
                    if(count($mainFetchLike) <= 0 && count($mainFetchRepost) <= 0){
                        echo "hidden";
                    }
                    ?>">
                        <a class="subtitle-16 hover-underline <?php
                        if(count($mainFetchLike) <= 0){
                            echo "hidden";
                        }
                        ?>" href="like.php?<?php
                        echo $mainArticleType;
                        ?>=<?php
                        echo $mainArticle[$mainArticleType."ID"];
                        ?>">
                            <span class="like-count-<?php
                            echo $mainArticleType;
                            echo $mainArticle[$mainArticleID];
                            ?>"><?php
                            echo count($mainFetchLike);
                            ?></span>
                            Likes
                        </a>
    
                        <a class="subtitle-16 hover-underline <?php
                        if(count($mainFetchRepost) <= 0){
                            echo "hidden";
                        }
                        ?>" href="repost.php?<?php
                        echo $mainArticleType;
                        ?>=<?php
                        echo $mainArticle[$mainArticleType."ID"];
                        ?>">
                            <span class="repost-count-<?php
                            echo $mainArticleType;
                            echo $mainArticle[$mainArticleID];
                            ?>"><?php
                            echo count($mainFetchRepost);
                            ?></span>
                            Reposts
                        </a>
                    </div>
                    
                    <footer class="width-100 post-btns border-top padding-y-6">
                        <footer class="width-100 post-btns">
                        <a class="btn-count comment-parent">
                            <?php
                            if(isset($_SESSION["username"])){
                                if($mainCheckComment > 0){
                                    ?>
                                    <i class="fas fa-comment icon-hover-s commented"></i>
                                    <?php
                                }
                                else{
                                    ?>
                                    <i class="far fa-comment icon-hover-s"></i>
                                    <?php
                                }
                            }
                            else{
                            ?>
                                <i class="far fa-comment icon-hover-s"></i>
                            <?php
                            }
                            ?>
                        </a>
                        
                        <button class="repost-parent repost-input-<?php
                        echo $mainArticleType;
                        echo $mainArticle[$mainArticleID];
                        ?>" name="<?php
                        if($mainCheckRepost > 0){
                            echo "unsubmit";
                        }
                        else{
                            echo "submit";
                        }
                        ?>">
                            <i class="fa-retweet icon-hover-s <?php
                            if($mainCheckRepost > 0){
                                echo "fas reposted";
                            }
                            else{
                                echo "fa";
                            }
                            ?>"></i>
                        </button>
                        <button class="like-parent like-input-<?php
                        echo $mainArticleType;
                        echo $mainArticle[$mainArticleID]
                        ?>" name="<?php
                        if($mainCheckLike > 0){
                            echo "unsubmit";
                        }
                        else{
                            echo "submit";
                        }
                        ?>">
                            <i class="fa-heart icon-hover-s <?php
                            if($mainCheckLike > 0){
                                echo "fas liked";
                            }
                            else{
                                echo "far";
                            }
                            ?>"></i>
                        </button>
                        <i class="fas fa-ellipsis-h icon-hover-s"></i>
                        <input type="hidden" class="article" id="<?php
                        echo $mainArticleType;
                        ?>" value="<?php
                        echo $mainArticle[$mainArticleID];
                        ?>">
                    </footer>
                </div>
            </main>
            <form class="padding-15 post padding-equal border-bottom" action="inc/comment.php" method="POST">
                <?php    
                if(isset($mainArticle["postID"])){
                    ?>
                    <input type="hidden" name="commentedPost" value="<?php
                    echo $mainArticle["postID"];
                    ?>">
                    <?php
                }
                elseif(isset($mainArticle["commentID"])){
                    ?>
                    <input type="hidden" name="commentedPost" value="<?php
                    echo $mainArticle["commentedPost"];
                    ?>">
                    <?php
                    ?>
                    <input type="hidden" name="commentedComment" value="<?php
                    echo $mainArticle["commentID"];
                    ?>">
                    <?php
                }
                ?>
                <aside class="side-profile margin-right-10">
                    <img class="profile-picture-50" onerror="this.onerror=null; this.src='profiles/profile-picture/default.png'" class="profile-picture-50" src="<?php
                    echo $profilePictureDestination;
                    echo $selfProfileData["profilePicture"];
                    ?>" alt="">
                </aside>
                <main class="form width-100">
                    <textarea name="content" placeholder="Comment your reply"></textarea>
                    <footer class="post-options width-100">
                        <div></div>
                        <input class="btn-m btn-c" type="submit" name="submit" value="Comment">
                    </footer>
                </main>
            </form>
            <?php
            $postArray = array();
            $comments = $article->fetchByCommented($mainArticle[$mainArticleType."ID"], $mainArticleType);
            foreach($comments as $result){
                array_push($postArray, $result);
            }
    
            ?>
            <main class="posts">
                <?php
                include "assets/article.php";
                ?>
            </main>
            <?php
                include "assets/loader.php";
            ?>
        </main>
        <div class="main-ajax-loader"></div>
    </div>
</body>
</html>