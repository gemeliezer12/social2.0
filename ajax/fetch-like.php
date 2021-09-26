<?php
include "../inc/dbh.php";
include "../class/article-interaction.php";
$articleInteraction = new ArticleInteraction;
$fetchLike = $articleInteraction->fetchLike($_POST["articleID"], $_POST["type"]);
$fetchRepost = $articleInteraction->fetchRepost($_POST["articleID"], $_POST["type"]);

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