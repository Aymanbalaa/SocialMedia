<?php
session_start();
$con = mysqli_connect("localhost","root","","social");
if(mysqli_connect_errno())
{
	echo " Failed to connect" . mysqli_conect_errno();
}

$fname = "";
$lname = "";
$em ="";
$em2 = "";
$password ="";
$password2 ="";
$date = "";
$error_array = [];

if (isset($_POST['reg_button']))
{

    $fname = strip_tags($_POST['reg_fname']);
    $fname = str_replace(' ','',$fname);
    $fname = ucfirst(strtolower($fname));
    $_SESSION['reg_fname'] = $fname ;

    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_replace(' ','',$lname);
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname ;

    $em = strip_tags($_POST['reg_email']);
    $em = str_replace(' ','',$em);
    $em = ucfirst(strtolower($em));
    $_SESSION['reg_email'] = $em ;

    $em2 = strip_tags($_POST['reg_email2']);
    $em2 = str_replace(' ','',$em2);
    $em2 = ucfirst(strtolower($em2));
    $_SESSION['reg_email2'] = $em2 ;

    $password = strip_tags($_POST['reg_password1']);
    $_SESSION['reg_password1'] = $password ;
    $password2 = strip_tags($_POST['reg_password2']);
    $_SESSION['reg_password2'] = $password2 ;

    $date = date("Y-m-d");

    if ($em == $em2) {
        if (fiLter_var($em, FILTER_VALIDATE_EMAIL)) {
            $em = filter_var($em, FILTER_VALIDATE_EMAIL);
        
            //validate email if it already exists    
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
            //count the numbers of rows returned      
            $num_rows = mysqli_num_rows($e_check);
            if ($num_rows > 0) {
                array_push($error_array, "Email already in use<br>");
            }
        }
        else {
            array_push($error_array, "Email Invalid Format<br>");
        }
    } else {
        array_push($error_array, "Email do not match<br>");
    }


    if ( (strlen($fname) > 25 ) || (strlen($fname) < 3) ) 
    { 
        array_push ($error_array,"First name has to be between 3 and 25 charachters <br>");
    }
    if ( (strlen($lname) > 25 ) || (strlen($lname) < 3) ) 
    { 
        array_push ($error_array,"Last name has to be between 3 and 25 charachters <br>");
    }
    
    if ($password != $password2)
    {
        array_push ($error_array,"Passwords do not match <br>");
    }

    else
    {
        if (preg_match('/[^A-Za-z0-9]/', $password))
        {
            array_push ($error_array,"Password can only contain English characters or numbers <br>");
        }
    }

    if ( (strlen($password) < 5 ) || (strlen($password) > 30) )
    {
        array_push ($error_array," Your Password has to be between 5 and 30 charachters <br>");
    }

    if(empty($error_array))
    {
        $password =md5($password);

        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con , "SELECT username FROM users WHERE username = '$username' ");

        $i = 0;

        while (mysqli_num_rows($check_username_query) !=0 )
        {
            $i++;
            $username = $username . "_" . $i ;
            $check_username_query = mysqli_query($con , "SELECT username FROM users WHERE username = '$username' ");
        }


     
     $profile_pic = "1";

      
     $query = mysqli_query ( $con , "INSERT INTO users VALUES (NULL,'$fname', '$lname' , '$username' , '$em' , '$password' , '$date' , '$profile_pic' , '0' ,'0' , 'no' , ',')");

     array_push($error_array , "<span style='color:#14C800;'> You're all set! Go ahead and login! </span><br>");

        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";

    
    }
}

?>



<html>
<head>
    <title> Welcome to AymanFeed </title>
</head>

<body>

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


    </form>

</body>
</html>