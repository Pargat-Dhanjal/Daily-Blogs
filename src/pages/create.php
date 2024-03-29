<?php
//connect to database
include('../scripts/connection.php');
//start the session
session_start();

//check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // $result = $conn->query('SELECT * FROM blogs');
    $result = $conn->query('SELECT * FROM blogs ORDER BY clicks DESC');
    $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    //if not logged in, redirect to login page
    header('Location: index.php');
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
    <link rel="stylesheet" href="../styles/create.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                            <a href="create.php" class="selected">
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
            <div class="page-title">
                <div class="line"></div>
                <h1>Create</h1>
            </div>
            <div class="details">
                <form action="../scripts/upload.php" method="POST" enctype="multipart/form-data" style="display:inline;">
                    <input type="text" name="title" class="input" placeholder="Write your title here......">
                    <div class="blog-img">
                        <label for="file" id="output-label">
                            <img src="../images/img-upload.svg" alt="Image-upload" id="output">
                        </label>
                        <span style="color: gray;">Upload an image</span>
                        <input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none; width: 100vh;">
                    </div>
                    <textarea name="content" id="content" class="input" placeholder="Write your content here......"></textarea>
                    <input type="text" name="hashtags" id="hashtags" autocomplete="off" placeholder="Type your hashtags and press space">
                    <div class="tag-container">
                    </div>
                    <button id="publish-btn" type="submit" class="btn">PUBLISH</button>
                </form>
                <button id="save-draft-btn" class="neu-btn">SAVE DRAFT</button>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        var loadFile = function(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("output");
                preview.src = src;
                preview.style.width = "20rem";
                preview.style.height = "auto"; // Preserve aspect ratio of the image
                preview.style.display = "block";
            }
        };


        // Hashtags
        let input, hashtagArray, container, t;
        input = document.querySelector('#hashtags');
        container = document.querySelector('.tag-container');
        hashtagArray = [];
        input.addEventListener('keyup', () => {
            if (event.which == 32 && input.value.length > 0 && input.value.trim() !== '') {
                var text = document.createTextNode(input.value);
                var p = document.createElement('p');
                container.appendChild(p);
                p.appendChild(text);
                p.classList.add('tag');
                hashtagArray.push(input.value);
                console.log(hashtagArray)
                input.value = '';

                let deleteTags = document.querySelectorAll('.tag');

                for (let i = 0; i < deleteTags.length; i++) {
                    deleteTags[i].addEventListener('click', () => {
                        container.removeChild(deleteTags[i]);
                        hashtagArray.splice(i, 1);
                    });
                }
            }
        });


        // Save draft 
        const saveDraftBtn = document.getElementById('save-draft-btn');
        const titleInput = document.querySelector('input[name="title"]');
        const imageInput = document.querySelector('input[name="image"]');
        const contentTextarea = document.getElementById('content');
        const hashtagsInput = document.getElementById('hashtags');

        saveDraftBtn.addEventListener('click', () => {
            const draftData = {
                title: titleInput.value,
                image: imageInput.value,
                content: contentTextarea.value,
                hashtags: hashtagsInput.value
            };
            const key = 'my-blog-draft'; // unique key for the saved data
            localStorage.setItem(key, JSON.stringify(draftData));
        });

        // Load saved draft data if present
        window.addEventListener('load', () => {
            const key = 'my-blog-draft';
            const savedData = localStorage.getItem(key);
            if (savedData) {
                const draftData = JSON.parse(savedData);
                titleInput.value = draftData.title;
                imageInput.value = draftData.image;
                contentTextarea.value = draftData.content;
                hashtagsInput.value = draftData.hashtags;
            }
        });


        document.getElementById('publish-btn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission
            let hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'hashtags';
            hiddenInput.value = JSON.stringify(hashtagArray);
            this.parentNode.appendChild(hiddenInput);
            this.parentNode.submit();
        });
    </script>
</body>

</html>