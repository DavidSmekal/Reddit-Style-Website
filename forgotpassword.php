<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/topics.css">
    <title>Topic 1</title>
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
    <h1>Forgot Password</h1>
</div>
<!-- This is where the body of the page will be -->
<div class="page_body">

    <div id="login">
        <form action="php/forgotPasswordScript.php" method="post">
            <label>Enter your email</label><br>
            <input type="email" name="email" id="email" class="textfields" placeholder="Email"><br>
            <input type="submit" class="textfields" value="Submit"><br>
        </form>
    </div>
    <!-- Post a comment div -->

</div>
<!-- This is the side column on the right -->
<div id="right_column">
    <div id="search_and_post">
        <form action="searchResults.php" method="post">
            <input class="textfields" type="text" name="search" placeholder="Search...">
        </form>
        <form action="makepost.php">
            <input type="submit" class="textfields" value="Make New Post" />
        </form>
    </div>
    <div id="trending_posts">
        <h4>Popular Posts</h4>
        <hr>
        <a href="#">Popular Post 1</a><br><br>
        <a href="#">Popular Post 2</a><br><br>
        <a href="#">Popular Post 3</a><br><br>
        <h4>Latest Posts</h4>
        <hr>
        <a href="#">Latest Post 1</a><br><br>
        <a href="#">Latest Post 2</a><br><br>
        <a href="#">Latest Post 3</a><br><br>
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
