<script>
    <?php
    include "../inc/dbh.php";
    include "../class/user.php";
    $user = new User;
    include "../class/profile.php";
    $profile = new Profile;
    include "../class/like.php";
    $like = new Like;
    include "../class/article.php";
    $article = new Article;
    include "../class/time.php";
    $time = new time;

    $selfID = $_SESSION["userID"];
    $dateLimit = $_POST["dateLimit"];
    $articleLimit = $_POST["articleLimit"];
    $typeLimit = $_POST["typeLimit"];
    $implodeFollowing = $_POST["implodeFollowing"];
    $query = $pdo->prepare(
        "SELECT 'repostPost' as type, p.userID, postID as articleID, p.content, r.dateCreated as dateCreated FROM posts p
        JOIN reposts r ON p.postID=r.repostedPost
        WHERE r.userID in ($implodeFollowing) AND p.userID NOT IN ($implodeFollowing) AND p.userID!=? AND p.postID!=? AND r.dateCreated<=? 
        GROUP BY postID
        UNION SELECT 'repostComment' as type, c.userID, commentID as articleID, c.content, r.dateCreated as dateCreated FROM comments c
        JOIN reposts r ON c.commentID=r.repostedComment WHERE r.userID in ($implodeFollowing) AND c.userID NOT IN ($implodeFollowing) AND c.userID!=? AND c.commentID!=? AND r.dateCreated<=?
        GROUP BY commentID
        UNION
        SELECT 'post' as type, p.userID, postID, p.content, p.dateCreated as dateCreated FROM posts p
        WHERE p.userID IN ($implodeFollowing) AND p.userID!=? AND p.postID!=? AND p.dateCreated<=?
        ORDER BY dateCreated DESC LIMIT 4;"
    );
    $query->bindValue(1, $_SESSION["userID"]);
    $query->bindValue(2, $articleLimit);
    $query->bindValue(3, $dateLimit);
    $query->bindValue(4, $_SESSION["userID"]);
    $query->bindValue(5, $articleLimit);
    $query->bindValue(6, $dateLimit);
    $query->bindValue(7, $_SESSION["userID"]);
    $query->bindValue(8, $articleLimit);
    $query->bindValue(9, $dateLimit);
    $query->execute();

    $result = $query->fetchAll();
    ?>
</script>
<?php
echo $articleLimit;
for($i = 0; $i < count($result); $i++){
    $post = $result[$i];
    if($post["type"] == "post"){
        $articleType = "post";
        
    }
    elseif($post["type"] == "comment"){
        $articleType = "comment";
    }
    else{
        if($post["type"] == "repostPost"){
            $articleType = "post";
            
        }
        elseif($post["type"] == "repostComment"){
            $articleType = "comment";
        }
        if(isset($_GET["username"])){
            $reposter = $article->fetchReposter($post["articleID"] , $userData["userID"], $article);
        }
        else{
            $reposter = $article->fetchReposter($post["articleID"], $implodeFollowing, $article);
        }
        $repostUser = $user->fetchData($reposter["userID"]);
        $repostProfile = $profile->fetchData($reposter["userID"]);
        $actualPost = $article->fetchByArticle($post["articleID"], $articleType);
    }
    $postUser = $user->fetchData($post["userID"]);
    $postProfile = $profile->fetchData($post["userID"]);
    $fetchLike = $like->fetchLike($post["articleID"], $articleType);
    $fetchRepost = $article->fetchByReposted($post["articleID"], $articleType);
    $fetchComment = $article->fetchByCommented($post["articleID"], $articleType);
    if(isset($_SESSION["username"])){
        $checkLike = $like->checkLike($_SESSION["userID"], $post["articleID"], $articleType);
        $checkRepost = $article->checkReposted($post["articleID"], $_SESSION["userID"], $articleType);
        $checkComment = $article->checkCommented($post["articleID"], $_SESSION["userID"], $articleType);
    }
    ?>
    <script>
    $(document).ready(function(){
        // Updates the like and repost count every 5 seconds
        setInterval(function(){
            $(".ajax-loader").load("ajax/fetch-like.php",{
                articleID: <?php echo $post["articleID"]?>,
                type: "<?php echo $articleType?>"
            });
        }, 5000);
        // Links to the main post page except when Like or Repost is click
        
    })
    </script>
        <article class="cursor-pointer padding-15 padding-equal border-bottom hover-base-4 article-link" id="<?php
        echo $articleType;
        echo "-";
        echo $post["articleID"];
        ?>">
        <?php
        if($post["type"] == "repostPost" || $post == "repostComment"){
            ?>
            <div class="flex margin-bottom-6">
                <div class="margin-right-10" style="width: 50px; display: flex; justify-content: flex-end">
                    <i class="fa fa-retweet subtitle-18"></i>
                </div>
                <a href="profile.php?username=<?php
                echo $repostUser["username"];
                ?>" class="hover-underline subtitle-14">
                    <span class="subtitle-14"><?php
                    echo $repostProfile["name"];
                    ?></span>
                    <span class="subtitle-14">retweeted</span>
                </a>
            </div>
            <?php
        }
        ?>
        <div class="flex">
            <aside class="margin-right-10">
                <img class="profile-picture-50" onerror="this.onerror=null; this.src='profiles/profile-picture/default.png'" class="profile-picture-50" src="<?php
                    echo $profilePictureDestination;
                    echo $postProfile["profilePicture"];
                    ?>" alt="">
                </aside>
                <main class="width-100">
                    <a href="profile.php?username=<?php
                        echo $postUser["username"];
                    ?>">
                        <span class="title-16 hover-underline"><?php
                        echo $postProfile["name"];
                        ?></span>
                        <span class="subtitle-14">@<?php
                        echo $postUser["username"];
                        ?></span>
                        <span class="subtitle-14">·</span>
                        <span class="subtitle-14"><?php
                        if($post["type"] == "repostPost" || $post["type"] == "repostComment"){
                            echo $time->timeAgo($actualPost["dateCreated"]);
                        }
                        else{
                            echo $time->timeAgo($post["dateCreated"]);
                        }
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
                            if(isset($_SESSION["username"])){
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
                                if(count($fetchComment) > 0){
                                ?>
                                    <p class="subtitle-18 <?php
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
                            }
                            else{
                                ?>
                                <i class="far fa-comment icon-hover-s"></i>
                                <p class="subtitle-18 <?php
                                if(count($fetchComment) <= 0){
                                    echo "hidden";
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
                        echo $post["articleID"];
                        ?>" name="<?php
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
                            <p class="subtitle-18  dont-link repost-count-<?php
                            echo $articleType;
                            echo $post["articleID"];
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
                        echo $post["articleID"];
                        ?>" name="<?php
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
                            <p class="subtitle-18  dont-link like-count-<?php
                            echo $articleType;
                            echo $post["articleID"];
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
                        <input type="hidden" class="article" id="<?php
                        echo $articleType;
                        ?>" value="<?php
                        echo $post["articleID"];
                        ?>">
                    </footer>
                </main>
            </div>
        </article>
        <?php
}