<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];

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


        $sql = "UPDATE users SET blocked='no' WHERE username='$username';";


        if (mysqli_query($connection, $sql)) {
            $count = mysqli_affected_rows($connection);
            header("Location: http://localhost/finalproject360/administratorPage.php");

        }


    }

}