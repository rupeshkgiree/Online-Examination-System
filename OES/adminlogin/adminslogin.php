<?php
session_start();
if (isset($_COOKIE['aalreadylogin']))
{
	header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../userlogin/css/bootstrap.min.css" rel="stylesheet">
<script src="../userlogin/js/bootstrap.min.js"> </script>
<script src="../userlogin/js/jquery.min.css"> </script>
<title> Admin Login </title>
<style>
	  .custom
				{
					padding:50px;
					margin-right:5px;
					border: 3px solid black;
					background:#DFD297;
				}
	</style>
</head>
<body style="background:#C0C0C0">

<div class="jumbotron text-center" style="margin-bottom:5px;background:#50d07d">
<h1> <span class="glyphicon glyphicon-education"> Online Examination System <span class="glyphicon glyphicon-education"> </h1>
</div>


<div class="container-fluid custom">
	<div class="row">
		<div class="col-md-12 text-center">
		<button type="button" style="margin-bottom:5px" class="btn btn-info btn-lg" onclick="window.location.href='adminregister.php'"> New to Website? </button>
		<button type="button" class="btn btn-info btn-lg" onclick="window.location.href='adminlogin.php'"> Already Have an Account? </button>
		</div>
	</div>
</div>

<footer class="text-center" style="color:red;margin-top:15%">
	Copyright &copy;
	<?php
	$date = date('Y');
	echo '2016 - ' . $date;
	?>
</footer>


</body>
</html>
