<main class="profile-list">
    <?php
    foreach($userIDs as $userID){
        $userData = $user->fetchData($userID);
        $profileData = $profile->fetchData($userID);
        $checkFollow = $relationship->checkFollow($userID, $_SESSION["userID"]);
        ?>
        
        <article class="padding-15 padding-y-6 border-bottom" id="profile-link-select" onclick="location.href='profile.php?username=<?php
        echo $userData["username"];
        ?>';">
            <main style="display: flex;">
                <aside class="side-profile margin-right-10 profile-picture-50">
                    <img class="profile-picture-50" src="profiles/profile-picture/default.png" alt="">
                </aside>
                <div>
                    <a href="profile.php?username=<?php
                    echo $userData["username"];
                    ?>" class="title-m hover-underline"><?php
                    echo $profileData["name"];
                    ?></a>
                    <p class="subtitle-xs" id="link">@<?php
                    echo $userData["username"];
                    ?></p>
                </div>
            </main>
            <?php
            if($userID !== $_SESSION["userID"]){
                ?>
                <form method="POST" action="inc/follow.php">
                    <input type="hidden" name="following" value=<?php
                    echo $userID;
                    ?>>
                    <?php if($checkFollow === 0){
                        ?>
                        <input type="submit" name="submit" class="btn-m btn-t" value="Follow">
                        <?php
                    }
                    elseif($checkFollow > 0){
                        ?>
                        <input type="submit" name="unsubmit" class="btn-m btn-c" value="Following">
                        <?php
                    }
                    ?>
                </form>
                <?php
            }
            ?>
        </article>
        <?php
    }
    ?>
</main>