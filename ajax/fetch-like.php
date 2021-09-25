<?php
include "../inc/dbh.php";
include "../class/article-interaction.php";
$articleInteraction = new ArticleInteraction;
$fetchLike = $articleInteraction->fetchLike($_POST["articleID"], $_POST["type"]);

if(count($fetchLike) >= 0){
    ?>
    <script>

        $("#like-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").text(<?php
        echo count($fetchLike)
        ?>);
    </script>
    <?php
}
else{
    ?>
    <script>
        $("#like-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").attr("class", "hidden")
    </script>
    <?php
}

$fetchRepost = $articleInteraction->fetchRepost($_POST["articleID"], $_POST["type"]);
if(count($fetchRepost) >= 0){
    ?>
    <script>
        $("#repost-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").text(<?php
        echo count($fetchRepost)
        ?>);
    </script>
    <?php
}
else{
    ?>
    <script>
        $("#repost-count-<?php
        echo $_POST["type"];
        echo $_POST["articleID"];
        ?>").attr("class", "hidden")
    </script>
    <?php
}