<?php
try {
	$servername = "localhost";
	$username = "root";
	$password = "mukeshbhandarii1*";
	$conn = new PDO("mysql:host=$servername", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$creatingdatabse = "Create Database if not exists online_exam";
	$conn->exec($creatingdatabse);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
include_once 'checkifverificationcodeexist.php';
include_once 'checkifresultexistexist.php';
createverificationcodetableindb();
checkresultexistindb();
?>
<!DOCTYPE html>
<html>
<head>
<title> Index </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="userlogin/css/bootstrap.min.css">
	<script src="userlogin/js/jquery.min.js">		</script>
	<script src="userlogin/js/bootstrap.min.js">	</script>
	<style>
	  .custom
				{
					padding:50px;
					border: 3px solid black;
					background:#DFD297;
				}
		html{
			height:100%;
		}
	</style>
</head>
<body style="background:#C0C0C0">
<div class="jumbotron text-center" style="margin-bottom:5px;background:#50d07d">
<h1> <span class="glyphicon glyphicon-education"> Online Examination System <span class="glyphicon glyphicon-education"> </h1>
</div>

<div class="container-fluid ">
<div class="container-fluid custom">
<div class="row">

<div class="col-md-12 text-center">
<button type="button" class="btn btn-info btn-lg" onclick="window.location.href='userlogin/userlogin.php'" style="margin-bottom:5px;margin-right:5px"> USER </button>
<button type="button" class="btn btn-info btn-lg" onclick="window.location.href='adminlogin/adminslogin.php'"> ADMIN </button>
</div>

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