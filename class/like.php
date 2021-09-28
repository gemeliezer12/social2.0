<?php
class Like{
    public function checkLike($postedID, $articleID, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM likes WHERE userID=? AND likedPost=?");
            $query->bindValue(1, $postedID);
            $query->bindValue(2, $articleID);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM likes WHERE userID=? AND likedComment=?");
            $query->bindValue(1, $postedID);
            $query->bindValue(2, $articleID);

            $query->execute();
        }
        return $query->rowCount();

    }

    public function fetchLike($articleID, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM likes WHERE likedPost=?");
            $query->bindValue(1, $articleID);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM likes WHERE likedComment=?");
            $query->bindValue(1, $articleID);
            $query->execute();
        }
        return $query->fetchAll();
    }
}