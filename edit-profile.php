<?php
include "assets/header.php";
?>
</script>
<body class="edit-profile relative">
    <div class="body-400">
        <form class="main-body" action="inc/edit-profile.php" enctype="multipart/form-data" method="POST">
            <header class="padding-15 main-header width-100">
                <div class="align-center">
                    <i class="icon-hover-s fas fa-arrow-left current" onclick="window.history.go(-1); return false;"></i>
                    <p class="title-20 margin-left-15">Edit Profile</p>
                </div>
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
                            <input class="middle" name="profile-picture" accept="image/jpeg,image/png,image/webp,image/gif,video/mp4,video/quicktime,video/webm"  id="images" type="file" onclick="this.value=null;">
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
        <div class="croppie-con hidden z-30 radius-20">
            <header class="space-between height-54 align-center padding-15">
                    <div class="align-center">
                        <i class="icon-hover-s fas fa-arrow-left current add-hide"></i>
                        <p class="title-20 margin-left-15">Edit media</p>
                    </div>
                <button class="upload-result btn-m btn-c btn btn-success crop_image">Apply</button>
            </header>
            <div class="row">
                <div class="col-md-4">
                    <div id="upload-image"></div>
                </div>
            </div>
            <script>
                $image_crop = $('#upload-image').croppie({
                    enableExif: true,
                    viewport: {
                        width: 200,
                        height: 200,
                        type: 'square'
                    },
                    boundary: {
                        width: 300,
                        height: 300
                    }
                });
                $('#images').on('change', function () {
                    console.log($("#preview").attr("src"));
                    $(".croppie-con").removeClass("hidden");
                    $(".opacity-lower").removeClass("hidden");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $image_crop.croppie('bind', {
                            url: e.target.result
                        }).then(function(){
                            console.log('jQuery bind complete');
                        });
                    }
                    reader.readAsDataURL(this.files[0]);
                });
                $('.crop_image').on('click', function (ev) {	
                    $image_crop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function (response) {
                        $.ajax({
                            type:'POST',				 
                            data: { image:response },
                            url: "inc/edit-profile.php",
                            success: function (data) {					
                                $("#preview").attr("src", response);
                            }
                        });
                    });
                });
                $(".add-hide").click(function(){
                    $(".croppie-con").addClass("hidden");
                    $(".opacity-lower").addClass("hidden");
                })
            </script>
        </div>
    </form>
    <link rel="stylesheet" href="assets/lib/croppie.css">
    <link rel="stylesheet" href="assets/lib/croppie.js">
    <div class="opacity-lower hidden"></div>
</body>
</html>