<?php
//connect to database
include('../scripts/connection.php');

//start the session
session_start();

//query to get the max blogid
$query = "SELECT MAX(blogid) as maxblogid FROM blogs";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

//increment the userid by 1
$maxid = $row['maxblogid'];
$newid = $maxid + 1;


//get data from form
$title = $_POST["title"];
$content = $_POST["content"];

//to prevent from mysqli injection
$title = stripcslashes($title);
$content = stripcslashes($content);
$title = mysqli_real_escape_string($conn, $title);
$content = mysqli_real_escape_string($conn, $content);

$date = date('Y-m-d H:i:s');
$image = $_FILES['image']['name'];
$target = "../images/blog_data/" . basename($newid) . ".png";
move_uploaded_file($_FILES['image']['tmp_name'], $target);
echo "$target";

$hashtags = json_decode($_POST['hashtags']);
$serializedhash = serialize($hashtags);

$sql = "INSERT INTO blogs (title, content, blogid, userid,date_of_upload,blog_image,hashtags)
    VALUES ('$title', '$content', '$newid', '$_SESSION[user_id]','$date','$image','$serializedhash')";


if (mysqli_query($conn, $sql)) {
    header("Location: ../pages/home.php");
}
//close connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<body>
    //NO NEED FOR HTML HERE
</body>

</html>