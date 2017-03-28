<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {




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
        //I WILL HAVE TO CHANGE THIS TO THE CURRENT SESSION
        $username = $_SESSION['username'];

        //good connection, so do you thing
        $sql = "SELECT * FROM users where username='$username';";






        $results = mysqli_query($connection, $sql);

        //create the variables

        //and fetch requsults
        while ($row = mysqli_fetch_assoc($results))
        {


                $firstName = $_POST["firstname"];
            $lastName = $_POST["lastname"];
            $city = $_POST["city"];
            $email = $_POST["email"];



            $sql2 = "UPDATE users SET firstname='$firstName', lastname='$lastName', city='$city', email='$email' WHERE username='$username';";



            if (mysqli_query($connection, $sql2)){
                $count = mysqli_affected_rows($connection);
                echo "Update successful";
            }


        }


    }



    mysqli_free_result($results);
    mysqli_close($connection);





}