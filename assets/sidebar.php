<script>
    $(function () {
        var url = window.location.pathname;
        switch(url){
            case "/social2.0/home.php":
                $('.fa-home').addClass('current');
                break;
            case "/social2.0/search.php":
                $('.fa-search').addClass('current');
                break;
            case "/social2.0/profile.php":
                $('.fa-user').addClass('current');
                break;
        }
    });
</script>

<nav class="sidebar padding-top padding-bottom-15 z-30">
    <div class="icon-links">
        <?php
        if(isset($_SESSION["userID"])){
            ?>
            <i onclick="location.href='home.php';" class="fab fa-twitter icon-hover-m current margin-bottom-10"></i>
            <i onclick="location.href='home.php';" class="fas fa-home icon-hover-m margin-bottom-10"></i>
            <i onclick="location.href='search.php';" class="fas fa-search icon-hover-m margin-bottom-10"></i>
            <i onclick="location.href='notif.php';" class="far fa-bell icon-hover-m margin-bottom-10"></i>
            <i onclick="location.href='message.php';" class="far fa-envelope icon-hover-m margin-bottom-10"></i>
            <i onclick="location.href='profile.php?username=<?php
            echo $_SESSION["username"];
            ?>';" class="far fa-user icon-hover-m margin-bottom-10"></i>
            <i class="fas fa-cog icon-hover-m margin-bottom-10"></i>
            <?php
        }
        else{
            ?>
            <i onclick="location.href='home.php';" class="fab fa-twitter icon-hover-m current"></i>
            <i onclick="location.href='search.php';" class="fas fa-search icon-hover-m"></i>
            <?php
        }
        
        ?>
        
    </div>
    <?php
    if(isset($_SESSION["username"])){
        ?>
        <div class="profile-options">
            <div class="border-all-base radius-20 padding-top-15 padding-bottom-15 hide" id="profile-option">
                <div class="padding-15 padding-y-10 border-bottom cursor-pointer flex hover-base-02" href="profile.php?username=<?php
                echo $_SESSION["username"];
                ?>">
                    <img class="profile-picture-50 margin-right-10" onerror="this.onerror=null; this.src='profiles/profile-picture/default.png'" class="profile-picture-50" src="<?php
                    echo $profilePictureDestination;
                    echo $selfProfileData["profilePicture"];
                    ?>" alt="">
                    <div  class="space-between align-center width-100">
                        <div> 
                            <p class="title-18"><?php
                            echo $selfProfileData["name"];
                            ?></p>
                            <p class="subtitle-14">@<?php
                            echo $_SESSION["username"]
                            ?></p>
                        </div>
                        <i class="fas fa-check current fs-20"></i>
                    </div>
                </div>
                <form class="padding-15 padding-y-15 cursor-pointer hover-base-02 border-bottom">
                    <p class="title-16">Manage your account</p>
                </form>
                <form class="padding-15 padding-y-15 cursor-pointer hover-base-02" action="inc/logout.php" method="POST">
                    <input class="title-16" type="submit" value="Log out @<?php
                    echo $_SESSION["username"];
                    ?>">
                </form>
            </div>
            <img class="profile-picture-50" id="profile-btn" onerror="this.onerror=null; this.src='profiles/profile-picture/default.png'" class="profile-picture-50" src="<?php
            echo $profilePictureDestination;
            echo $selfProfileData["profilePicture"];
            ?>" alt="">
        </div>
        <?php
    }
    else{
    }
    ?>
    
</nav>