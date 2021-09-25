<?php
class ArticleInteraction{
    public function checkLike($postedID, $articleID, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM postinteractions WHERE postedID=? AND postID=? AND liked=?");
            $query->bindValue(1, $postedID);
            $query->bindValue(2, $articleID);
            $query->bindValue(3, true);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM commentinteractions WHERE postedID=? AND commentID=? AND liked=?");
            $query->bindValue(1, $postedID);
            $query->bindValue(2, $articleID);
            $query->bindValue(3, true);
            $query->execute();
        }
        return $query->rowCount();

    }

    public function fetchLike($articleID, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM postinteractions WHERE postID=? AND liked=?");
            $query->bindValue(1, $articleID);
            $query->bindValue(2, true);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM commentinteractions WHERE commentID=? AND liked=?");
            $query->bindValue(1, $articleID);
            $query->bindValue(2, true);
            $query->execute();
        }
        return $query->fetchAll();
    }

    public function checkRepost($postedID, $articleID, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM postinteractions WHERE postedID=? AND postID=? AND reposted=?");
            $query->bindValue(1, $postedID);
            $query->bindValue(2, $articleID);
            $query->bindValue(3, true);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM commentinteractions WHERE postedID=? AND commentID=? AND reposted=?");
            $query->bindValue(1, $postedID);
            $query->bindValue(2, $articleID);
            $query->bindValue(3, true);
            $query->execute();
        }
        return $query->rowCount();
    }

    public function fetchRepost($articleID, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM postinteractions WHERE postID=? AND reposted=?");
            $query->bindValue(1, $articleID);
            $query->bindValue(2, true);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM commentinteractions WHERE commentID=? AND reposted=?");
            $query->bindValue(1, $articleID);
            $query->bindValue(2, true);
            $query->execute();
        }
        return $query->fetchAll();
    }
}