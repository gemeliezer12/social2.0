<?php
if(isset($_GET["search"])){
    $search = $_GET["search"];
    header("Location: ../search.php?search=$search");
}