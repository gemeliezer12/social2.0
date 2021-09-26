<?php
include "dbh.php";
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $bio = $_POST["bio"];
    $website = $_POST["website"];
    echo $website;
    
    $query = $pdo->prepare("UPDATE profiles SET name=?, bio=?, website=? WHERE userID=?");
    $query->bindValue(1, $name);
    $query->bindValue(2, $bio);
    $query->bindValue(3, $website);
    $query->bindValue(4, $_SESSION["userID"]);
    $query->execute();
}


    // header("Location: ../profile.php");
    // exit();
