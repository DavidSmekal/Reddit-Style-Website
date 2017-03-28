<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $city = $_POST["city"];
    $email = $_POST["email"];




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
    else
    {
        //getting the username from the session
        $username = $_SESSION['username'];

        //good connection, so do you thing
        $sql = "SELECT * FROM users where username='$username';";






        $results = mysqli_query($connection, $sql);

        //create the variables

        //and fetch requsults
        while ($row = mysqli_fetch_assoc($results))
        {



            $sql2 = "UPDATE users SET firstname='$firstName', lastname='$lastName', city='$city', email='$email' WHERE username='$username';";



            if (mysqli_query($connection, $sql2)){
                $count = mysqli_affected_rows($connection);
                header("Location: http://localhost/finalproject360/profile.php");
            }


        }


    }



    mysqli_free_result($results);
    mysqli_close($connection);





}