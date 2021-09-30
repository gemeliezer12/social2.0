<?php
include "assets/header.php";
if(!isset($_SESSION["username"])){
    header("Location: index.php");
}
?>
<body>
    <div class="body-400 border-if">

        <?php
        include "assets/sidebar.php";
        ?>
        <main class="sidebar-margin-left main-body" style="">
            <header class="main-header padding-15 border-bottom">
                <a class="width-100 height-100" href="home.php">
                    <p class="title-20">
                        Home
                    </p>    
                </a>
            </header>
            <div class="header-margin-top"></div>
            <form class="padding-15 post padding-equal border-bottom" action="inc/post.php" method="POST">
                <aside class="side-profile margin-right-10">
                    <img onerror="this.onerror=null; this.src='profiles/profile-picture/default.png'" class="profile-picture-50" src="<?php
                    echo $profilePictureDestination;
                    echo $selfProfileData["profilePicture"];
                    ?>" alt="">
                </aside>
                <main class="form width-100">
                    <textarea name="content" placeholder="What's happening?"></textarea>
                    <footer class="post-options width-100">
                        <div></div>
                        <input class="btn-m btn-c" type="submit" name="submit" value="Post">
                    </footer>
                </main>
            </form>
            <div class="space"></div>
            <?php
            if(!empty($implodeFollowing)){
                $query = $pdo->prepare(
                "SELECT 'repostPost' as type, p.userID, postID as articleID, p.content, r.dateCreated FROM posts p JOIN reposts r ON p.postID=r.repostedPost WHERE r.userID in ($implodeFollowing) AND p.userID NOT IN ($implodeFollowing) AND p.userID!=?
                UNION 
                SELECT 'repostComment' as type, c.userID, commentID as articleID, c.content, r.dateCreated FROM comments c JOIN reposts r ON c.commentID=r.repostedComment WHERE r.userID in ($implodeFollowing) AND c.userID NOT IN ($implodeFollowing) AND c.userID!=?
                UNION
                SELECT 'post' as type, p.userID, postID, p.content, p.dateCreated FROM posts p WHERE p.userID IN ($implodeFollowing) AND p.userID!=?"
                );
                $query->bindValue(1, $_SESSION["userID"]);
                $query->bindValue(2, $_SESSION["userID"]);
                $query->bindValue(3, $_SESSION["userID"]);
                $query->execute();
                foreach($query->fetchAll() as $result){
                    array_push($postArray, $result);
                }
            }
            ?>
            <main class="posts">
                <?php
                include "assets/article.php";
                ?>
            </main>
        </main>
    </div>
</body>
</html>