<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="css/topics.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <title>Topic 3</title>
</head>

<!-- ajax call to vote -->
<script>
    function upvote(postId){

        $.ajax({
            url: "php/upvote.php",
            type:"post",
            data:{
                postID : postId,
                board: 'blogpost3'
            },

            success: function(result){
                $(".page_body").load(location.href+" .page_body>*","");

            }
        });
    }

    function downvote(postId){

        $.ajax({
            url: "php/downvote.php",
            type:"post",
            data:{
                postID : postId,
                board: 'blogpost3'
            },

            success: function(result){
                $(".page_body").load(location.href+" .page_body>*","");

            }
        });
    }
</script>

<body>
<ul>
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
</ul>
<div id="headline">
    <h1>Conservative</h1>
</div>
<!-- This is where the body of the page will be -->
<div class="page_body">
    <!-- Post content -->

    <!--  <div id="topOfDiv">
           <a href="#">Username &nbsp;</a>
           <a href="#">Date</a>
       </div>  -->
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

        $sql2 = "SELECT * FROM blogpost3";

        $results2 = mysqli_query($connection, $sql2);

        echo '<br>';
        echo '<br>';

        while ($row2 = mysqli_fetch_assoc($results2)){

            $title = $row2['title'];
            $content = $row2['content'];
            $date = $row2['date'];
            $username = $row2['username'];
            $postID = $row2['postID'];
            $postVote = $row2['vote'];

            echo '<br>';
            echo '<div id="topOfDiv">';
            echo "<a href=\"#\">$username</a>&nbsp;&nbsp;";
            echo "<br><p>Posted: $date</p>";
            echo '</div>';
            echo "<div id=\"placeholder_for_content\">";
            echo "<div class=inlineBlock>";
            echo "<input type='image' src='images/upvote.png' HEIGHT='20' WIDTH='20' name='saveForm' class='btTxt submit' onclick=upvote('$postID') />";
            echo "<input type='image' src='images/downvote.png' HEIGHT='20' WIDTH='20' name='saveForm' class='btTxt submit' onclick=downvote('$postID') />";
            echo "<h1>$postVote</h1>";
            echo "</div>";
            echo "<div class='inlineBlock centered'>";
            echo "<p><a href=\"#\">$title</a></p>";
            echo "<p>$content</p><br>";
            echo "</div>";


            //admin delete post

            if (isset($_SESSION['username']) && ($_SESSION['username'] == 'admin' || $_SESSION['username'] == $username)) {
                echo "<div id='adminpannel'>";
                echo '<form id="delete" method="post" action="php/deletePost_and_commentPost.php">';
                echo "<input type='hidden' name='id' value=$postID>";
                echo "<input type='hidden' name='board' value='blogpost3'>";
                echo '<input type="submit" name="delete" value="Delete"/>';
                echo '</form>';
                echo "</div>";
            }

            //admin edit post
            if (isset($_SESSION['username']) &&( $_SESSION['username'] == 'admin'|| $_SESSION['username'] == $username)) {
                echo "<div id='adminpannel'>";
                echo '<form id="edit" method="post" action="editPostPage.php">';
                echo "<input type='hidden' name='id2' value=$postID>";
                echo "<input type='hidden' name='board2' value='blogpost3'>";
                echo '<input type="submit" name="edit" value="Edit"/>';
                echo '</form>';
                echo "</div>";
            }

            echo "</div>";

            if (!(isset($_SESSION['username']))) {
                echo "<br>";
            }

            //sql query should go to get the comments
            $sql3 = "SELECT * FROM commentspost3";

            $results3 = mysqli_query($connection, $sql3);



            while ($row3 = mysqli_fetch_assoc($results3)) {

                $content = $row3['content'];
                $postIDrow = $row3['postID'];
                $username = $row3['username'];
                $commentID = $row3['commentId'];
                //retrieves the postID.
                if ($postIDrow == $postID) {

                    echo '<div id="post_comment">';
                    echo "<a href=\"#\">$username</a>&nbsp;&nbsp;";
                    echo "<p>$content</p>";
                    if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {

                        echo '<form id="delete" method="post" action="php/deletePost_and_commentPost.php">';
                        echo "<input type='hidden' name='board' value='blogpost1'>";
                        echo "<input type='hidden' name='commentID' value=$commentID>";
                        echo '<input type="submit" name="delete" value="Delete Comment"/>';

                    }
                    echo '</div>';

                }

            }

            //comment post will only show up if user is logged in
            if (isset($_SESSION['username'])) {

                echo '<div id="post_comment">';
                echo '<form action="php/deletePost_and_commentPost.php" method="post">';
                echo '<input type="text" name="comment_content" class="textfields" placeholder="Comment"><br>';
                echo "<input type='hidden' name='comment_id' value=$postID>";
                echo "<input type='hidden' name='comment_board' value='blogpost3'>";
                echo '<input type="submit" name="delete" value="Post">';
                echo '</form>';
                echo '</div><br>';
            }

        }

    }

    mysqli_free_result($results2);
    mysqli_close($connection);

    ?>




    <!-- Post a comment div -->

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

            $sql2 = "SELECT * FROM blogpost1  UNION SELECT * FROM blogpost2 UNION SELECT * FROM blogpost3 ORDER BY vote DESC limit 3";

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
