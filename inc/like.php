<?php
include "dbh.php";
include "../class/like.php";
$like = new Like;
include "../class/article.php";
$article = new Article;

$userID = $_SESSION["userID"];
$articleID = $_POST["articleID"];
$type = $_POST["type"];
$submit = $_POST["submit"];


if($submit == "submit"){
    ?>
    <script>
        $(".like-input-<?php
        echo $type;
        echo $articleID;
        ?>").attr("name", "unsubmit")
    </script>
    <?php
    if($type == "post"){
        
        $query = $pdo->prepare("INSERT INTO likes (userID, likedPost,dateCreated) VALUES (?, ?, ?)");
        $query->bindValue(1, $userID);
        $query->bindValue(2, $articleID);
        $query->bindValue(3, time());
        $query->execute();

    }
    elseif($type == "comment"){
            $query = $pdo->prepare("INSERT INTO likes (userID, likedComment,dateCreated) VALUES (?, ?, ?)");
            $query->bindValue(1, $userID);
            $query->bindValue(2, $articleID);
            $query->bindValue(3, time());
            $query->execute();
    }
}
elseif($submit == "unsubmit"){
    ?>
    <script>
        $(".like-input-<?php
        echo $type;
        echo $articleID
        ?>").attr("name", "submit")
    </script>
    <?php
    if($type == "post"){
        $query = $pdo->prepare("DELETE FROM likes WHERE userID=? AND likedPost=?");
        $query->bindValue(1, $userID);
        $query->bindValue(2, $articleID);
        $query->execute();
    }
    elseif($type == "comment"){
        $query = $pdo->prepare("DELETE FROM likes WHERE userID=? AND likedComment=?");
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
like = $(".like-input-<?php
echo $type;
echo $articleID
?>").attr("name")
$(".like-count-<?php
echo $type;
echo $articleID;
?>").text(<?php
echo $countLike;
?>)

// If liked
if(like == "submit"){
    $(".like-count-<?php
    echo $type;
    echo $articleID;
    ?>").removeClass("liked")
    $(".like-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").removeClass("liked fas");
    $(".like-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").addClass("far");
}
// If not liked
else if(like == "unsubmit"){
    $(".like-count-<?php
    echo $type;
    echo $articleID;
    ?>").addClass("liked")
    $(".like-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").addClass("liked fas");
    $(".like-input-<?php
    echo $type;
    echo $articleID;
    ?>").children("i").removeClass("far");
}

<?php
if($countLike > 0){
    ?>
    $(".like-count-<?php
    echo $type;
    echo $articleID;
    ?>").removeClass("hidden")
    $(".like-count-<?php
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
    $(".like-count-<?php
    echo $type;
    echo $articleID;
    ?>").addClass("hidden")
    $(".like-count-<?php
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
