<?php
include "dbh.php";
if(isset($_POST["submit"])){
    $content = $_POST["content"];
    if(!empty($content)){
        $query = $pdo->prepare("INSERT INTO posts(userID, content, dateCreated) VALUES(?, ?, ?)");
        $query->bindValue(1, $_SESSION["userID"]);
        $query->bindValue(2, $content);
        $query->bindValue(3, time());
        $query->execute();
    }
}