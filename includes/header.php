<?php
require 'config/config.php';

if(isset($_SESSION['username']))
{
$userLoggedIn = $_SESSION['username'];
$user_details_query = mysqli_query($con , "SELECT * FROM users WHERE username='$userLoggedIn'");
$user = mysqli_fetch_array($user_details_query);
}
else {
header("Location: register.php");
}

?>
<html>
<head>
	<title> Yessir </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/15233111d7.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
   
</head>
<body>

        <div class="top_bar">
            <div class ="logo">
                <a href="index.php">AymanFeed</a>
            </div>

            <nav>
               <a href="#"> <?php echo 'Welcome '. $user['first_name'];?> </a>
               <a href="index.php"><i class="fa-solid fa-house"></i></a>
               <a href=""><i class="fa-solid fa-message" style="color: #FFF;"></i></a>
               <a href=""><i class="fa-solid fa-gear" style="color: #FFF;"></i></a>
            </nav>
        </div>