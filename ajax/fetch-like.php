<?php
include "../inc/dbh.php";
include "../class/like.php";
$like = new Like;
include "../class/article.php";
$article = new Article;
$fetchLike = $like->fetchLike($_POST["articleID"], $_POST["type"]);
$fetchRepost = $article->fetchByReposted($_POST["articleID"], $_POST["type"]);

?>
<script>
    $("#like-count-<?php
    echo $_POST["type"];
    echo $_POST["articleID"];
    ?>").text(<?php
    echo count($fetchLike)
    ?>);
    $("#repost-count-<?php
    echo $_POST["type"];
    echo $_POST["articleID"];
    ?>").text(<?php
    echo count($fetchRepost)
    ?>);
</script>
<?php
if(count($fetchLike) > 0){
    ?>
    <script>
        $("#like-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").parent("a").removeClass("hidden")
        $("#like-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").removeClass("hidden")
    </script>
    <?php
}
else{
    ?>
    <script>
        $("#like-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").parent("a").addClass("hidden")
        $("#like-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").addClass("hidden")
    </script>
    <?php
}
if(count($fetchRepost) > 0){
    ?>
    <script>
        $("#repost-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").parent("a").removeClass("hidden")
        $("#repost-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").removeClass("hidden")
    </script>
    <?php
}
else{
    ?>
    <script>
        $("#repost-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").parent("a").addClass("hidden")
        $("#repost-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").addClass("hidden")
    </script>
    <?php
}