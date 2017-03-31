<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $postID = $_POST['postID'];

    $board = $_POST['board'];

    $host = "localhost";
    $database = "finalproject360";
    $user = "root";
    $password = "";

    $connection = mysqli_connect($host, $user, $password, $database);

    $error = mysqli_connect_error();
    if ($error != null) {
        $output = "<p>Unable to connect to database!</p>";
        exit($output);
    } else {
        //good connection, so do you thing

        if ($board == 'blogpost1'){
            $sql = "UPDATE blogpost1 SET vote=vote+1 WHERE postID='$postID';";
            mysqli_query($connection, $sql);
        }

        if ($board == 'blogpost2'){
            $sql = "UPDATE blogpost2 SET vote=vote+1 WHERE postID='$postID';";
            mysqli_query($connection, $sql);
        }

        if ($board == 'blogpost3'){
            $sql = "UPDATE blogpost3 SET vote=vote+1 WHERE postID='$postID';";
            mysqli_query($connection, $sql);
        }







    }

}