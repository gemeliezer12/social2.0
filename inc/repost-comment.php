<?php
include "dbh.php";
$postedID = $_SESSION["userID"];
$posterID = $_POST["posterID"];
$commentID = $_POST["postID"];
echo "DSADASD";
if(isset($_POST["submit"])){
    $query = $pdo->prepare("SELECT * FROM commentinteractions WHERE postedID=? AND commentID=?");
    $query->bindValue(1, $postedID);
    $query->bindValue(2, $commentID);
    $query->execute();
    if($query->rowCount() > 0){
        $query = $pdo->prepare("UPDATE commentinteractions SET reposted=? WHERE postedID=? AND commentID=?");
        $query->bindValue(1, true);
        $query->bindValue(2, $postedID);
        $query->bindValue(3, $commentID);
        $query->execute();
        $query = $pdo->prepare("UPDATE commentinteractions SET dateReposted=? WHERE postedID=? AND commentID=?");
        $query->bindValue(1, time());
        $query->bindValue(2, $postedID);
        $query->bindValue(3, $commentID);
        $query->execute();
    }
    else{
        $query = $pdo->prepare("INSERT INTO commentinteractions (postedID, posterID, commentID, reposted, dateReposted) VALUES (?, ?, ?, ?, ?)");
        $query->bindValue(1, $postedID);
        $query->bindValue(2, $posterID);
        $query->bindValue(3, $commentID);
        $query->bindValue(4, true);
        $query->bindValue(5, time());
        $query->execute();
    }
}
elseif(isset($_POST["unsubmit"])){
    $query = $pdo->prepare("UPDATE commentinteractions SET reposted=? WHERE postedID=? AND commentID=?");
    $query->bindValue(1, false);
    $query->bindValue(2, $postedID);
    $query->bindValue(3, $commentID);
    $query->execute();
    $query = $pdo->prepare("UPDATE commentinteractions SET dateReposted=? WHERE postedID=? AND commentID=?");
    $query->bindValue(1, NULL);
    $query->bindValue(2, $postedID);
    $query->bindValue(3, $commentID);
    $query->execute();
}