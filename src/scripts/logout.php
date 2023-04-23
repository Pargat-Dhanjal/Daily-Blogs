<?php
    //connect to database
    include('../scripts/connection.php');
    
    session_start();

// Unset all session variables
    $_SESSION = array();

// End the session
    session_destroy();
    header("Location: ../pages/index.php");
    exit();
?>
<!DOCTYPE html>
<html lang="en">
<body>
    //NO NEED FOR HTML HERE
</body>
</html>