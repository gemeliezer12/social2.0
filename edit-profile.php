<?php
include "assets/header.php";

?>
<body class="edit-profile">
    <form class="main-body" action="inc/edit-profile.php" method="POST">
        <header class="padding-15 main-header width-100">
            <i class="icon-hover-s fas fa-arrow-left current" onclick="window.history.go(-1); return false;"></i>
            <input class="btn-m btn-c" name="submit" type="submit" value="submit">
        </header>
        <div class="header-margin-top"></div>
        <div class="aspect-3x1" style="background: red;">
            <img src="profiles/cover/default.png" alt="">
        </div>
        <div class="padding-15">
            <div class="profile-picture-header">
                <div class="aspect-1x1" style="position: relative;">
                    <img src="profiles/profile-picture/default.png" alt="">
                    <i class="fas fa-camera icon-hover-s-neutral">
                        <input style="
                        position: absolute;
                        height: 100%;
                        width: 100%;
                        left: 0;
                        top: 0;
                        opacity: 0;
                        " type="file">
                    </i>
                </div>
            </div>
            <div class="input-lbl">
                <label for="name">Name</label>
                <input name="name" type="input" value="<?php
                echo $selfProfileData["name"];
                ?>">
            </div>
            <div class="input-lbl">
                <label for="bio">Bio</label>
                <textarea name="bio" type="input"><?php
                echo $selfProfileData["bio"];
                ?></textarea>
            </div>
            <div class="input-lbl">
                <label for="website">Website</label>
                <input name="website" type="input" value="<?php
                echo $selfProfileData["website"];
                ?>">
            </div>
        </div>
    </form>
</body>
</html>