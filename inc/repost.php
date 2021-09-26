<?php
include "dbh.php";
include "../class/article-interaction.php";
$articleInteraction = new ArticleInteraction;

$postedID = $_SESSION["userID"];
$posterID = $_POST["posterID"];
$articleID = $_POST["articleID"];
$type = $_POST["type"];
$submit = $_POST["submit"];


if($submit == "submit"){
    ?>
    <script>
        $("#repost-input-<?php
        echo $type;
        echo $articleID
        ?>").attr("name", "unsubmit")
    </script>
    <?php
    if($type == "post"){
        $query = $pdo->prepare("SELECT * FROM postinteractions WHERE postedID=? AND postID=?");
        $query->bindValue(1, $postedID);
        $query->bindValue(2, $articleID);
        $query->execute();
        if($query->rowCount() > 0){
            $query = $pdo->prepare("UPDATE postinteractions SET reposted=?, dateReposted=? WHERE postedID=? AND postID=?");
            $query->bindValue(1, true);
            $query->bindValue(2, time());
            $query->bindValue(3, $postedID);
            $query->bindValue(4, $articleID);
            $query->execute();
        }
        else{
            $query = $pdo->prepare("INSERT INTO postinteractions (postedID, posterID, postID, reposted, dateReposted) VALUES (?, ?, ?, ?, ?)");
            $query->bindValue(1, $postedID);
            $query->bindValue(2, $posterID);
            $query->bindValue(3, $articleID);
            $query->bindValue(4, true);
            $query->bindValue(5, time());
            $query->execute();
        }
    }
    elseif($type == "comment"){
        $query = $pdo->prepare("SELECT * FROM commentinteractions WHERE postedID=? AND commentID=?");
        $query->bindValue(1, $postedID);
        $query->bindValue(2, $articleID);
        $query->execute();
        if($query->rowCount() > 0){
            $query = $pdo->prepare("UPDATE commentinteractions SET reposted=?, dateReposted=? WHERE postedID=? AND commentID=?");
            $query->bindValue(1, true);
            $query->bindValue(2, time());
            $query->bindValue(3, $postedID);
            $query->bindValue(4, $articleID);
            $query->execute();
        }
        else{
            $query = $pdo->prepare("INSERT INTO commentinteractions (postedID, posterID, commentID, reposted, dateReposted) VALUES (?, ?, ?, ?, ?)");
            $query->bindValue(1, $postedID);
            $query->bindValue(2, $posterID);
            $query->bindValue(3, $articleID);
            $query->bindValue(4, true);
            $query->bindValue(5, time());
            $query->execute();
        }
    }
}
elseif($submit == "unsubmit"){
    ?>
    <script>
        $("#repost-input-<?php
        echo $type;
        echo $articleID
        ?>").attr("name", "submit")
    </script>
    <?php
    if($type == "post"){
        $query = $pdo->prepare("DELETE FROM postinteractions WHERE reposted=? AND postedID=? AND postID=?");
        $query->bindValue(1, false);
        $query->bindValue(2, $postedID);
        $query->bindValue(3, $articleID);
        $query->execute();
        $query = $pdo->prepare("UPDATE postinteractions SET reposted=?, dateReposted=?  WHERE postedID=? AND postID=?");
        $query->bindValue(1, false);
        $query->bindValue(2, NULL);
        $query->bindValue(3, $postedID);
        $query->bindValue(4, $articleID);
        $query->execute();
    }
    elseif($type == "comment"){
        $query = $pdo->prepare("DELETE FROM commentinteractions WHERE reposted=? AND postedID=? AND commentID=?");
        $query->bindValue(1, false);
        $query->bindValue(2, $postedID);
        $query->bindValue(3, $articleID);
        $query->execute();
        $query = $pdo->prepare("UPDATE commentinteractions SET reposted=?, dateReposted=?  WHERE postedID=? AND commentID=?");
        $query->bindValue(1, false);
        $query->bindValue(2, NULL);
        $query->bindValue(3, $postedID);
        $query->bindValue(4, $articleID);
        $query->execute();
    }
}
$fetchLike = $articleInteraction->fetchLike($articleID, $type);
$countLike = count($fetchLike);
$fetchRepost = $articleInteraction->fetchRepost($articleID, $type);
$countRepost = count($fetchRepost);
?>
<script>
repost = $("#repost-input-<?php
echo $type;
echo $articleID
?>").attr("name")
$("#repost-count-<?php
echo $type;
echo $articleID;
?>").text(<?php
echo $countRepost;
?>)

// If reposted
if(repost == "submit"){
    $("#repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").removeClass("reposted")
    $("#repost-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").removeClass("reposted fas");
    $("#repost-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").addClass("fa");
}
// If not reposted
else if(repost == "unsubmit"){
    $("#repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").addClass("reposted")
    $("#repost-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").addClass("reposted fas");
    $("#repost-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").removeClass("fa");
}

<?php
if($countRepost > 0){
    ?>
    console.log($("#repost-count-<?php
    echo $type;
    echo $articleID;
    ?>"));
    $("#repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").removeClass("hidden")
    $("#repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").parent("a").removeClass("hidden")
    $("#repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").parent("a").parent("div").removeClass("hidden")
    
    <?php
}
else{
    ?>
    $("#repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").addClass("hidden")
    $("#repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").parent("a").addClass("hidden")
    <?php
}
if($countRepost <= 0 && $countLike <= 0){
    ?>
    $("#repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").parent("a").parent("div").addClass("hidden")
    <?php
}
?>
</script>