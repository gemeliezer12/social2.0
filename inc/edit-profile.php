<?php
include "dbh.php";
$id = $_SESSION["userID"];


if(isset($_POST["submit"])){
    if(isset($_POST["image"])){
        $cropped_image = $_POST['image'];
        list($type, $cropped_image) = explode(';', $cropped_image);
        list(, $cropped_image) = explode(',', $cropped_image);
        $cropped_image = base64_decode($cropped_image);
        $image_name = $id.'.png';
        // $image_name = date('ymdgis').'.png';
        file_put_contents('../profiles/profile-picture/'.$image_name, $cropped_image);
        $query = $pdo->prepare("UPDATE profiles SET profilePicture=? WHERE userID=?");
        $query->bindValue(1, $image_name);
        $query->bindValue(2, $id);
        $query->execute();
    }
    $name = $_POST["name"];
    $bio = $_POST["bio"];
    $website = $_POST["website"];

    if(empty($name)){
    }
    
    else{
        $query = $pdo->prepare("UPDATE profiles SET name=?, bio=?, website=? WHERE userID=?");
        $query->bindValue(1, $name);
        $query->bindValue(2, $bio);
        $query->bindValue(3, $website);
        $query->bindValue(4, $id);
        $query->execute();
    }
}