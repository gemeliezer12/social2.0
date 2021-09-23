<?php
class Comment{
    public function fetchComment($commented, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM comments WHERE commentedPost=? AND commentedComment IS NULL");
            $query->bindValue(1, $commented);
            $query->execute();

            return $query->fetchAll();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM comments WHERE commentedComment=?");
            $query->bindValue(1, $commented);
            $query->execute();

            return $query->fetchAll();
        }
    }

    public function fetchByComment($commentID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM comments WHERE commentID=?");
        $query->bindValue(1, $commentID);
        $query->execute();

        return $query->fetch();
    }

    public function checkComment($commented, $userID, $type){
        global $pdo;
        if($type == "post"){

            $query = $pdo->prepare("SELECT * FROM comments WHERE commentedPost=? AND userID=?");
            $query->bindValue(1, $commented);
            $query->bindValue(2, $userID);
            $query->execute();

            return $query->fetch();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM comments WHERE commentedComment=? AND userID=?");
            $query->bindValue(1, $commented);
            $query->bindValue(2, $userID);
            $query->execute();

            return $query->fetch();
        }
    }
}