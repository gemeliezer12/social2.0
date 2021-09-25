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
        ?>").children("button").attr("name", "unsubmit")
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
        ?>").children("button").attr("name", "submit")
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
$fetchRepost = $articleInteraction->fetchRepost($articleID, $type);
if(count($fetchRepost) <= 0){
    ?>
    <script>
        $("#repost-count-<?php
        echo $type;
        echo $_POST["articleID"];
        ?>").addClass("hidden")
    </script>
    <?php
}
else{
    ?>
    <script>
        $("#repost-count-<?php
        echo $type;
        echo $_POST["articleID"];
        ?>").removeClass("hidden")
    </script>
    <?php
}
?>

<script>
        $("#repost-count-<?php
        echo $type;
        echo $_POST["articleID"];
        ?>").toggleClass("reposted")
        $("#repost-input-<?php
        echo $type;
        echo $articleID
        ?>").children("button").children("i").toggleClass("reposted fas fa")
        $("#repost-count-<?php
        echo $type;
        echo $_POST["articleID"];
        ?>").text(<?php
        echo count($fetchRepost)
        ?>);
</script>
