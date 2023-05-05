<?php
//connect to database
include('../scripts/connection.php');

//start the session
session_start();

//get data from form
$email = $_POST["email"];
$pass = $_POST["password"];

//to prevent from mysqli injection
$email = stripcslashes($email);
$pass = stripcslashes($pass);
$email = mysqli_real_escape_string($conn, $email);
$pass = mysqli_real_escape_string($conn, $pass);

//queries to get the password and the userid
$query = "SELECT pass FROM users WHERE email='$email'";
$query2 = "SELECT userid FROM users WHERE email='$email'";
$result = $conn->query($query);
$result2 = $conn->query($query2);

//check if the email exists
if ($result->num_rows > 0) {
    //get the password and the userid from the result
    $row = $result->fetch_assoc();
    $row2 = $result2->fetch_assoc();
    $user_id = $row2["userid"];
    $hashed_password = $row["pass"];

    //verify the password
    if (password_verify($pass, $hashed_password)) {
        //set the session variable
        $_SESSION['user_id'] = $user_id;
        //navigate to home page
        header("Location: ../pages/home.php");
        exit();
    } else {
        //stay on the index page
        header("Location: ../pages/index.php");
    }
} else {
    //stay on the index page
    header("Location: ../pages/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<body>
    //NO NEED FOR HTML HERE
</body>

</html>