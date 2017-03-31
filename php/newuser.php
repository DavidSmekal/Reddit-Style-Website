<?php

session_start();

if (isset($_SESSION['username'])) {
//user is not logged in
    header("Location: http://localhost/finalproject360/homepage.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"]) &&
        empty($_POST["email"]) &&
        empty($_POST["password1"]) &&
        empty($_POST["password2"])

    ) {
        echo "You need to fill in the form.";

    }

    $image = false;

    //if user doesn't want to upload a picture to their profile, the whole uploading picture won't run

if (!(empty($_POST["userImage"]))){
    $image = True;
}
if ($image) {

    //majority of the code taken from https://www.w3schools.com/php/php_file_upload.asp
/////////////////////////starting file upload php script
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["userImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["userImage"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            header("Location: http://localhost/finalproject360/errorPage.php?errorMessage=" . urlencode("File is not an image."));
            $uploadOk = 0;
        }
    }
// Check file size
    if ($_FILES["userImage"]["size"] > 100000) {
        header("Location: http://localhost/finalproject360/errorPage.php?errorMessage=" . urlencode("Sorry, your file is too large."));
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif") {
        header("Location: http://localhost/finalproject360/errorPage.php?errorMessage=" . urlencode("Sorry, only JPG, PNG & GIF files are allowed."));
        $uploadOk = 0;
    }
}

    /////////////////////finished file upload php script

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
        //good connection, so do you thing
        $sql = "SELECT * FROM users;";




        $results = mysqli_query($connection, $sql);



            //and fetch requsults
            while ($row = mysqli_fetch_assoc($results)) {


                if (($_POST["username"] == $row['username']) || ($_POST["password1"] == $row['password'])) {
                    header("Location: http://localhost/finalproject360/errorPage.php?errorMessage=" . urlencode("User already exists with this name and/or email."));

                }
            }


                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = md5($_POST["password1"]);


                $sql2 = "INSERT INTO users (username, email, password, blocked) VALUES ('$username', '$email', '$password', 'no');";


                if (mysqli_query($connection, $sql2)) {
                    $count = mysqli_affected_rows($connection);


                        if ($image) {

                            //retrieve the user's userID
                            $userId = "SELECT userID from users WHERE username ='$username'";


                            $results = mysqli_query($connection, $userId);

                            $row = mysqli_fetch_assoc($results);


                            $userIdnumber = $row['userID'];


                            //enter image into database
                            $imagedata = file_get_contents($_FILES['userImage']['tmp_name']);

                            $sql = "INSERT INTO userImages (userID, contentType, image) VALUES(?,?,?)";

                            $stmt = mysqli_stmt_init($connection);

                            mysqli_stmt_prepare($stmt, $sql);

                            $null = NULL;

                            mysqli_stmt_bind_param($stmt, "isb", $userIdnumber, $imageFileType, $null);

                            mysqli_stmt_send_long_data($stmt, 2, $imagedata);

                            $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));

                            mysqli_stmt_close($stmt);
                        }
                        // after user registered, create a session so the user remains logged in
                        $_SESSION['username'] = $username;

                    header("Location: http://localhost/finalproject360/homepage.php");

                }

        }



    mysqli_free_result($results);
    mysqli_close($connection);




}