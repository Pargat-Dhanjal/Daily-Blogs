<?php
    //connect to database
    include('../scripts/connection.php'); 
    //start the session
    session_start();

    //check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        //if not logged in, redirect to login page
        header('Location: login.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Blogs</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/home.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="parent">
        <div class="navbar">
            <nav>
                <ul>
                    <div class="icons top-icons">
                        <li class="nav-buttons">
                            <a href="home.html" class="selected">
                                <i class="fa-solid fa-house fa-xl"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-buttons">
                            <a href="search.html">
                                <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                                <p>Search</p>
                            </a>
                        </li>
                        <li class="nav-buttons">
                            <a href="trending.html">
                                <i class="fa-solid fa-arrow-trend-up fa-xl"></i>
                                <p>Trending</p>
                            </a>
                        </li>
                    </div>
                    <div class="icons bottom-icons">
                        <li class="nav-buttons">
                            <a href="create.html">
                                <i class="fa-solid fa-plus fa-xl"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </div>
                </ul>
            </nav>
        </div>
        <div class="main">
            <div class="page-title">
                <div class="line"></div>
                <h1>Latest</h1>
            </div>
            <div class="blog-wrapper">
                <div class="left-div">
                    <div class="date">
                        31
                        MAY
                    </div>
                    <div class="username-div">
                        <h4 class="username">
                            @its.beetoot
                        </h4>
                    </div>
                </div>
                <div class="right-div">
                    <div class="title">
                        <h2>The Most Useful Twitter Bots</h2>
                    </div>
                    <div class="blog">
                        <div class="content">
                            <p class="description">
                                An open-source Twitter bot that lets you easily set reminders for public tweets.
                                Mention
                                "@RemindMe_OfThis" in the reply of any tweet and specify the time in natural English
                                when you would like to reminded of that tweet.
                                You could say things like in 2 days or in 12 hours or next week or even in 5 years.
                                Check out the source on Github.
                                An open-source Twitter bot that lets you easily set reminders for public tweets.
                                Mention
                            </p>
                            <a class="readmore" href="./blog.html">read more . . .</a>
                            <div class="tags">
                                <a>#meditation</a>
                                <a>#meditation</a>
                            </div>
                        </div>
                        <div class="image">
                            <img src="https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg"alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>