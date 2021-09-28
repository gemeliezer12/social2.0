<?php
class Article{
    public function fetchByArticle($articleID, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM posts WHERE postID=?");
            $query->bindValue(1, $articleID);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM comments WHERE commentID=?");
            $query->bindValue(1, $articleID);
            $query->execute();
        }
        elseif($type == "repost"){
            $query = $pdo->prepare("SELECT * FROM reposts WHERE repostID=?");
            $query->bindValue(1, $articleID);
            $query->execute();
        }
        return $query->fetch();
    }
    
    public function fetchByUser($userID, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM posts WHERE userID=?");
            $query->bindValue(1, $userID);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM comments WHERE userID=?");
            $query->bindValue(1, $userID);
            $query->execute();
        }
        elseif($type == "repost"){
            $query = $pdo->prepare("SELECT * FROM reposts WHERE repostID=?");
            $query->bindValue(1, $userID);
            $query->execute();
        }
        return $query->fetchAll();
    }

    public function checkCommented($commented, $userID, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM comments WHERE commentedPost=? AND userID=?");
            $query->bindValue(1, $commented);
            $query->bindValue(2, $userID);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM comments WHERE commentedComment=? AND userID=?");
            $query->bindValue(1, $commented);
            $query->bindValue(2, $userID);
            $query->execute();
        }
        return $query->fetch();
    }

    public function checkReposted($commented, $userID, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM reposts WHERE repostedPost=? AND userID=?");
            $query->bindValue(1, $commented);
            $query->bindValue(2, $userID);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM reposts WHERE repostedComment=? AND userID=?");
            $query->bindValue(1, $commented);
            $query->bindValue(2, $userID);
            $query->execute();
        }
        return $query->fetch();
    }

    public function fetchByCommented($commented, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT 'repostComment' as type, userID, commentID as articleID, content, dateCreated FROM comments WHERE commentedPost=?");
            $query->bindValue(1, $commented);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM comments WHERE commentedComment=?");
            $query->bindValue(1, $commented);
            $query->execute();
        }
        return $query->fetchAll();
    }

    public function fetchByReposted($commented, $type){
        global $pdo;
        if($type == "post"){
            $query = $pdo->prepare("SELECT * FROM reposts WHERE repostedPost=? AND repostedComment IS NULL");
            $query->bindValue(1, $commented);
            $query->execute();
        }
        elseif($type == "comment"){
            $query = $pdo->prepare("SELECT * FROM reposts WHERE repostedComment=?");
            $query->bindValue(1, $commented);
            $query->execute();
        }
        return $query->fetchAll();
    }
}