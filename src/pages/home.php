<?php
    //connect to database
    include('../scripts/connection.php'); 
    //start the session
    session_start();

    //check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $result = $conn->query('SELECT * FROM blogs');
        $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                            <a href="home.php" class="selected">
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
                            <a href="create.php">
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
            <?php
                foreach ($blogs as $blog){
                    $date = date('d', strtotime($blog['date_of_upload']));
                    $month = date('m', strtotime($blog['date_of_upload']));
                    if($month == 1){
                        $month = 'Jan';
                    }
                    if($month == 2){
                        $month = 'Feb';
                    }
                    if($month == 3){
                        $month = 'Mar';
                    }
                    if($month == 4){
                        $month = 'Apr';
                    }
                    if($month == 5){
                        $month = 'May';
                    }
                    if($month == 6){
                        $month = 'Jun';
                    }
                    if($month == 7){
                        $month = 'Jul';
                    }
                    if($month == 8){
                        $month = 'Aug';
                    }
                    if($month == 9){
                        $month = 'Sep';
                    }
                    if($month == 10){
                        $month = 'Oct';
                    }
                    if($month == 11){
                        $month = 'Nov';
                    }
                    if($month == 12){
                        $month = 'Dec';
                    }
                    
                    // get the blog id of the current blog
                    $blogid = $blog['blogid'];
                    // get the username of the user who uploaded the blog
                    $result2 = $conn->query("SELECT u.username FROM users u JOIN blogs b ON b.userid = u.userid WHERE b.blogid = $blogid");
                    $user = mysqli_fetch_assoc($result2);

                    echo '
                    <div class="blog-wrapper">
                    <div class="left-div">
                        <div class="date">'
                        . $date .
                        '<br>'
                        . $month .
                    '</div>
                        <div class="username-div">
                            <h4 class="username">
                                @' . $user['username'] .
                            '</h4>
                        </div>
                    </div>
                    <div class="right-div">
                        <div class="title">
                            <h2>'. $blog['title'] .'</h2>
                        </div>
                        <div class="blog">
                            <div class="content">
                                <p class="description">'
                                    . $blog['content'] .
                                '</p>
                                <a class="readmore" href="./blog.html">read more . . .</a>
                                <div class="tags">
                                    <a>#meditation</a>
                                    <a>#meditation</a>
                                </div>
                            </div>
                            <div class="image">
                            <img src="../images/blog_data/' . $blog['blogid'] .'.png"/> 
                            </div>
                        </div>
                    </div>
                </div>
                    ';
                }
            ?>
        </div>
    </div>
</body>
</html>