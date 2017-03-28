<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $content = $_POST['content'];
    $title = $_POST['title'];
    $board = $_POST['continent'];


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
            if ($board == 'Liberal'){

                $sql2 = "INSERT INTO blogpost1 (title, content, date, username) VALUES ('$title', '$content', now(), '$session_user');";

                if (mysqli_query($connection, $sql2)) {
                    $count = mysqli_affected_rows($connection);
                    header("Location: http://localhost/finalproject360/topic1.php");

                }

            }

        if ($board == 'Libertarian'){

            $sql2 = "INSERT INTO blogpost2 (title, content, date, username) VALUES ('$title', '$content', now(), '$session_user');";

            if (mysqli_query($connection, $sql2)) {
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/topic2.php");

            }

        }
        if ($board == 'Conservative'){

            $sql2 = "INSERT INTO blogpost3 (title, content, date, username) VALUES ('$title', '$content', now(), '$session_user');";

            if (mysqli_query($connection, $sql2)) {
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/topic3.php");

            }

        }




    }


    mysqli_close($connection);


}

