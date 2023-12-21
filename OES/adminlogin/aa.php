<?php
session_start();
if (isset($_COOKIE['aalreadylogin']))
{
	header("Location: home.php");
}
if (!$_SESSION['adminregisterfromm'])
{
	header("Location: adminregistrationcheck.php");
}
else
{
require_once 'ainsertdata.php';
acreatetableindb();
}
?>
<!DOCTYPE html>
<html lang="en">
</head>
<title> Admin Registration </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../userlogin/css/bootstrap.min.css" rel="stylesheet">
<script src="../userlogin/js.bootstrap.min.js"> </script>
<script src="../userlogin/jquery.min.css"> </script>
</head>
<style>
.jumbotron      {
						 margin-top:2px;
						 margin-bottom:5px;
						 padding-top:10px;
						 background:#50d07d;
				}
.jumbotron p	{
						 line-height:20px;
						 color:#651287;
				}
</style>
<body style="background:#C0C0C0">
<div class="jumbotron text-center">
		 <h1>  <span class="glyphicon glyphicon-education">Online Examination System  <span class="glyphicon glyphicon-education"> </h1>
		<p> Conduct Exams Online </p>
		<p> Sharpen Your Students Brain </p>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-md-4 pull-left">
</div>
<div class="col-md-4 clearfix" style="background:#DFD297">
<?php

	echo "Congratulations. You Have Sucessfully Registered. <br/>"
?> 
<p> Click <a href="javascript:prom();"> here  </a> to login </p>
<!-- <a href= "javascript:'" onclick="prom();"> here </a>-->
</div>

<div class="col-md-4 pull-right">
</div>
</div>
</div>
<script>

function prom()
{
window.location.href='adminlogin.php';
}
</script>
</body>
</html>
<?php
unset($_SESSION['adminregisterfromm']);
//session_destroy();
?>