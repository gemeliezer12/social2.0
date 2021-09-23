<?php
include "assets/header.php";
if(isset($_GET["post"])){
    $likers = $postInteraction->fetchRepost($_GET["post"]);
}
elseif(isset($_GET["comment"])){
    $likers = $commentInteraction->fetchRepost($_GET["comment"]);
}
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
            foreach($likers as $liker){
                array_push($userIDs, $liker["postedID"]);
            }
            include "assets/profile.php";
        ?>
    </main>
</body>
</html>