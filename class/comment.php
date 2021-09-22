<?php
class Comment{
    public function fetchByCommentedPost($commentedPost){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM comments WHERE commentedPost=? AND commentedComment IS NULL");
        $query->bindValue(1, $commentedPost);
        $query->execute();

        return $query->fetchAll();
    }

    public function fetchByCommentedComments($commentedComments){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM comments WHERE commentedComment=?");
        $query->bindValue(1, $commentedComments);
        $query->execute();

        return $query->fetchAll();
    }

    public function fetchByComment($commentID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM comments WHERE commentID=?");
        $query->bindValue(1, $commentID);
        $query->execute();

        return $query->fetch();
    }
}