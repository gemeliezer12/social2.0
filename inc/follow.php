<?php
include "dbh.php";
include "../class/relationship.php";

$relationship = new Relationship;
$follower = $_SESSION["userID"];
$following = $_POST["following"];
$submit = $_POST["submit"];
if($submit == "submit"){
    ?>
    <script>
        $("#follow-input<?php
                echo $following;
                ?>").attr("name", "unsubmit")
    </script>
    <?php

    $query = $pdo->prepare("SELECT * FROM relationships WHERE followingID=? AND followerID=?");
    $query->bindValue(1, $following);
    $query->bindValue(2, $follower);
    $query->execute();

    if($query->rowCount() === 0){
        $query = $pdo->prepare("INSERT INTO relationships (followingID, followerID) VALUES (?, ?)");
        $query->bindValue(1, $following);
        $query->bindValue(2, $follower);
        $query->execute();
    }
}
elseif($submit == "unsubmit"){
    ?>
    <script>
        $("#follow-input<?php
                echo $following;
                ?>").attr("name", "submit")
    </script>
    <?php


    $query = $pdo->prepare("DELETE FROM relationships WHERE followingID=? AND followerID=?");
    $query->bindValue(1, $following);
    $query->bindValue(2, $follower);
    $query->execute();
}
$followerCount = count($relationship->fetchFollower($following));
?>
<script>
$(".follower-count").text("<?php
echo $followerCount;
?>");
    <?php
    if($submit == "submit"){
        ?>
        $("#follow-input<?php
                echo $following;
                ?>").toggleClass("btn-c btn-t hover-color");
        $("#follow-input<?php
                echo $following;
                ?>").val("Following");
        <?php
    }
    elseif($submit == "unsubmit"){
        ?>
        $("#follow-input<?php
                echo $following;
                ?>").toggleClass("btn-c btn-t hover-color");
        $("#follow-input<?php
                echo $following;
                ?>").val("Follow");
        <?php
    }
    ?>
</script>