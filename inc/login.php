<?php
include "dbh.php";

if(isset($_POST["submit"])){
    $password = $_POST["password"];
    $emailUsername = $_POST["email-username"];
    if(empty($emailUsername) || empty($password)){
        header("Location: ../login.php?error=emptyfields");
        exit();
    }
    else{
        $query = $pdo->prepare("SELECT * FROM users WHERE username=? OR email=?;");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query->bindValue(1, $emailUsername);
        $query->bindValue(2, $emailUsername);

        $query->execute();

        $rowCount = $query->rowCount();

        if($rowCount > 0){
            $row = $query->fetch();
            $passwordCheck = password_verify($password, $row["password"]);
            
            if($passwordCheck == false){
                header("Location: ../login.php?error=wrongpwd");
                exit();
            }
            elseif($passwordCheck == true){
                session_start();
                $_SESSION["userID"] = $row["userID"];
                $_SESSION["username"] = $row["username"];
                
                header("Location: ../home.php");
                
                exit();
            }
        }
        else{
            header("Location: ../login.php?error=nouser");
            exit();
        }
    }
}
else{
    header("Location: javascript://history.go(-1)");
    exit();
}