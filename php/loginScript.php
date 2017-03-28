<?php
session_start();

//logging out
if (isset($_GET['action']) and $_GET['action']=='logout'){

    session_destroy();
    echo "user has logged off";
    header("Location: ". $_SERVER['HTTP_REFERER']);

    exit();
}

if (isset($_SESSION['username'])){
    //user is logged in
    header("Location: http://localhost/finalproject360/homepage.php");
    exit;
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (
        empty($_POST["username1"]) &&
        empty($_POST["password3"])
    ) {
        echo "You need to fill in the form.";

    }



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
        //good connection, so do you thing
        $sql = "SELECT * FROM users;";


        //need to get the hash of the incoming POST password
        $hashedPassword = md5($_POST["password3"]);

        //boolean to trigger invalid echo statement
        $confirmation = false;

        $results = mysqli_query($connection, $sql);

        //and fetch results
        while ($row = mysqli_fetch_assoc($results))
        {


            if (($_POST["username1"] == $row['username']) &&  ($hashedPassword == $row['password'])) {

                $confirmation = true;

                $userForSession = $_POST["username1"];
                //creating new session superglobal for username
                $_SESSION['username'] = $userForSession;

                header('Location: http://localhost/finalproject360/homepage.php');
                break;

            }


        }
        if (!($confirmation)){
            echo "Username and/or password are invalid";
            echo "<br><a href='../login.php'>Click here to go back</a>";
        }


    }



    mysqli_free_result($results);
    mysqli_close($connection);





}