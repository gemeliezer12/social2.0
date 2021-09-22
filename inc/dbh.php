<?php
session_start();
try{
    $pdo = new PDO("mysql:host=localhost;dbname=social", "root", "");
}
catch(PDOException $e){
    exit("Database error.");
}