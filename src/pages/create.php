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
                            <a href="create.php">
                                <i class="fa-solid fa-plus fa-xl"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </div>
                    <div class="icons">
                        <li class="nav-buttons">
                            <a href="profile.php" class="selected">
                                <i class="fa-solid fa-user fa-xl"></i>
                                <p>Profile</p>
                            </a>
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
                <form action="../scripts/upload.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="title" class="input" placeholder="Write your title here......">
                    <div class="blog-img">
                        <label for="file" id="output-label">
                            <img src="../images/img-upload.svg" alt="Image-upload" id="output">
                            <span></span>
                        </label>
                        <input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none; width: 100vh;">
                    </div>
                    <textarea name="content" id="content" class="input" placeholder="Write your content here......"></textarea>
                    <input type="text" name="hashtags" id="hashtags" autocomplete="off" placeholder="Type your hashtags and press space">
                    <div class="tag-container">
                    </div>
                    <button id= "publish-btn" type="submit" class="btn">PUBLISH</button>
                    <button type="submit" class="neu-btn">SAVE DRAFT</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            var label = document.getElementById('output-label');
            label.innerHTML = "Upload another Image";
            image.style.width = "100%";
            image.src = URL.createObjectURL(event.target.files[0]);
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