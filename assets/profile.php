
<?php
if(isset($_SESSION["username"])){
    ?>
        <main class="column">
            <?php
            foreach($userIDs as $userID){
                $userData = $user->fetchData($userID);
                $profileData = $profile->fetchData($userID);
                $checkFollow = $relationship->checkFollow($userID, $_SESSION["userID"]);
                ?>
                <script>
                    $(document).ready(function(){
                        $("#follow-input<?php
                        echo $userData["userID"];
                        ?>").click(function(){
                            $(".follow-loader").load("inc/follow.php",{
                                follower: <?php
                                echo $_SESSION["userID"]
                                ?>,
                                following: <?php
                                echo $userData["userID"]
                                ?>,
                                submit: $("#follow-input<?php
                                echo $userData["userID"];
                                ?>").attr("name")
                            });
                        })
                        $("#profile-link<?php
                        echo $userID;
                        ?>").click(function(e){
                            if(!$(e.target).hasClass("dont-link")){
                                window.location.href = "http://localhost/social2.0/profile.php?username=<?php echo $userID?>";
                            }
                        })
                    })
                </script>
                
                <article class="padding-15 padding-y-6 border-bottom flex-start hover-base-4 space-between" id="profile-link<?php
                echo $userID;
                ?>">
                    <main class="flex">
                        <aside class="side-profile margin-right-10 profile-picture-50">
                            <img class="profile-picture-50" src="profiles/profile-picture/default.png" alt="">
                        </aside>
                        <div>
                            <a href="profile.php?username=<?php
                            echo $userData["username"];
                            ?>" class="title-18 hover-underline"><?php
                            echo $profileData["name"];
                            ?></a>
                            <p class="subtitle-14" id="link">@<?php
                            echo $userData["username"];
                            ?></p>
                        </div>
                    </main>
                    <?php
                    if(isset($_SESSION["userID"])){
                        if($_SESSION["userID"] === $userData["userID"]){
                        }
                        else{
                            ?>
                            <input id="follow-input<?php
                                echo $userData["userID"];
                            ?>" type="submit" name="<?php
                            if($checkFollow === 0){
                                echo "submit"
                                ?>" class="btn-m btn-t following dont-link" value="Follow">
                                <?php
                            }
                            else{
                                echo "unsubmit"
                                ?>" class="btn-m btn-c hover-color following dont-link" value="Following">
                                <?php
                            }
                            
                        }
                    }
                    else{
                        ?>
                        <a href="index.php">Follow</a>
                        <?php
                    }
                    ?>
                </article>
                <?php
            }
            ?>
        </main>

        <div class="follow-loader"></div>
    <?php
}
else{
    ?>
        <main class="column">
            <?php
            foreach($userIDs as $userID){
                $userData = $user->fetchData($userID);
                $profileData = $profile->fetchData($userID);
                ?>
                <script>
                    $(document).ready(function(){
                        $("#profile-link<?php
                        echo $userID;
                        ?>").click(function(e){
                            if(!$(e.target).hasClass("dont-link")){
                                window.location.href = "http://localhost/social2.0/profile.php?username=<?php echo $userID?>";
                            }
                        })
                    })
                </script>
                
                <article class="padding-15 padding-y-6 border-bottom flex-start hover-base-4 space-between cursor-pointer" id="profile-link<?php
                echo $userID;
                ?>">
                    <main class="flex">
                        <aside class="side-profile margin-right-10 profile-picture-50">
                            <img class="profile-picture-50" src="profiles/profile-picture/default.png" alt="">
                        </aside>
                        <div>
                            <a href="profile.php?username=<?php
                            echo $userData["username"];
                            ?>" class="title-18 hover-underline"><?php
                            echo $profileData["name"];
                            ?></a>
                            <p class="subtitle-14" id="link">@<?php
                            echo $userData["username"];
                            ?></p>
                        </div>
                    </main>
                        <a class="btn-m btn-t following dont-link" href="index.php">Follow</a>
                </article>
                <?php
            }
            ?>
        </main>

        <div class="follow-loader"></div>
    <?php
}
?>