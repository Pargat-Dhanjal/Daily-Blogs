<?php
//connect to database
include('../scripts/connection.php');
//start the session
session_start();

//check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // $result = $conn->query('SELECT * FROM blogs');
    $result = $conn->query('SELECT * FROM blogs ORDER BY date_of_upload DESC');
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
    <link rel="stylesheet" href="../styles/search.css ">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="../scripts/script.js"></script>
</head>

<body>
    <div class="parent">
        <div class="navbar">
            <nav>
                <ul>
                    <div class="icons top-icons">
                        <li class="nav-buttons">
                            <a href="home.php">
                                <i class="fa-solid fa-house fa-xl"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-buttons">
                            <a href="search.php" class="selected">
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
        <div class="main">
            <div class="wrapper">
                <form action="../scripts/searchQuery.php" method="POST">
                    <div class="input-field">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <label for="text" class="form__label">Search</label>
                        <input type="text" name="search" placeholder="Enter your search here" required id="search-box">
                    </div>
                </form>
                <div class="page-title">
                    <div class="line"></div>
                    <h1>Search Results</h1>
                </div>
                <div id="search-results"></div>
            </div>
        </div>
    </div>
    <script>
        function search() {
            const query = this.value.trim();
            const container = document.querySelector('#search-results');

            if (query.length < 3) {
                container.innerHTML = '';
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../scripts/searchQuery.php');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    container.innerHTML = xhr.responseText;
                } else {
                    console.error(xhr.statusText);
                }
            };
            xhr.onerror = function() {
                console.error(xhr.statusText);
            };
            xhr.send(`search=${query}`);
        }
        const searchBox = document.querySelector('#search-box');
        searchBox.addEventListener('input', search);
    </script>
</body>

</html>