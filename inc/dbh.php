<?php
session_start();

try{
    $pdo = new PDO("mysql:host=localhost;dbname=social", "root", "");
}
catch(PDOException $e){
    exit("Database error.");
}

// session_start();

// try{
//     $pdo = new PDO("mysql:host=localhost;dbname=id17159123_social", "id17159123_root", "Du5nV^|oHCSW^pYW");
// }
// catch(PDOException $e){
//     exit("Database error.");
// }
