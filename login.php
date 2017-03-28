<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="scripts/login.js"></script>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Login</title>
</head>

<body id="mainForm">

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
        <h1>Login</h1>
    </div>

    <div class="page_body">
        <div id="loginforms">
            <div id="signup">
                <form action="php/newuser.php" method="post" enctype="multipart/form-data">
                    <label>Sign up</label><br>
                    <input type="text" name="username" id= "username" class="textfields" placeholder="Username"><br>
                    <input type="email" name="email" id="email" class="textfields" placeholder="Email"><br>
                    <input type="password" name="password1" id="password1" class="textfields" placeholder="Password"><br>
                    <input type="password" name="password2" id="password2" class="textfields" placeholder="Password again"><br>
                    <input type="file" name="userImage" id="userImage" class="required"><br>
                    <input type="submit" class="textfields" value="Sign up">
                </form>
            </div>

            <div id="login">
                <form action="php/loginScript.php" method="post">
                    <label>Login</label><br>
                    <input type="text" name="username1" id="username1" class="textfields" placeholder="Username"><br>
                    <input type="password" name="password3" id="password3" class="textfields" placeholder="Password"><br>
                    <input type="submit" class="textfields" value="Login"><br>
                    <a href="#">Forgot password</a>
                </form>
            </div>
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

