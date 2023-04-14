<!DOCTYPE html>
<html lang="en">
<body>
    <?php
        include('../scripts/connection.php'); 

        $email = $_POST["email"];
        $pass = $_POST["password"];
        $query = "SELECT pass FROM users WHERE email='$email'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row["pass"]; // assume password is stored as hashed value in database
            if (password_verify($pass, $hashed_password)) {
                echo "<script>alert('ho gya login');</script>";
                // Password is correct, redirect to home.php
                header("Location: home.php");
                exit();
            } else {
                // Password is incorrect, set error message in session variable
                echo "<script>alert('galat password');</script>";
                header("Location: index.php");
            }
        } else {
            echo "<script>alert('email nai mila');</script>";
            header("Location: index.php");
        }
    ?>
</body>
</html>