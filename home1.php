<?php
include "assets/header.php";
if(!isset($_SESSION["username"])){
    header("Location: index.php");
}
?>
<body>
    <?php
    include "assets/sidebar.php";
    ?>
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
        $r = array();
        foreach($selfFollowings as $result){
            array_push($r, $result["followingID"]);
        }
        $r = implode(",", $r);

        $query = $pdo->prepare("SELECT * FROM posts
        WHERE userID IN ($r) ORDER BY dateCreated DESC LIMIT 1");
        $query->execute();

        $result = $query->fetch();
        array_push($postArray, $result);
        $postLimit = array($result["postID"]);
        $postTime = array($result["dateCreated"]);
        for($i = 0; $i < 10; $i++){
            $query = $pdo->prepare("SELECT * FROM posts
            WHERE userID IN ($r) AND postID!=? AND dateCreated<=? ORDER BY dateCreated DESC LIMIT 1");
            $query->bindValue(1, $postLimit[0]);
            $query->bindValue(2, $postTime[0]);
            $query->execute();
            $result = $query->fetch();
            if(!empty($result)){
                $postLimit[0] = $result["postID"];
                $postTime[0] = $result["dateCreated"];
                array_push($postArray, $result);
            }
        }

        $repostID = array();
        $query = $pdo->prepare("SELECT * FROM reposts WHERE userID IN ($r) AND dateCreated>=?");
        $query->bindValue(1, $postTime[0]);
        $query->execute();
        $results = $query->fetchAll();
        
        foreach($results as $result){
            array_push($repostID, $result["repostedPost"]);
        }

        $repostID = array_unique($repostID);
        print_r($repostID);

        foreach($repostID as $result){
            $query = $pdo->prepare("SELECT * FROM posts WHERE postID=?");
            $query->bindValue(1, $result);
            $query->execute();
            $results = $query->fetch();
            $query = $pdo->prepare("SELECT * FROM reposts WHERE repostedPost=? AND userID in ($r) ORDER BY dateCreated DESC LIMIT 1");
            $query->bindValue(1, $result);
            $query->execute();
            array_push($results, $query->fetch());

            array_push($postArray, $results);
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