<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {


$email = $_POST['email'];

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


        $results = mysqli_query($connection, $sql);


        //and fetch results
        while ($row = mysqli_fetch_assoc($results))
        {

            //checks if email exists in the database. If it does, do what's in the if statement
            if ($row['email'] == $email){


                    //I think I have to be on a server for this to work
                        $to      = $email;
                        $subject = 'the subject';
                        $message = 'hello';
                        $headers = 'From: webmaster@example.com' . "\r\n" .
                            'Reply-To: webmaster@example.com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();

                        mail($to, $subject, $message, $headers);

                        //Bbut i think ini_set() helps you to change the values in php.ini during run time.


            }







        }


    }



    mysqli_free_result($results);
    mysqli_close($connection);





}