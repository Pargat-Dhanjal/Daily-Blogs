<?php
    //connect to database
    include('../scripts/connection.php');
    
    //start the session
    session_start();

    $hashtags = json_decode($_POST['hashtags']);
    foreach($hashtags as $hash){
        echo $hash;
    }

?>
<!DOCTYPE html>
<html lang="en">
<body>
    //NO NEED FOR HTML HERE
</body>
</html>