<?php
include "dbh.php";
include "../class/article.php";
$article = new Article;
include "../class/like.php";
$like = new Like;

$userID = $_SESSION["userID"];
$articleID = $_POST["articleID"];
$type = $_POST["type"];
$submit = $_POST["submit"];


if($submit == "submit"){
    ?>
    <script>
        $(".repost-input-<?php
        echo $type;
        echo $articleID
        ?>").attr("name", "unsubmit")
    </script>
    <?php
    if($type == "post"){
        
        $query = $pdo->prepare("INSERT INTO reposts (userID, repostedPost, dateCreated) VALUES (?, ?, ?)");
        $query->bindValue(1, $userID);
        $query->bindValue(2, $articleID);
        $query->bindValue(3, time());
        $query->execute();
    }
    elseif($type == "comment"){
        $query = $pdo->prepare("INSERT INTO reposts (userID, repostedComment, dateCreated) VALUES (?, ?, ?)");
        $query->bindValue(1, $userID);
        $query->bindValue(2, $articleID);
        $query->bindValue(3, time());
        $query->execute();
    }
}
elseif($submit == "unsubmit"){
    ?>
    <script>
        $(".repost-input-<?php
        echo $type;
        echo $articleID
        ?>").attr("name", "submit")
    </script>
    <?php
    if($type == "post"){
        $query = $pdo->prepare("DELETE FROM reposts WHERE userID=? AND repostedPost=?");
        $query->bindValue(1, $userID);
        $query->bindValue(2, $articleID);
        $query->execute();
        $query = $pdo->prepare("ALTER TABLE reposts AUTO_INCREMENT = 1");
        $query->execute();
    }
    elseif($type == "comment"){
        $query = $pdo->prepare("DELETE FROM reposts WHERE userID=? AND repostedComment=?");
        $query->bindValue(1, $userID);
        $query->bindValue(2, $articleID);
        $query->execute();
    }
}
$fetchLike = $like->fetchLike($articleID, $type);
$countLike = count($fetchLike);
$fetchRepost = $article->fetchByReposted($articleID, $type);
$countRepost = count($fetchRepost);
?>
<script>
repost = $(".repost-input-<?php
echo $type;
echo $articleID
?>").attr("name")
$(".repost-count-<?php
echo $type;
echo $articleID;
?>").text(<?php
echo $countRepost;
?>)
<?php
echo $countRepost;
?>

// If reposted
    console.log(<?php
    echo $countRepost;    
    ?>);
if(repost == "submit"){
    $(".repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").removeClass("reposted")
    $(".repost-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").removeClass("reposted fas");
    $(".repost-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").addClass("fa");
}
// If not reposted
else if(repost == "unsubmit"){
    $(".repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").addClass("reposted")
    $(".repost-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").addClass("reposted fas");
    $(".repost-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").removeClass("fa");
}

<?php
if($countRepost > 0){
    ?>
    $(".repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").removeClass("hidden")
    $(".repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").parent("a").removeClass("hidden")
    $(".repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").parent("a").parent("div").removeClass("hidden")
    
    <?php
}
else{
    ?>
    $(".repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").addClass("hidden")
    $(".repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").parent("a").addClass("hidden")
    <?php
}
if($countRepost <= 0 && $countLike <= 0){
    ?>
    $(".repost-count-<?php
    echo $type;
    echo $articleID;
    ?>").parent("a").parent("div").addClass("hidden")
    <?php
}
?>
</script>