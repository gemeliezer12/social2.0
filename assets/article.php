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
        $articleType = "post";
        $articleID = "postID";
    }
    elseif(isset($post["commentID"])){
        $articleType = "comment";
        $articleID = "commentID";
    }
    $checkLike = $articleInteraction->checkLike($_SESSION["userID"], $post[$articleID], $articleType);
    $fetchLike = $articleInteraction->fetchLike($post[$articleID], $articleType);
    $checkRepost = $articleInteraction->checkRepost($_SESSION["userID"], $post[$articleID], $articleType);
    $fetchRepost = $articleInteraction->fetchRepost($post[$articleID], $articleType);
    $fetchComment = $article->fetchByCommented($post[$articleID], $articleType);
    $checkComment = $article->checkCommented($post[$articleID], $_SESSION["userID"], $articleType);
    ?>
    <script>
        $(document).ready(function(){
            setInterval(function(){
                $(".ajax-loader").load("ajax/fetch-like.php",{
                    articleID: <?php echo $post[$articleID]?>,
                    type: "<?php echo $articleType?>"
                });
            }, 200);
            $("#like-input-<?php
            echo $articleType;
            echo $post[$articleID]
                ?>").click(function(){
                    
                    $(".like-loader").load("inc/like.php",{
                    articleID: <?php echo $post[$articleID]?>,
                    posterID: "<?php echo $post["userID"]?>",
                    submit: $(this).children("button").attr("name"),
                    type: "<?php
                    echo $articleType;
                    ?>"
                });
            })
            $("#repost-input-<?php
            echo $articleType;
            echo $post[$articleID]
                ?>").click(function(){
                    
                    $(".repost-loader").load("inc/repost.php",{
                    articleID: <?php echo $post[$articleID]?>,
                    posterID: "<?php echo $post["userID"]?>",
                    submit: $(this).children("button").attr("name"),
                    type: "<?php
                    echo $articleType;
                    ?>"
                });
            })
        })
    </script>
        <article class="post padding-15 padding-equal border-bottom" >
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
                    <div id="repost-input-<?php
                    echo $articleType;
                    echo $post[$articleID]
                    ?>" class="btn-count">
                        <?php
                        if($checkRepost > 0){
                            ?>
                            <button  name="unsubmit" type="submit">
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
                        <p id="repost-count-<?php
                        echo $articleType;
                        echo $post[$articleID];
                        ?>" class="subtitle-m <?php
                        if($checkRepost > 0){
                            echo "reposted";
                        }
                        if(count($fetchRepost) <= 0){
                            echo "hidden";
                        }
                        ?>">
                        <?php
                        echo count($fetchRepost);
                        ?>
                        </p>
                    </div>  
                    <div  id="like-input-<?php
                    echo $articleType;
                    echo $post[$articleID]
                    ?>" class="btn-count">
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
                        ?>
                        <p id="like-count-<?php
                        echo $articleType;
                        echo $post[$articleID];
                        ?>" class="subtitle-m <?php
                        if(count($fetchLike) <= 0){
                            echo "hidden";
                        }
                        if($checkLike > 0){
                            echo "liked";
                        }
                        ?>">
                        <?php
                        echo count($fetchLike);
                        ?>
                        </p>
                    </div>
                    <i class="fas fa-ellipsis-h icon-hover-s"></i>
                </footer>
            </main>
        </article>
    <?php
}
?>
<div class="ajax-loader"></div>
<div class="like-loader"></div>
<div class="repost-loader"></div>