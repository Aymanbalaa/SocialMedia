<?php
$con = mysqli_connect("localhost","root","","social");
if(mysqli_connect_errno())
{
	echo " Failed to connect" . mysqli_conect_errno();
}

$query = mysqli_query($con,"INSERT INTO test VALUES('','Ayman') ");
?>

<html>
<head>
	<title> Yessir </title>
</head>
<body>
Hello Ayman
</body>
</html>