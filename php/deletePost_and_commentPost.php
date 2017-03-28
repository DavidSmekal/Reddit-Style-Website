<?php
session_start();

if (($_SERVER["REQUEST_METHOD"] == "POST") && (($_POST['delete']) == 'Delete') && ( $_SESSION['username'] == 'admin')) {


    $getPostId = $_POST['id'];
    $getBoard = $_POST['board'];


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

        if ($getBoard == 'blogpost1'){

            $sql = "DELETE FROM blogpost1  WHERE postID='$getPostId'";


            if (mysqli_query($connection, $sql)) {
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/topic1.php");

            }


        }

        if ($getBoard == 'blogpost2'){

            $sql = "DELETE FROM blogpost2 WHERE postID='$getPostId'";


            if (mysqli_query($connection, $sql)) {
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/topic2.php");


            }


        }
        if ($getBoard == 'blogpost3'){

            $sql = "DELETE FROM blogpost3 WHERE postID='$getPostId'";


            if (mysqli_query($connection, $sql)) {
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/topic3.php");

            }


        }

    }

    mysqli_close($connection);

}
elseif (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST['delete'] == 'Post')) {


    $content = $_POST['comment_content'];
    $board = $_POST['comment_board'];
    $postID = $_POST['comment_id'];

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



        $session_user = $_SESSION['username'];

        //this will post the content into whichever database that was selected by the user
        if ($board == 'blogpost1'){

            $sql2 = "INSERT INTO commentspost1 (content, date, username, postID) VALUES ('$content', now(), '$session_user', '$postID');";

            if (mysqli_query($connection, $sql2)) {
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/topic1.php");

            }

        }

        if ($board == 'blogpost2'){

            $sql2 = "INSERT INTO commentspost2 (content, date, username, postID) VALUES ('$content', now(), '$session_user', '$postID');";

            if (mysqli_query($connection, $sql2)) {
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/topic2.php");

            }

        }
        if ($board == 'blogpost3'){

            $sql2 = "INSERT INTO commentspost3 (content, date, username, postID) VALUES ('$content', now(), '$session_user', '$postID');";

            if (mysqli_query($connection, $sql2)) {
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/topic3.php");

            }

        }




    }


    mysqli_close($connection);


}


