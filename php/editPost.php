<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // retrieves the content in the edit page
    $content = $_POST["content"];
    // need to retrieve postId
    $postId = $_POST["id2"];
    //need to retrieve board
    $board = $_POST["board2"];


    $host = "localhost";
    $database = "finalproject360";
    $user = "root";
    $password = "";

    $connection = mysqli_connect($host, $user, $password, $database);

    $error = mysqli_connect_error();
    if($error != null)
    {
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
    }
    else {


        if ($board == 'blogpost1') {
            $sql2 = "UPDATE blogpost1 SET content='$content', date=now() WHERE postID='$postId';";


            if (mysqli_query($connection, $sql2)) {
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/topic1.php");
            }

        }
        if ($board == 'blogpost2') {
            $sql2 = "UPDATE blogpost2 SET content='$content', date=now() WHERE postID='$postId';";


            if (mysqli_query($connection, $sql2)) {
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/topic2.php");
            }

        }
        if ($board == 'blogpost3') {
            $sql2 = "UPDATE blogpost2 SET content='$content', date=now() WHERE postID='$postId';";


            if (mysqli_query($connection, $sql2)) {
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/topic3.php");
            }

        }


    }




}