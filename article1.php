<?php
include "assets/header.php";
if(!isset($_SESSION["username"])){
    header("Location: index.php");
}
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
$mainCheckLike = $articleInteraction->checkLike($_SESSION["userID"], $mainArticle[$mainArticleType."ID"], $mainArticleType);
$mainFetchLike = $articleInteraction->fetchLike($mainArticle[$mainArticleType."ID"], $mainArticleType);
$mainCheckRepost = $articleInteraction->checkRepost($_SESSION["userID"], $mainArticle[$mainArticleType."ID"], $mainArticleType);
$mainFetchRepost = $articleInteraction->fetchRepost($mainArticle[$mainArticleType."ID"], $mainArticleType);
$mainCheckComment = $article->checkCommented($mainArticle[$mainArticleType."ID"], $_SESSION["userID"], $mainArticleType);
$mainFetchComment = $article->fetchByCommented($mainArticle[$mainArticleType."ID"], $mainArticleType);
?>
<body>
    <?php
    include "assets/sidebar.php";
    ?>
    <script>
        $(document).ready(function(){
            setInterval(function(){
                $(".ajax-loader").load("ajax/fetch-like.php",{
                    articleID: <?php echo $mainArticle[$articleID]?>,
                    type: "<?php echo $mainArticleType?>"
                });
            }, 200);
            $("#like-input-<?php
            echo $mainArticleType;
            echo $mainArticle[$articleID]
                ?>").click(function(){
                    
                    $(".like-loader").load("inc/like.php",{
                    articleID: <?php echo $mainArticle[$articleID]?>,
                    posterID: "<?php echo $mainArticle["userID"]?>",
                    submit: $(this).children("button").attr("name"),
                    type: "<?php
                    echo $mainArticleType;
                    ?>"
                });
            })
            $("#repost-input-<?php
            echo $mainArticleType;
            echo $mainArticle[$articleID]
                ?>").click(function(){
                    
                    $(".repost-loader").load("inc/repost.php",{
                    articleID: <?php echo $mainArticle[$articleID]?>,
                    posterID: "<?php echo $mainArticle["userID"]?>",
                    submit: $(this).children("button").attr("name"),
                    type: "<?php
                    echo $mainArticleType;
                    ?>"
                });
            })
        })
    </script>
    <main class="sidebar-margin-left main-body">
        <header class="main-header padding-15 border-bottom">
            <i class="fas fa-arrow-left icon-hover-s current margin-right-15" onclick="window.history.go(-1); return false;"></i>
            <div>
                <p class="title-m">Tweet</p>
            </div>
        </header>
        <div class="header-margin-top"></div>
        <main class="post padding-15">
            <div class="border-bottom padding-top">
                <header>
                    <div class="margin-10" href="profile.php?username=<?php
                    echo $mainUser["username"];
                    ?>">
                        <img src="profiles/profile-picture/default.png" alt="" class="profile-picture-60">    
                    </div>
                    <div>
                        <a href="profile.php?username=<?php
                        echo $mainUser["username"];
                        ?>" class="title-l"><?php
                        echo $mainProfile["name"];
                        ?></a>
                        <p class="subtitle-s">@<?php
                        echo $mainUser["username"];
                        ?></p>
                    </div>
                </header>
                <article class="title-l margin-top-10 font-500">
                    <?php
                    echo $mainArticle["content"];
                    ?>
                </article>
                <div class="padding-y-15">
                    <span class="subtitle-xs hover-underline"><?php
                    echo $time->hour($mainArticle["dateCreated"]);
                    ?></span>
                    <span class="subtitle-xs">·</span>
                    <span class="subtitle-xs hover-underline"><?php
                    echo $time->date($mainArticle["dateCreated"]);
                    ?></span>
                </div>
                
                    <?php
                    if(count($mainFetchLike) > 0 || count($mainFetchRepost) > 0){
                        ?>
                        <div class="padding-y-15 border-top">
                        <?php
                        if(count($mainFetchLike) > 0){
                            ?>
                            <a class="subtitle-s hover-underline" href="like.php?<?php
                            echo $mainArticleType;
                            ?>=<?php
                            echo $mainArticle[$mainArticleType."ID"];
                            ?>">
                                <span><?php
                                echo count($mainFetchLike);
                                ?></span>
                                Likes
                            </a>
                            <?php
                        }
                        if(count($mainFetchRepost) > 0){
                            ?>
                            <a class="subtitle-s hover-underline" href="repost.php?<?php
                            echo $mainArticleType;
                            ?>=<?php
                            echo $mainArticle[$mainArticleType."ID"];
                            ?>">
                                <span><?php
                                echo count($mainFetchRepost);
                                ?></span>
                                Reposts
                            </a>
                            <?php
                        }
                        ?>
                        </div>
                        <?php
                    }
                    ?>
                
                <footer class="width-100 post-btns border-top padding-y-6">
                    <a href="">
                        <?php
                        if($mainCheckComment > 0){
                            ?>
                            <i class="fas fa-comment icon-hover-s current"></i>
                            <?php
                        }
                        else{
                            ?>
                            <i class="far fa-comment icon-hover-s"></i>
                            <?php
                        }
                        ?>
                    </a>
                    <div id="like-repost-<?php
                    echo $articleType;
                    echo $post[$articleID]
                    ?>" action="inc/repost.php" method="POST">
                        <input type="hidden" name="posterID" value="<?php
                        echo $mainUser["userID"];
                        ?>">
                        <input type="hidden" name="postID" value="<?php
                        echo $mainArticle[$mainArticleType."ID"];
                        ?>">
                        <?php
                        if($mainCheckRepost > 0){
                            ?>
                            <button name="unsubmit" type="submit">
                                <i class="fas fa-retweet icon-hover-s reposted"></i>
                            </button>
                            <?php
                        }
                        else{
                            ?>
                            <button name="submit" type="submit">
                                <i class="fas fa-retweet icon-hover-s"></i>
                            </button>
                            <?php
                        }
                        
                        ?>
                        <p class="subtitle-m <?php
                        if($mainCheckRepost > 0){
                            echo "reposted";
                        }
                        ?>">
                        </p>
                    </div>
                    <div id="like-input-<?php
                    echo $articleType;
                    echo $post[$articleID]
                    ?>" id="like-form" action="inc/like.php" method="POST">
                        <input id="posterID" type="hidden" name="posterID" value="<?php
                        echo $mainUser["userID"];
                        ?>">
                        <input id="posterID" type="hidden" name="postID" value="<?php
                        echo $mainArticle[$mainArticleType."ID"];
                        ?>">
                        <?php
                        if($mainCheckLike > 0){
                            ?>
                            <button id="unsubmit" name="unsubmit" type="submit">
                                <i class="fas fa-heart icon-hover-s liked"></i>
                            </button>
                            <?php
                        }
                        else{
                            ?>
                            <button id="submit" name="submit" type="submit">
                                <i class="far fa-heart icon-hover-s"></i>
                            </button>
                            <?php
                        }
                        ?>
                        
                        <p class="subtitle-m <?php
                        if($mainCheckLike > 0){
                            echo "liked";
                        }
                        ?>">
                        </p>
                    </div>
                    <i class="fas fa-ellipsis-h icon-hover-s"></i>
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
                <img class="profile-picture-50" src="profiles/profile-picture/default.png" alt="">
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
    </main>
</body>
</html>