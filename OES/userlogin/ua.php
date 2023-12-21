<?php
session_start();
if (!$_SESSION['userregisterfromm'])
{
	header("Location: userregistrationcheck.php");
}
else
{
require_once 'uinsertdata.php';
ucreatetableindb();
}
?>

<!DOCTYPE html>
<html lang="en">
</head>
<title> User Registration </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js.bootstrap.min.js"> </script>
<script src="jquery.min.css"> </script>
</head>
<style>
.jumbotron      {
						 margin-top:2px;
						 margin-bottom:5px;
						 padding-top:10px;
						 background:#50d07d;
				}
</style>
<body style="background:#C0C0C0">
<div class="jumbotron text-center">
		 <h1>  <span class="glyphicon glyphicon-education">Online Examination System  <span class="glyphicon glyphicon-education"> </h1>
		<p> Give Online Exams For Any Subjects </p>
		<p> Improve Your Skills </p>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-md-4 pull-left">
</div>
<div class="col-md-4 clearfix" style="background:#DFD297">
<?php

	echo "Congratulations. You Have Sucessfully Registered. <br/>"
?> 
<p> Click <a href="userlogin.php"> here  </a> to login </p>
</div>

<div class="col-md-4 pull-right">
</div>
</div>
</div>
<footer class="text-center" style="color:red">
	Copyright &copy;
	<?php
	$date = date('Y');
	echo '2016 - ' . $date;
	?>
</footer>
</body>
</html>
<?php
unset($_SESSION['userregisterfromm']);
//unset($_COOKIE['ualreadylogin']);
//session_destroy();
?>