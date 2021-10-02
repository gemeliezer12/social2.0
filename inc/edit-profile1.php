<?php
include "dbh.php";
$id = $_SESSION["userID"];

if(!empty($_POST["image"])){
    echo $_POST["submit"];
    // $cropped_image = $_POST['image'];
    // list($type, $cropped_image) = explode(';', $cropped_image);
    // list(, $cropped_image) = explode(',', $cropped_image);
    // $cropped_image = base64_decode($cropped_image);
    // $image_name = date('ymdgis').'.png';
    // file_put_contents('../profiles/profile-picture/'.$image_name, $cropped_image);
}

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $bio = $_POST["bio"];
    $website = $_POST["website"];

    // if(!empty($_FILES["profile-picture"])){
    //     $profilePicture = $_FILES["profile-picture"];
        
    //     $profilePictureName = $profilePicture["name"];
    //     $profilePictureTmpName = $profilePicture["tmp_name"];
    //     $profilePictureSize = $profilePicture["size"];
    //     $profilePictureError = $profilePicture["error"];
    //     $profilePictureType = $profilePicture["type"];
    //     $newProfilePictureName;
        
    //     $profilePictureExt = explode(".", $profilePictureName);
    //     $profilePictureExt = strtolower(end($profilePictureExt));
    //     $allowedProfilePictureExt = array("jpg", "jpeg", "png", "pdf");
        
    //     if($profilePictureError === 0){
    //         if(in_array($profilePictureExt, $allowedProfilePictureExt)){
                
    //             if($profilePictureSize < 10000000){
    //                 $newProfilePictureName = $id.".".$profilePictureExt;
    //                 $profilePictureDestination = "../profiles/profile-picture/".$newProfilePictureName;
    //                 move_uploaded_file($profilePictureTmpName, $profilePictureDestination);
    //             }
    //             else{
    //                 // header("Location: javascript://history.go(-1)");
    //                 // exit();
    //             }
    //         }
    //         else{
    //             // header("Location: javascript://history.go(-1)");
    //             // exit();
    //         }
    //     }
    //     else{
    //         $query = $pdo->prepare("SELECT profilePicture FROM profiles WHERE userID=?");
    //         $query->bindValue(1, $id);
    //         $query->execute();

    //         $result = $query->fetch()["profilePicture"];

    //         if(empty($result)){
    //             $newProfilePictureName = "default.png";
    //         }
    //         else{

    //             $newProfilePictureName = $result;
    //         }

    //         // header("Location: javascript://history.go(-1)");
    //         // exit();
    //     }
        
    // }
    if(empty($name)){
        // header("Location: javascript://history.go(-1)");
        // exit();
    }
    
    else{
        $query = $pdo->prepare("UPDATE profiles SET name=?, bio=?, website=?, profilePicture=? WHERE userID=$id");
        $query->bindValue(1, $name);
        $query->bindValue(2, $bio);
        $query->bindValue(3, $website);
        $query->bindValue(4, $newProfilePictureName);
        $query->execute();

        // header("Location: javascript://history.go(-1)");
        // exit();
    }
}
else{
    // header("Location: javascript://history.go(-1)");
    // exit();
}