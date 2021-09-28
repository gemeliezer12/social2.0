<?php
class Feed{
    public function fetch(){
        $query = $pdo->prepare("SELECT * FROM posts WHERE userID in (?) LIMIT 5");
        $query->bindValue(1, (1, 2));
        $query->execute();
        foreach($query->fetchAll()){

        }
    }
}