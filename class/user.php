<?php
class User{
    public function fetchAll(){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM users");
        $query->execute();

        return $query->fetchAll();
    }

    public function fetchData($userIDusername){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM users WHERE userID=? OR username=?");
        $query->bindValue(1, $userIDusername);
        $query->bindValue(2, $userIDusername);
        $query->execute();

        return $query->fetch();
    }
}