<?php
include "assets/header.php";
if(!isset($_SESSION["username"])){
    header("Location: index.php");
}
$userIDs = array();
$postArray = array();
if(isset($_GET["search"])){
    $userSearch = $search->user($_GET["search"]);
    foreach($userSearch as $result){
        array_push($userIDs, $result["userID"]);
    }
    $postSearch = $search->post($_GET["search"]);
    foreach($postSearch as $result){
        array_push($postArray, $result);
    }
}
?>
<body>
    <nav class="sidebar">
        <div class="icon-links">
            <i onclick="location.href='home.php';" class="fab fa-twitter icon-hover-m current"></i>
            <i onclick="location.href='home.php';" class="fas fa-home icon-hover-m"></i>
            <i onclick="location.href='search.php';" class="fas fa-search icon-hover-m current"></i>
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
        <header class="main-header padding-15 border-bottom cursor-default">
            <form action="inc/search.php" method="GET" autocomplete="off" class="padding-15 border-all width-100 flex margin-right-15">
                <i class="fas fa-search icon-s current margin-right-15"></i>
                <input name="search" class="title-s width-100 flex" type="input" placeholder="Search">
            </form>
            <i class="fas fa-cog icon-hover-s current"></i>
        </header>
        <div class="header-margin-top"></div>
        <?php
        if(count($userIDs)){
            ?>
            <header class="border-bottom padding-y-10 padding-15">
                <p class="title-l">People</p>
            </header>
            <?php
            include "assets/profile.php";
        }
        ?>
        <?php
        if(count($userIDs) AND count($postArray)){
            ?>
            <div class="space"></div>
            <?php
        }
        ?>
        <?php
        include "assets/post.php";
        ?>
    </main>
</body>
</html>