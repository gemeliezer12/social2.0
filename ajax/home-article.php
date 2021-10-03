<script>
    <?php
    include "../inc/dbh.php";
    $selfID = $_SESSION["userID"];
    $dateLimit = $_POST["dateLimit"];
    $articleLimit = $_POST["articleLimit"];
    $typeLimit = $_POST["typeLimit"];
    $implodeFollowing = $_POST["implodeFollowing"];
    $query = $pdo->prepare(
        "SELECT 'repostPost' as type, p.userID, postID as articleID, p.content, r.dateCreated as dateCreated FROM posts p
        JOIN reposts r ON p.postID=r.repostedPost
        WHERE r.userID in ($implodeFollowing) AND p.userID NOT IN ($implodeFollowing) AND p.userID!=?
        GROUP BY postID
        UNION SELECT 'repostComment' as type, c.userID, commentID as articleID, c.content, r.dateCreated as dateCreated FROM comments c
        JOIN reposts r ON c.commentID=r.repostedComment WHERE r.userID in ($implodeFollowing) AND c.userID NOT IN ($implodeFollowing) AND c.userID!=?
        GROUP BY commentID
        UNION
        SELECT 'post' as type, p.userID, postID, p.content, p.dateCreated as dateCreated FROM posts p
        WHERE p.userID IN ($implodeFollowing) AND p.userID!=? ORDER BY dateCreated DESC LIMIT $articleLimit OFFSET 8;"
    );
    $query->bindValue(1, $_SESSION["userID"]);
    $query->bindValue(2, $_SESSION["userID"]);
    $query->bindValue(3, $_SESSION["userID"]);
    $query->execute();

    $result = $query->fetchAll();
    ?>
</script>