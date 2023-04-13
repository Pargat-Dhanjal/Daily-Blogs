<html>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blogsite";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }

    // Code to get the number of users in the database
    $query = "SELECT MAX(userid) as maxid FROM users";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $maxid = $row['maxid'];

    $newid = $maxid + 1;

    $email = $_POST["email"];
    $username = $_POST["name"];
    $pass = $_POST["password"];

    $sql = "INSERT INTO users (email, username, userid,pass)
    VALUES ('$email', '$username', '$newid','$pass')";

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