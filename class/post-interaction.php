<?php
class PostInteraction{
    public function checkLike($postedID, $postID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM postinteractions WHERE postedID=? AND postID=? AND liked=?");
        $query->bindValue(1, $postedID);
        $query->bindValue(2, $postID);
        $query->bindValue(3, true);
        $query->execute();

        return $query->rowCount();
    }

    public function fetchLike($postID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM postinteractions WHERE postID=? AND liked=?");
        $query->bindValue(1, $postID);
        $query->bindValue(2, true);
        $query->execute();

        return $query->fetchAll();
    }

    public function checkRepost($postedID, $postID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM postinteractions WHERE postedID=? AND postID=? AND reposted=?");
        $query->bindValue(1, $postedID);
        $query->bindValue(2, $postID);
        $query->bindValue(3, true);
        $query->execute();

        return $query->rowCount();
    }

    public function fetchRepost($postID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM postinteractions WHERE postID=? AND reposted=?");
        $query->bindValue(1, $postID);
        $query->bindValue(2, true);
        $query->execute();

        return $query->fetchAll();
    }
}