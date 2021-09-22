<?php
include "dbh.php";
if(isset($_POST["submit"])){
    $content = $_POST["content"];
    $commentedPost = $_POST["commentedPost"];
    if(!empty($content)){
        if(!isset($_POST["commentedComment"])){
            $query = $pdo->prepare("INSERT INTO comments(userID, content, dateCreated, commentedPost) VALUES(?, ?, ?, ?)");
            $query->bindValue(1, $_SESSION["userID"]);
            $query->bindValue(2, $content);
            $query->bindValue(3, time());
            $query->bindValue(4, $commentedPost);
            $query->execute();
        }
        elseif(isset($_POST["commentedComment"])){
            $query = $pdo->prepare("INSERT INTO comments(userID, content, dateCreated, commentedPost, commentedComment) VALUES(?, ?, ?, ?, ?)");
            $query->bindValue(1, $_SESSION["userID"]);
            $query->bindValue(2, $content);
            $query->bindValue(3, time());
            $query->bindValue(4, $commentedPost);
            $query->bindValue(5, $_POST["commentedComment"]);
            $query->execute();
        }
    }
}