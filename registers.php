<?php
require 'config/config.php';
require 'includes/form_handlers/registers_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<html>
<head>
    <title> Welcome to Finaee </title>
    <link   rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>

<body>

<?php  

if(isset($_POST['reg_button'])) {
    echo '
    <script>

    $(document).ready(function() {
        $("#first").hide();
        $("#second").show();
    });

    </script>

    ';
}
?>

<div class="wrapper">
        <div class=login_box>

            <div class = "login_header">
                <h1> AymanFeed </h1>
                Login or Sign Up Below
            </div>

            <div id ="first">
                <form action ="registers.php" method="POST">

                    <input type="email" name ="log_email" placeholder="Email Adress" value="<?php if (isset($_SESSION['log_email'])) { echo  $_SESSION['log_email']; } ?>" required>
                    <br>
                    <input type="password" name ="log_password" placeholder="Password">
                    <?php if(in_array("Email or Password was incorrect<br>", $error_array)) echo "Email or Password was incorrect<br>"; ?>
                    <br>
                    <input type ="submit" name="login_button" value="Login" >
                    <br>
                    <a href="#" id="signup" class ="signup"> Need an account ? Sign up here</a>

                    

                </form>
        </div>


        <div id="second">
            <form action ="registers.php" method="POST">
                    <input type="text" name="reg_fname" placeholder="First Name" 
                    value="<?php echo isset($_SESSION['reg_fname']) ? $_SESSION['reg_fname'] : ''; ?>" required>
                    <br>
                    <?php if (in_array("First name has to be between 3 and 25 charachters <br>",$error_array)) {echo "First name has to be between 3 and 25 charachters <br>";}?>

                    <input type="text" name="reg_lname" placeholder="Last Name" 
                    value="<?php echo isset($_SESSION['reg_lname']) ? $_SESSION['reg_lname'] : ''; ?>" required>
                    <br>
                    <?php if (in_array("Last name has to be between 3 and 25 charachters <br>",$error_array)) {echo "Last name has to be between 3 and 25 charachters <br>";}?>

                    <input type ="email" name="reg_email" placeholder="Email" 
                    value = "<?php if (isset($_SESSION['reg_email'])) { echo  $_SESSION['reg_email']; } ?> " required>
                    <br>

                    <input type ="email" name="reg_email2" placeholder="Confirm Email" 
                    value = "<?php if (isset($_SESSION['reg_email2'])) { echo  $_SESSION['reg_email2']; } ?> " required>
                    <br>

                    <?php if (in_array("Email already in use <br>",$error_array)) {echo "Email already in use <br>";}
                        else if (in_array("Invalid Email Format <br>",$error_array)) {echo "Invalid Email Format <br>";}
                        else if (in_array("Emails don't match <br>"  ,$error_array)) {echo "Emails don't match <br>"  ;}?>
                    
                    <input type ="password" name="reg_password1" placeholder="Password" required>
                    <br>

                    <?php if (in_array("Emails don't match <br>"  ,$error_array)) {echo "Emails don't match <br>"  ;}?>
                    
                    <input type ="password" name="reg_password2" placeholder="Confirm Password" required>
                    <br>

                    <?php if (in_array("Password can only contain English characters or numbers <br>",$error_array)) {echo "Password can only contain English characters or numbers <br>";}
                        else if (in_array(" Your Password has to be between 5 and 30 charachters <br>",$error_array)) {echo " Your Password has to be between 5 and 30 charachters <br>";}
                        else if (in_array("Passwords do not match <br>",$error_array)) {echo "Passwords do not match <br>";}?>

                    
                    <input type ="submit" name="reg_button" value="Register" >
                    <br>

                    <?php if (in_array("<span style='color:#14C800;'> You're all set! Go ahead and login! </span><br>",$error_array)) {echo "<span style='color:#14C800;'> You're all set! Go ahead and login! </span><br>";}?>
                    <a href="#" id="signin" class ="signin"> Already have an account ? Login here</a>

            </form>
        </div>
        </div>
    </div>

</body>
</html>