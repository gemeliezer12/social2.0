<?php
include "dbh.php";
$follower = $_SESSION["userID"];
if(isset($_POST["submit"])){
    $following = $_POST["following"];

    $query = $pdo->prepare("SELECT * FROM relationships WHERE followingID=? AND followerID=?");
    $query->bindValue(1, $following);
    $query->bindValue(2, $follower);
    $query->execute();

    if($query->rowCount() === 0){
        $query = $pdo->prepare("INSERT INTO relationships (followingID, followerID) VALUES (?, ?)");
        $query->bindValue(1, $following);
        $query->bindValue(2, $follower);
        $query->execute();

        $query = $pdo->prepare("SELECT username FROM users WHERE userID=?;");
        $query->bindValue(1, $following);
        $query->execute();
        $result = $query->fetch();
        $username = $result["username"];
        header("Location: ../profile.php?username=$username");
        exit();
    }
}
elseif(isset($_POST["unsubmit"])){
    $following = $_POST["following"];


    $query = $pdo->prepare("DELETE FROM relationships WHERE followingID=? AND followerID=?");
    $query->bindValue(1, $following);
    $query->bindValue(2, $follower);
    $query->execute();

    $query = $pdo->prepare("SELECT username FROM users WHERE userID=?;");
    $query->bindValue(1, $following);
    $query->execute();
    $result = $query->fetch();
    $username = $result["username"];
    // header("Location: ../profile.php?username=$username");
    // exit();
}