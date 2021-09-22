<?php
class Profile{
    public function fetchAll(){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM profiles");
        $query->execute();

        return $query->fetchAll();
    }

    public function fetchData($userID){
        global $pdo;

        $query = $pdo->prepare("SELECT * FROM profiles WHERE userID=?");
        $query->bindValue(1, $userID);
        $query->execute();

        return $query->fetch();
    }
}