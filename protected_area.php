<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Authentication System</title>
    <style>
        body{
            background-image: url('Ref.gif');
            background-repeat: no-repeat;
            background-size: cover;
        }
        </style>
</head>
<body>


<a href="logout.php">logout</a>
<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Protected area content here
echo "Welcome, " . $_SESSION['username'];
?>


    
</body>
</html>