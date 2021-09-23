<?php
include "assets/header.php";
if(!isset($_SESSION["username"])){
    header("Location: index.php");
}
?>
<body>
    <nav class="sidebar">
        <div class="icon-links">
            <i onclick="location.href='home.php';" class="fab fa-twitter icon-hover-m current"></i>
            <i onclick="location.href='home.php';" class="fas fa-home icon-hover-m current"></i>
            <i onclick="location.href='search.php';" class="fas fa-search icon-hover-m"></i>
            <i onclick="location.href='notif.php';" class="far fa-bell icon-hover-m"></i>
            <i onclick="location.href='message.php';" class="far fa-envelope icon-hover-m"></i>
            <i onclick="location.href='profile.php?username=<?php
            echo $_SESSION["username"];
            ?>';" class="far fa-user icon-hover-m"></i>
            <i class="fas fa-cog icon-hover-m"></i>
        </div>
        <div>
            <img class="profile-picture-50" src="profiles/profile-picture/default.png" alt="">
        </div>
    </nav>

    <main class="sidebar-margin-left main-body" style="">
        <header class="main-header padding-15 border-bottom">
            <a class="width-100 height-100" href="home.php">
                <p class="title-l">
                    Home
                </p>    
            </a>
        </header>
        <div class="header-margin-top"></div>
        <form class="padding-15 post padding-equal border-bottom" action="inc/post.php" method="POST">
            <aside class="side-profile margin-right-10">
                <img class="profile-picture-50" src="profiles/profile-picture/default.png" alt="">
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
        $postArray = array();
        foreach($selfFollowings as $selfFollowing){
            $followingPosts = $article->fetchByUser($selfFollowing["followingID"], "post");
            foreach($followingPosts as $followingPost){
                array_push($postArray, $followingPost);
            }
        }
        $selfPosts = $article->fetchByUser($_SESSION["userID"], "post");
        foreach($selfPosts as $selfPost){
            array_push($postArray, $selfPost);
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