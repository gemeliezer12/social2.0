<?php
include "dbh.php";
if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];
    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email."");
        exit();
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidmail&uid=".$username."");
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=invaliduid&mail=".$email."");
        exit();
    }
    elseif($password !== $passwordRepeat){
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email."");
        exit();
    }
    else{
        $query = $pdo->prepare("SELECT username FROM users WHERE username=?;");
        $query->bindValue(1, $username);
        $query->execute();
        if($query->rowCount() > 0){
            header("Location: ../signup.php?error=usertaken&mail=".$email."");
            exit();
        }
        else{
            $query = $pdo->prepare("INSERT INTO users(username, email, password, dateCreated) VALUES(?, ?, ?, ?);");
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            $query->bindValue(1, $username);
            $query->bindValue(2, $email);
            $query->bindValue(3, $hashedpassword);
            $query->bindValue(4, time());

            $query->execute();

            $query = $pdo->prepare("SELECT * FROM users WHERE username=? OR email=?;");
            $query->bindValue(1, $username);
            $query->bindValue(2, $email);
            $query->execute();

            $rowCount = $query->rowCount();

            if($rowCount > 0){
                $row = $query->fetch();

                session_start();
                $_SESSION["userID"] = $row["userID"];
                $_SESSION["username"] = $row["username"];

                
                $query = $pdo->prepare("INSERT INTO profiles(userID, name) VALUES(?, ?)");
                $query->bindValue(1, $_SESSION["userID"]);
                $query->bindValue(2, $_SESSION["username"]);
                $query->execute();

                if(isset($_SESSION["user"])){
                    $userSession = $_SESSION["user"];
                    header("Location: ../profile.php?user=$userSession");
                    exit();
                }
                else{

                    header("Location: ../edit-profile.php?signup=success");
                    exit();
                }
            }

            header("Location: javascript://history.go(-1)");
            exit();
        }
    }
}
else{
    header("Location: javascript://history.go(-1)");
    exit();
}