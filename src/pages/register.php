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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div>
        <div class="heading">
            <h1>Register</h1>
        </div>
        <img class="waves" src="../images/waves.png" alt="Waves">
        <div class="form">
            <div class="greeting">
                <h2>Welcome</h2>
                <p>Let’s Register you in quickly</p>
            </div>
            <form method="POST" action="success.php">
                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <label for="name" class="form__label">Name</label>
                    <input type="text" name="name" placeholder="Enter Your Name" required>
                </div>
                <div class="input-field">
                    <i class="fa-regular fa-envelope fa-lg"></i>
                    <label for="email" class="form__label">Email</label>
                    <input type="email" name="email" placeholder="Enter Your Email" required>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-lock fa-lg"></i>
                    <label for="password" class="form__label">Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-lock fa-lg"></i>
                    <label for="password" class="form__label">Confirm Password</label>
                    <input type="password" name="confirmpassword" placeholder="Confirm your password" required>
                </div>
                <button id="register" class="btn">Register</button>
                <div class="option">
                    Already have an account?
                    <br>
                    Login
                    <a href="index.php">here</a>
                </div>
            </form>
        </div>
    </div>
    <script src="../scripts/Validation.js"></script>

</body>

</html>