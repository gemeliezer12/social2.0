<?php
$dateCreatedArray= array();
foreach($postArray as $post){;
    array_push($dateCreatedArray, $post["dateCreated"]);
}
array_multisort($dateCreatedArray, SORT_DESC, $postArray);

foreach($postArray as $post){
    $postUser = $user->fetchData($post["userID"]);
    $postProfile = $profile->fetchData($post["userID"]);
    if(isset($post["postID"])){
        $articleInteraction = $postInteraction;
        $articleType = "post";
    }
    elseif(isset($post["commentID"])){
        $articleInteraction = $commentInteraction;
        $articleType = "comment";
    }
    $checkLike = $articleInteraction->checkLike($_SESSION["userID"], $post[$articleType."ID"]);
    $fetchLike = $articleInteraction->fetchLike($post[$articleType."ID"]);
    $checkRepost = $articleInteraction->checkRepost($_SESSION["userID"], $post[$articleType."ID"]);
    $fetchRepost = $articleInteraction->fetchRepost($post[$articleType."ID"]);
    $fetchComment = $article->fetchByCommented($post[$articleType."ID"], $articleType);
    $checkComment = $article->checkCommented($post[$articleType."ID"], $_SESSION["userID"], $articleType);
    ?>
        <article class="post padding-15 padding-equal border-bottom" onclick="location.href='article.php?<?php echo $articleType?>=<?php echo $post[$articleType."ID"]?>';">
        <aside class="margin-right-10">
            <img class="profile-picture-50" src="profiles/profile-picture/default.png" alt="">
            </aside>
            <main class="width-100">
                <a href="profile.php?username=<?php
                    echo $postUser["username"];
                ?>">
                    <span class="title-s hover-underline"><?php
                    echo $postProfile["name"];
                    ?></span>
                    <span class="subtitle-xs">@<?php
                    echo $postUser["username"];
                    ?></span>
                    <span class="subtitle-xs">·</span>
                    <span class="subtitle-xs"><?php
                    echo $time->timeAgo($post["dateCreated"]);
                    ?></span>
                </a>
                <article>
                    <?php
                    echo $post["content"];
                    ?>
                </article>
                
                <footer class="width-100 post-btns margin-top-6">
                    <a class="btn-count" href="">
                        <?php
                        if($checkComment > 0){
                            ?>
                            <i class="fas fa-comment icon-hover-s commented"></i>
                            <?php
                        }
                        else{
                            ?>
                            <i class="far fa-comment icon-hover-s"></i>
                            <?php
                        }
                        ?>
                        <?php
                        if(count($fetchComment) > 0){
                        ?>
                        <p class="subtitle-m <?php
                        if($checkComment > 0){
                            echo "commented";
                        }
                        ?>">
                        <?php
                        echo count($fetchComment);
                        ?>
                        </p>
                        <?php
                        }
                        ?>
                    </a>
                    <form class="btn-count"action="inc/repost-<?php
                    echo($articleType);
                    ?>.php" method="POST">
                        <input type="hidden" name="posterID" value="<?php
                        echo $postUser["userID"];
                        ?>">
                        <input type="hidden" name="postID" value="<?php
                        echo $post[$articleType."ID"];
                        ?>">
                        <?php
                        if($checkRepost > 0){
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
                        if(count($fetchRepost) > 0){
                        ?>
                        <p class="subtitle-m <?php
                        if($checkRepost > 0){
                            echo "reposted";
                        }
                        ?>">
                        <?php
                        echo count($fetchRepost);
                        ?>
                        </p>
                        <?php
                        }
                        ?>
                    </form>  
                    <form class="btn-count" action="inc/like-<?php
                    echo($articleType);
                    ?>.php" method="POST">
                        <input type="hidden" name="posterID" value="<?php
                        echo $postUser["userID"];
                        ?>">
                        <input type="hidden" name="postID" value="<?php
                        echo $post[$articleType."ID"];
                        ?>">
                        <?php
                        if($checkLike > 0){
                            ?>
                            <button name="unsubmit" type="submit">
                                <i class="fas fa-heart like icon-hover-s liked"></i>
                            </button>
                            <?php
                        }
                        else{
                            ?>
                            <button name="submit" type="submit">
                                <i class="far fa-heart like icon-hover-s"></i>
                            </button>
                            <?php
                        }
                        if(count($fetchLike)){
                        ?>
                            <p class="subtitle-m <?php
                            if($checkLike > 0){
                                echo "liked";
                            }
                            ?>">
                            <?php
                            echo count($fetchLike);
                            ?>
                            </p>
                        <?php
                        }
                        ?>
                    </form>
                    <i class="fas fa-ellipsis-h icon-hover-s"></i>
                </footer>
            </main>
        </article>
    <?php
}
?>