<?php
class CommentInteraction{
    public function checkLike($postedID, $commentID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM commentinteractions WHERE postedID=? AND commentID=? AND liked=?");
        $query->bindValue(1, $postedID);
        $query->bindValue(2, $commentID);
        $query->bindValue(3, true);
        $query->execute();

        return $query->rowCount();
    }

    public function fetchLike($commentID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM commentinteractions WHERE commentID=? AND liked=?");
        $query->bindValue(1, $commentID);
        $query->bindValue(2, true);
        $query->execute();

        return $query->fetchAll();
    }

    public function checkRepost($postedID, $commentID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM commentinteractions WHERE postedID=? AND commentID=? AND reposted=?");
        $query->bindValue(1, $postedID);
        $query->bindValue(2, $commentID);
        $query->bindValue(3, true);
        $query->execute();

        return $query->rowCount();
    }

    public function fetchRepost($commentID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM commentinteractions WHERE commentID=? AND reposted=?");
        $query->bindValue(1, $commentID);
        $query->bindValue(2, true);
        $query->execute();

        return $query->fetchAll();
    }
}