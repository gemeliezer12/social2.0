<?php
include "inc/dbh.php";
include "class/user.php";
include "class/profile.php";
include "class/relationship.php";
// include "class/post.php";
// include "class/comment.php";
include "class/article.php";
include "class/post-interaction.php";
include "class/comment-interaction.php";
include "class/time.php";
include "class/search.php";

// session_unset();



$user = new User;
$profile = new Profile;
$relationship = new Relationship;
// $post = new Post;
// $comment = new Comment;
$article = new Article;
$postInteraction = new PostInteraction;
$commentInteraction = new CommentInteraction;
$time = new Time;
$search = new Search;

date_default_timezone_set('Asia/Manila');

if(isset($_SESSION["userID"])){
    $selfUserData = $user->fetchData($_SESSION["userID"]);
    $selfProfileData = $profile->fetchData($_SESSION["userID"]);
    $selfFollowings = $relationship->fetchFollowing($_SESSION["userID"]);
}
?>

<!DOCTYPE html>
<html lang="en" class="preload">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/lib/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <title style="display: none;">Document</title>
</head>

<script>
    $(window).load(function() {
        $("body").removeClass("preload");
        var selection = window.getSelection();
    });
</script>