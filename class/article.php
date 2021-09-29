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
        // $query = $pdo->prepare("SELECT 'repostPost' as type, p.userID, postID as articleID, p.content, r.dateCreated FROM posts p JOIN reposts r ON p.postID=r.repostedPost WHERE p.userID!=? AND r.userID=?
        // UNION 
        // SELECT 'repostComment' as type, c.userID, commentID as articleID, c.content, r.dateCreated FROM comments c JOIN reposts r ON c.commentID=r.repostedComment WHERE c.userID!=? AND r.userID=?
        // UNION
        // SELECT 'post' as type, p.userID, postID, p.content, p.dateCreated FROM posts p WHERE p.userID=?");
        // $query->bindValue(1, $userID);
        // $query->bindValue(2, $userID);
        // $query->bindValue(3, $userID);
        // $query->bindValue(4, $userID);
        // $query->bindValue(5, $userID);
        // $query->execute();
        // return $query->fetchAll();
        $query = $pdo->prepare("SELECT 'repostPost' as type, p.userID, postID as articleID, p.content, r.dateCreated FROM posts p JOIN reposts r ON p.postID=r.repostedPost WHERE r.userID=?
        UNION 
        SELECT 'repostComment' as type, c.userID, commentID as articleID, c.content, r.dateCreated FROM comments c JOIN reposts r ON c.commentID=r.repostedComment WHERE r.userID=?
        UNION
        SELECT 'post' as type, p.userID, postID, p.content, p.dateCreated FROM posts p WHERE p.userID=?");
        $query->bindValue(1, $userID);
        $query->bindValue(2, $userID);
        $query->bindValue(3, $userID);
        // $query->bindValue(4, $userID);
        // $query->bindValue(5, $userID);
        $query->execute();
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
            // $query = $pdo->prepare("SELECT 'repostComment' as type, userID, commentID as articleID, content, dateCreated FROM comments WHERE commentedPost=?");
            // $query->bindValue(1, $commented);
            // $query->execute();
            $query = $pdo->prepare("SELECT 'comment' as type, userID, commentID as articleID, content, dateCreated FROM comments WHERE commentedPost=?");
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

    public function fetchReposter($reposted, $implodeFollowing, $type){
        global $pdo;
        if($type = "post"){
            $query = $pdo->prepare("SELECT * FROM reposts WHERE repostedPost=? AND userID IN ($implodeFollowing) ORDER BY dateCreated DESC");
            $query->bindValue(1, $reposted);
            $query->execute();
        }
        elseif($type = "comment"){
            $query = $pdo->prepare("SELECT * FROM reposts WHERE repostedComment=? AND userID IN ($implodeFollowing) ORDER BY dateCreated DESC");
            $query->bindValue(1, $reposted);
            $query->execute();
        }
        return($query->fetch());
    }
}