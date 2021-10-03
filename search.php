<?php
include "assets/header.php";
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
    <div class="body-400 border-if">

        <?php
            include "assets/sidebar.php";
        ?>
    
        <main class="sidebar-margin-left main-body" style="">
            <header class="main-header padding-15 border-bottom cursor-default">
                <form action="inc/search.php" method="GET" autocomplete="off" class="padding-15 border-all width-100 flex margin-right-15">
                    <i class="fas fa-search icon-s current margin-right-15"></i>
                    <input name="search" class="title-16 width-100 flex" type="input" placeholder="Search">
                </form>
                <i class="fas fa-cog icon-hover-s current"></i>
            </header>
            <div class="header-margin-top"></div>
            <?php
            if(count($userIDs)){
                ?>
                <header class="border-bottom padding-y-10 padding-15">
                    <p class="title-20">People</p>
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
            include "assets/article.php";
            ?>
        </main>
        <div style="height: 100vh;"></div>
    </div>
</body>
</html>