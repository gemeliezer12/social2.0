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

        $searching = "%" . $search . "%";
        $query = $pdo->prepare("SELECT * FROM posts WHERE content LIKE ?");
        $query->bindValue(1, $searching);
        $query->execute();
        
        return $query->fetchAll();
    }
}