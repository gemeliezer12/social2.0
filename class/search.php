<?php
class Search{
    public function user($search){
        global $pdo;

        $searching = "%" . $search . "%";
        $query = $pdo->prepare("SELECT * FROM users WHERE username LIKE ? OR email LIKE ?");
        $query->bindValue(1, $searching);
        $query->bindValue(2, $searching);
        $query->execute();

        return $query->fetchAll();
    }

    public function post($search){
        global $pdo;
        if(isset($_SESSION["userID"])){
            $searching = "%" . $search . "%";
            $query = $pdo->prepare("SELECT 'post' as type, p.userID, postID as articleID, p.content, p.dateCreated FROM posts p WHERE p.content LIKE ? AND userID!=?");
            $query->bindValue(1, $searching);
            $query->bindValue(2, $_SESSION["userID"]);
            $query->execute();
            
            return $query->fetchAll();
        }
        else{
            $searching = "%" . $search . "%";
            $query = $pdo->prepare("SELECT 'post' as type, p.userID, postID as articleID, p.content, p.dateCreated FROM posts p WHERE p.content LIKE ?");
            $query->bindValue(1, $searching);
            $query->execute();
            
            return $query->fetchAll();
        }
    }
}