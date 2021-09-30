<?php
include "assets/header.php";
?>
<script>
    $(document).ready(function(){
        imgInp.onchange = evt => {
            const [file] = imgInp.files;
            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        }
        console.log(preview.src);
    })
</script>
<body class="edit-profile">
    <div class="body-400">
        <form class="main-body" action="inc/edit-profile.php" enctype="multipart/form-data" method="POST">
            <header class="padding-15 main-header width-100">
                <i class="icon-hover-s fas fa-arrow-left current" onclick="window.history.go(-1); return false;"></i>
                <input class="btn-m btn-c" name="submit" type="submit" value="Save">
            </header>
            <div class="header-margin-top"></div>
            <div class="aspect-3x1" style="background: red;">
                <img class="dim" src="profiles/cover/default.png" alt="">
            </div>
            <div class="padding-15">
                <div class="profile-picture-header">
                    <div class="aspect-1x1">
                        <img class="dim" id="preview" onerror="this.onerror=null; this.src='profiles/profile-picture/default.png'" class="profile-picture-50" src="<?php
                        echo $profilePictureDestination;
                        echo $selfProfileData["profilePicture"];
                        ?>" alt="">
                        <i class="fas fa-camera icon-hover-s-neutral">
                            <input class="middle" name="profile-picture" accept="image/jpeg,image/png,image/webp,image/gif,video/mp4,video/quicktime,video/webm"  id="imgInp" type="file">
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
        </div>
    </form>
    <div>
        <img src="profiles/profile-picture/<?php
        echo $selfProfileData["profilePicture"];
        ?>" alt="">
    </div>
    <div>
        
    </div>
</body>
</html>