<?php
    //connect to database
    include('../scripts/connection.php'); 
    //start the session
    session_start();

    //check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $blogid = $_GET['blogid'];
        $query = "SELECT * FROM blogs WHERE blogid = $blogid";
        $result = $conn->query($query);
        $result2 = $conn->query("SELECT u.username FROM users u JOIN blogs b ON b.userid = u.userid WHERE b.blogid = $blogid");
        $user = mysqli_fetch_assoc($result2);
        $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if($_SESSION['user_id'] != $blogs[0]['userid']){
            $query2 = "UPDATE blogs SET clicks = clicks + 1 WHERE blogid = $blogid";
            $conn->query($query2);
            
        }
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
    <link rel="stylesheet" href="../styles/blog.css">

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
                                <i class="fa-solid fa-chevron-left fa-lg"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-buttons">
                            <a href="search.php">
                                <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                                <p>Search</p>
                            </a>
                        </li>
                        <li class="nav-buttons">
                            <a href="trending.php">
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
                    <div class="icons">
                        <li class="nav-buttons">
                            <?php
                            echo '<a href="./profile.php?userid=' . $user_id . '">
                                <i class="fa-solid fa-user fa-xl"></i>
                                <p>Profile</p>
                            </a>';
                            ?>
                        </li>
                    </div>
                </ul>
            </nav>
        </div>
        <?php
            $date = date('d', strtotime($blogs[0]['date_of_upload']));
            $month = date('m', strtotime($blogs[0]['date_of_upload']));
            $year = date('y', strtotime($blogs[0]['date_of_upload']));

            $hashtagArray = unserialize($blogs[0]['hashtags']);

            $array = array('January' , 'February' , 'March' ,'April' , 'May' , 'June' , 'July' , 'August' , 'September' , 'October' , 'November' , 'December');
            $month = $array[$month - 1];
            echo '
            <div class="main">
                <div class="page-title">
                    <h1>'.$blogs[0]['title'].'</h1>
                    <div class="page-info">
                        <p>Written by <a href="./user.php?userid=' . $blogs[0]['userid'] . '">'.$user['username'].'</a></p>
                        <p>on '. $date .'th '. $month .' 20'. $year.'</p>
                    </div>
                    <div class="tags">';
                        foreach($hashtagArray as $hashtag){
                            echo '<a>#' . $hashtag . '</a> ';
                        }
                    echo
                    '</div>
                </div>
                <div>
                    <div class="blog">
                        <div class="blog-img">
                            <img src="../images/blog_data/' . $blogs[0]['blogid'] .'.png" alt="Image">
                        </div>
                        <div class="content">
                            <p class="description">'.$blogs[0]['content'].'</p>
                        </div>
                    </div>
                </div>
            </div>'
        ?>
    </div>
</body>

</html>