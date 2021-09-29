<?php
include "assets/header.php";
if(isset($_GET["post"])){
    $likers = $like->fetchLike($_GET["post"], "post");
}
elseif(isset($_GET["comment"])){
    $likers = $like->fetchLike($_GET["comment"], "comment");
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
                <p class="title-18">Liked by</p>
            </div>
        </header>
        <div class="header-margin-top"></div>
        <?php
            $userIDs = array();
            foreach($likers as $liker){
                array_push($userIDs, $liker["userID"]);
            }
            include "assets/profile.php";
        ?>
    </main>
</body>
</html>