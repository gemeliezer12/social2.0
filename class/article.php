<?php
class Article{
    public function fetchByArticle($articleID, $type){
        global $pdo;

        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM posts WHERE postID=?");
            $query->bindValue(1, $articleID);
            $query->execute();

            return $query->fetch();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM comments WHERE commentID=?");
            $query->bindValue(1, $articleID);
            $query->execute();

            return $query->fetch();
        }
    }
    public function fetchByUser($userID, $type){
        global $pdo;

        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM posts WHERE userID=?");
            $query->bindValue(1, $userID);
            $query->execute();

            return $query->fetchAll();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM comments WHERE userID=?");
            $query->bindValue(1, $userID);
            $query->execute();

            return $query->fetchAll();
        }
    }

    public function checkCommented($commented, $userID, $type){
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

    public function fetchByCommented($commented, $type){
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
}