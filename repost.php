<?php
include "assets/header.php";
if(isset($_GET["post"])){
    $articleType = "post";
}
elseif(isset($_GET["comment"])){
    $articleType = "comment";
}
$reposters = $articleInteraction->fetchRepost($_GET[$articleType], $articleType);
?>
<body>
    <?php
        include "assets/sidebar.php";
    ?>

    <main class="sidebar-margin-left main-body">
        <header class="main-header padding-15 border-bottom">
            <i class="fas fa-arrow-left icon-hover-s current margin-right-15" onclick="window.history.go(-1); return false;"></i>
            <div>
                <p class="title-m">Reposted by</p>
            </div>
        </header>
        <div class="header-margin-top"></div>
        <?php
            $userIDs = array();
            foreach($reposters as $reposter){
                array_push($userIDs, $reposter["postedID"]);
            }
            include "assets/profile.php";
        ?>
    </main>
</body>
</html>