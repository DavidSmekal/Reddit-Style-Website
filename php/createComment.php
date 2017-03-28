<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //retrieves the post's content
    $content = $_POST['content'];
    //retrieves the board number
    $title = $_POST['title'];

    //I need to get the post type



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

        //need to change this with sessions later!!
        $session_user = $_SESSION['username'];

        //this will post the content into whichever database that was selected by the user
        if ($board == 'Topic 1'){

            $sql2 = "INSERT INTO blogpost1 (title, content, date, username) VALUES ('$title', '$content', now(), '$session_user');";

            if (mysqli_query($connection, $sql2)) {
                $count = mysqli_affected_rows($connection);
                echo "Post has been added into topic 1";

            }

        }

        if ($board == 'Topic 2'){

            $sql2 = "INSERT INTO blogpost2 (title, content, date, username) VALUES ('$title', '$content', now(), '$session_user');";

            if (mysqli_query($connection, $sql2)) {
                $count = mysqli_affected_rows($connection);
                echo "Post has been added into topic 2";

            }

        }
        if ($board == 'Topic 3'){

            $sql2 = "INSERT INTO blogpost3 (title, content, date, username) VALUES ('$title', '$content', now(), '$session_user');";

            if (mysqli_query($connection, $sql2)) {
                $count = mysqli_affected_rows($connection);
                echo "Post has been added into topic 3";

            }

        }




    }


    mysqli_close($connection);


}

