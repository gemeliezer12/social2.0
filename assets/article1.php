<?php
$dateCreatedArray= array();
foreach($postArray as $post){;
    if(isset($post[4])){
        array_push($dateCreatedArray, $post["4"]["dateCreated"]);
    }
    else{
        array_push($dateCreatedArray, $post["dateCreated"]);
    }
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
    if(isset($post["4"])){
        $repostID = "repost-".$post["4"]["repostID"];
        $likeID = "like-".$post["4"]["repostID"];
    }
    $checkLike = $like->checkLike($_SESSION["userID"], $post[$articleID], $articleType);
    $fetchLike = $like->fetchLike($post[$articleID], $articleType);
    $checkRepost = $article->checkReposted($post[$articleID], $_SESSION["userID"], $articleType);
    $fetchRepost = $article->fetchByReposted($post[$articleID], $articleType);
    $fetchComment = $article->fetchByCommented($post[$articleID], $articleType);
    $checkComment = $article->checkCommented($post[$articleID], $_SESSION["userID"], $articleType);
    ?>
    <script>
        $(document).ready(function(){
            // Updates the like and repost count every 5 seconds
            setInterval(function(){
                $(".ajax-loader").load("ajax/fetch-like.php",{
                    articleID: <?php echo $post[$articleID]?>,
                    type: "<?php echo $articleType?>"
                });
            }, 5000);
            // Like and repost without reloading using AJAX and JQUERY
            $(".like-input-<?php
            echo $articleType;
            echo $post[$articleID];
            if(isset($post["4"])){
                echo " ";
                echo $likeID;

            }
            ?>").click(function(){    
                $(".like-loader").load("inc/like.php",{
                articleID: <?php echo $post[$articleID]?>,
                posterID: "<?php echo $post["userID"]?>",
                submit: $(this).attr("name"),
                type: "<?php
                echo $articleType;
                ?>"
                });
            })
            $(".repost-input-<?php
            echo $articleType;
            echo $post[$articleID];
            if(isset($post["4"])){
                echo "#";
                echo $repostID;

            }?> ").click(function(){
                
                $(".repost-loader").load("inc/repost.php",{
                articleID: <?php echo $post[$articleID]?>,
                posterID: "<?php echo $post["userID"]?>",
                submit: $(this).attr("name"),
                type: "<?php
                echo $articleType;
                ?>"
                });
            })
            // Links to the main post page except when Like or Repost is click
            $(".<?php
            echo $articleType;
            echo "-link";
            echo $post[$articleID];
            ?>").click(function(e){
                if(!$(e.target).hasClass("dont-link")){
                    window.location.href = "http://localhost/social2.0/article.php?<?php echo $articleType?>=<?php echo $post[$articleID]?>";
                }
            })
        })
    </script>
        <article class="cursor-pointer padding-15 padding-equal border-bottom hover-base-4 <?php
        echo $articleType;
        echo "-link";
        echo $post[$articleID];
        ?>" >
        <?php
        if(isset($post[4])){
            ?>
            <div class="flex margin-bottom-6">
                <div class="margin-right-10" style="width: 50px; display: flex; justify-content: flex-end">
                    <i class="fa fa-retweet subtitle-m"></i>
                </div>
                <div class="hover-underline subtitle-xs">
                    <span class="subtitle-xs"><?php
                    echo $postProfile["name"];
                    ?></span>
                    <span class="subtitle-xs">retweeted</span>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="flex">
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
                        <a class="btn-count comment-parent">
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
                        
                        <button class="btn-count repost-parent repost-input-<?php
                        echo $articleType;
                        echo $post[$articleID];
                        if(isset($post["4"])){
                            echo " ";
                            echo $repostID;

                        }?>" name="<?php
                        if($checkRepost > 0){
                            echo "unsubmit";
                        }
                        else{
                            echo "submit";
                        }
                        ?>">
                            <i class="fa-retweet icon-hover-s  dont-link <?php
                            if($checkRepost > 0){
                                echo "fas reposted";
                            }
                            else{
                                echo "fa";
                            }
                            ?>"></i>
                            <p class="subtitle-m  dont-link repost-count-<?php
                            echo $articleType;
                            echo $post[$articleID];
                            ?><?php
                            if($checkRepost > 0){
                                echo " reposted";
                            }
                            ?>"><?php
                            if(count($fetchRepost)){
                                echo count($fetchRepost);
                            }
                            ?></p>
                        </button>
                        <button class="btn-count like-parent like-input-<?php
                        echo $articleType;
                        echo $post[$articleID];
                        if(isset($post["4"])){
                            echo " ";
                            echo $likeID;

                        }?>" name="<?php
                        if($checkLike > 0){
                            echo "unsubmit";
                        }
                        else{
                            echo "submit";
                        }
                        ?>">
                            <i class="fa-heart icon-hover-s  dont-link <?php
                            if($checkLike > 0){
                                echo "fas liked";
                            }
                            else{
                                echo "far";
                            }
                            ?>"></i>
                            <p class="subtitle-m  dont-link like-count-<?php
                            echo $articleType;
                            echo $post[$articleID];
                            ?><?php
                            if($checkLike > 0){
                                echo " liked";
                            }
                            
                            ?>"><?php
                            if(count($fetchLike)){
                                echo count($fetchLike);
                            }
                            ?></p>
                        </button>
                        <i class="fas fa-ellipsis-h icon-hover-s"></i>
                    </footer>
                </main>
            </div>
        </article>
    <?php
}
?>
<div class="ajax-loader"></div>
<div class="like-loader"></div>
<div class="repost-loader"></div>