<?php
session_start();
if (!(isset($_SESSION['username']))){
//user is not logged in
header("Location: http://localhost/finalproject360/login.php");
exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <title>Profile</title>
</head>

<body>

<ul>
    <li><a href="homepage.php">Home</a></li>
    <li><a href="topic1.php">Liberal</a></li>
    <li><a href="topic2.php">Libertarian</a></li>
    <li><a href="topic3.php">Conservative</a></li>
    <?php if(isset($_SESSION['username'])){ ?>
        <li class="float_right"><a href="php/loginScript.php?action=logout">Logout</a></li>
    <?php }else{ ?>
        <li class="float_right"><a href="login.php">Login</a></li>
    <?php } ?>
    <li class="float_right"><a href="profile.php">Profile</a></li>
    <li class="float_right"><a href="makepost.php">Make Post</a></li>
    <?php if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin'){ ?>
        <li class="float_right"><a href="administratorPage.php">Administrator</a></li>
    <?php } ?>
</ul>

    <div id="headline">
        <h1>Profile: User profile</h1>

    </div>

    <!-- This is where the body of the page will be -->
    <div class="page_body" id="page_body_profile">
        <div id="page_body_left">
            <h2>Profile Image</h2>
<?php

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

        //getting the username from the post
        $username = $_SESSION['username'];

        $results = mysqli_query($connection, $sql);

        //and fetch results
        while ($row = mysqli_fetch_assoc($results))
        {

            if ($username == $row['username']){


                $sql2 = "SELECT * FROM users WHERE username='$username'";

                $results2 = mysqli_query($connection, $sql2);

                $row2 = mysqli_fetch_assoc($results2);


                $email = $row2['email'];
                $username = $row2['username'];
                $firstname = $row2['firstname'];
                $lastname = $row2['lastname'];
                $city = $row2['city'];
                $userID = $row2['userID'];


                //retrieving the image from the database

                $sql = "SELECT contentType, image FROM userImages where userID=?";

                $stmt = mysqli_stmt_init($connection);

                mysqli_stmt_prepare($stmt, $sql);

                mysqli_stmt_bind_param($stmt, "i", $userID);

                $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));

                mysqli_stmt_bind_result($stmt, $type, $image);

                mysqli_stmt_fetch($stmt);

                mysqli_stmt_close($stmt);




                echo "<fieldset>";
                echo "<legend>User: $username</legend>";
                echo "First Name: $firstname<br>";
                echo "Last Name: $lastname<br>";
                echo "City: $city<br>";
                echo "Email: $email<br>";

                echo "</fieldset>";

                echo '<img src="data:image/'.$type.';base64,'.base64_encode($image).'"/>';


            }

        }



    }



    mysqli_free_result($results);
    mysqli_close($connection);


?>
        </div>
        <div id="page_body_right">
            <form action="php/profile.php" method="post">
                <label>Personal Information</label><br>
                <input type="text" name="firstname" placeholder="First Name"><br>
                <input type="text" name="lastname" placeholder="Last Name"><br>
                <input type="text" name="city" placeholder="City"><br>
                <input type="email" name="email" placeholder="Email"><br>
                <input type="submit" value="Update">
            </form>
        </div>

    </div>

    <!-- This is the side column on the right -->
<div id="right_column">
    <div id="search_and_post">
        <form action="searchResults.php" method="post">
            <input class="textfields" type="text" name="search" placeholder="Search...">
        </form>
        <form action="makepost.php">
            <input type="submit" class="textfields" value="Make New Post"/>
        </form>
    </div>
    <div id="trending_posts">
        <h4>Popular Posts</h4>
        <hr>
        <?php

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

            $sql2 = "SELECT * FROM blogpost1 UNION SELECT * FROM blogpost2 UNION SELECT * FROM blogpost3 ORDER BY rand() LIMIT 3";

            $results2 = mysqli_query($connection, $sql2);


            while ($row2 = mysqli_fetch_assoc($results2)) {

                $popular = $row2['title'];

                echo "<a href='#'>$popular</a><br><br>";


            }

        }

        mysqli_free_result($results2);
        mysqli_close($connection);

        ?>
        <h4>Latest Posts</h4>
        <hr>

        <?php

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

            $sql2 = "SELECT * FROM blogpost1 UNION SELECT * FROM blogpost2 UNION SELECT * FROM blogpost3 ORDER BY date DESC LIMIT 3";

            $results2 = mysqli_query($connection, $sql2);


            while ($row2 = mysqli_fetch_assoc($results2)) {

                $latest = $row2['title'];


                echo "<a href='#'>$latest</a><br><br>";


            }

        }

        mysqli_free_result($results2);
        mysqli_close($connection);

        ?>

    </div>
</div>
<footer>
    <a href="#">Home</a> |
    <a href="#">Browse</a> |
    <a href="#">Search</a> |
    <a href="#">About Us</a> |
    <a href="#">Contact Us</a>
    <p><i>Copyright 2017 David Smekal</i></p>
</footer>
</body>

</html>

