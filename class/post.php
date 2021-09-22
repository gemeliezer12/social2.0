<?php
class Post{
    public function fetchDataByUser($userID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM posts WHERE userID=?");
        $query->bindValue(1, $userID);
        $query->execute();
        
        return $query->fetchAll();
    }

    public function fetchDataByPost($postID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM posts WHERE postID=?");
        $query->bindValue(1, $postID);
        $query->execute();
        
        return $query->fetch();
    }
}