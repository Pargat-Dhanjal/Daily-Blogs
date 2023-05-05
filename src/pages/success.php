<?php
    //connect to database
    include('../scripts/connection.php');  

    //query to get the max userid
    $query = "SELECT MAX(userid) as maxid FROM users";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    //increment the userid by 1
    $maxid = $row['maxid'];
    $newid = $maxid + 1;

    //get data from form
    $email = $_POST["email"];
    $username = $_POST["name"];
    $pass = $_POST["password"];

    //hash the password
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    //insert data into database
    $sql = "INSERT INTO users (email, username, userid,pass)
    VALUES ('$email', '$username', '$newid','$hashed_pass')";
    
    //just hear cause it doesn't work without this
    if (mysqli_query($conn, $sql)) {}

    header("Location: ../pages/index.php");

    //close connection
    mysqli_close($conn);
?>
<html>
<body>
    //PARGAT HTML ADD KAR IDHAR
    <a href="index.php">AB CLICK KAR</a>
</body>
</html>