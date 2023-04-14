<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Blogs</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="../styles/index.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <script defer src="../scripts/passwordmatch.js"></script>
</head>

<body>
    <div>
        <div class="heading">
            <h1>Login</h1>
        </div>
        <img class="waves" src="../images/waves.png" alt="Waves">
        <div class="form">
            <div class="greeting">
                <h2>Welcome</h2>
                <p>Let’s log you in quickly</p>
            </div>
            <form method="POST" action="../scripts/authentication.php">
                <div class="input-field">
                    <i class="fa-regular fa-envelope fa-lg"></i>
                    <label for="email" class="form__label">Email</label>
                    <input type="email" name="email" placeholder="example@abc.com" required>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-lock fa-lg"></i>
                    <label for="password" class="form__label">Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>

                <button class="btn">Login</button>
                <div class="option">
                    Don’t have an account?
                    <br>
                    Register
                    <a href="register.php">here</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>