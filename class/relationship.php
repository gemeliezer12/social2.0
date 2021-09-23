<?php
class Relationship{
    public function fetchFollowing($userID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM relationships WHERE followerID=?");
        $query->bindValue(1, $userID);
        $query->execute();
        
        return $query->fetchAll();
    }

    public function fetchFollower($userID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM relationships WHERE followerID=?");
        $query->bindValue(1, $userID);
        $query->execute();
        
        return $query->fetchAll();
    }

    public function checkFollow($followingID, $followerID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM relationships WHERE followingID=? AND followerID=?");
        $query->bindValue(1, $followingID);
        $query->bindValue(2, $followerID);
        $query->execute();

        return $query->rowCount();
    }
}