<html>
<body>
    <?php
    include('../scripts/connection.php');  

    // Code to get the number of users in the database
    $query = "SELECT MAX(userid) as maxid FROM users";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $maxid = $row['maxid'];

    $newid = $maxid + 1;

    $email = $_POST["email"];
    $username = $_POST["name"];
    $pass = $_POST["password"];
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, username, userid,pass)
    VALUES ('$email', '$username', '$newid','$hashed_pass')";

    if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>

    <a href="index.php">AB CLICK KAR</a>
</body>
</html>