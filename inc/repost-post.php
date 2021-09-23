<?php
include "dbh.php";
$postedID = $_SESSION["userID"];
$posterID = $_POST["posterID"];
$postID = $_POST["postID"];
if(isset($_POST["submit"])){
    $query = $pdo->prepare("SELECT * FROM postinteractions WHERE postedID=? AND postID=?");
    $query->bindValue(1, $postedID);
    $query->bindValue(2, $postID);
    $query->execute();
    if($query->rowCount() > 0){
        $query = $pdo->prepare("UPDATE postinteractions SET reposted=?, dateReposted=? WHERE postedID=? AND postID=?");
        $query->bindValue(1, true);
        $query->bindValue(2, time());
        $query->bindValue(3, $postedID);
        $query->bindValue(4, $postID);
        $query->execute();
    }
    else{
        $query = $pdo->prepare("INSERT INTO postinteractions (postedID, posterID, postID, reposted, dateReposted) VALUES (?, ?, ?, ?, ?)");
        $query->bindValue(1, $postedID);
        $query->bindValue(2, $posterID);
        $query->bindValue(3, $postID);
        $query->bindValue(4, true);
        $query->bindValue(5, time());
        $query->execute();
    }
}
elseif(isset($_POST["unsubmit"])){
    
    $query = $pdo->prepare("DELETE FROM postinteractions WHERE liked=? AND postedID=? AND postID=?");
    $query->bindValue(1, false);
    $query->bindValue(2, $postedID);
    $query->bindValue(3, $postID);
    $query->execute();
    $query = $pdo->prepare("UPDATE postinteractions SET reposted=?, dateReposted=?  WHERE postedID=? AND postID=?");
    $query->bindValue(1, false);
    $query->bindValue(2, NULL);
    $query->bindValue(3, $postedID);
    $query->bindValue(4, $postID);
    $query->execute();
}
header("Location: ../post.php?post=$postID");