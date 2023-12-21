<?php

session_start();
if (isset($_COOKIE['aalreadylogin']))
{
	header("Location: home.php");
}
if (!$_SESSION['adminregisterfrompreviouss'])
{
	header("Location: adminregister.php");
}

$adminregistercollegename		=	$_SESSION['adminregistercollegenamee'];
$adminregisteremail				=	$_SESSION['adminregisteremaill'];
$adminregisterpwd				=	$_SESSION['adminregisterpwdd'];
$adminregistercountry			=	$_SESSION['adminregistercountryy'];
$adminregistersaddress			=	$_SESSION['adminregistersaddresss'];
//$adminregisterphone				=	$_SESSION['adminregisterphonee'];
$adminregistercollegeid			=	$_SESSION['adminregistercollegeidd'];
$adminregisterfromprevious		= 	$_SESSION['adminregisterfrompreviouss'];
//$adminregisterverification 	= 	$_SESSION['adminregisterverificationn'];
if ($_SESSION['adminregisterfrompreviouss'])
{
	$_SESSION['adminregisterfromm'] = true;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> Admin Registration</title>
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
.jumbotron p{
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
<div class="container-fluid" style="background:#DFD297;margin-top:10px;margin-bottom:5px">
	<div class="row">
	<div class="col-md-2 pull-left">

	   </div>
		<div class="col-md-8 clearfix">
			<h1 class="page-header"> The Information You Entered is:  </h1>
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-hover">
						<tr>
							<td> College Name : </td>
							<td> <span class="text-danger"> <?php 
									if (isset($adminregisterfromprevious))
									{
										echo $adminregistercollegename; 
									}
								  ?>  </span>
							 </td>
						</tr>
						<tr>
							<td> Email : </td>
							<td> <span class="text-danger"> <?php if (isset($adminregisterfromprevious))
									{
									  echo $adminregisteremail;
									} ?>   </span>
							</td>
						</tr>
						<tr>
							<td>  Password :</td>
							<td> <span class="text-danger"> <?php if (isset($adminregisterfromprevious))
									{
									  echo $adminregisterpwd;
									} ?>  </span> </td> 
						</tr>
						<tr>
							<td>  Country :</td>
							<td> <span class="text-danger"> <?php if (isset($adminregisterfromprevious))
									{
									  echo $adminregistercountry;
									} ?>   </span> </td>
						</tr>
						<tr>
							<td>  Address :</td>
							<td> <span class="text-danger"> <?php if (isset($adminregisterfromprevious))
									{
									  echo $adminregistersaddress;
									} ?>  </span> </td>
						</tr>
						<!--<tr>
							<td> Phone Number :</td>
							<td>  <span class="text-danger"> <?php //if (isset($adminregisterfromprevious))
									{
									  //echo $adminregisterphone;
									} ?>  </span> </td>
						</tr>-->
						<tr>
							<td> College ID :</td>
							<td> <span class="text-danger">  <?php if (isset($adminregisterfromprevious))
									{
									  echo $adminregistercollegeid;
									} ?>  </span> </td>
						</tr>
					</table>
					<div style="border-top:1px solid #000;margin-bottom:5px"> </div>
					<p> To Edit The Information Go <a onclick="javascript:history.go(-1)">Back</a>. Otherwise Click Submit Button Below.</p>
					<div style="border-bottom:1px solid #000;margin-bottom:5px"> </div>
					
						<button class="btn btn-info btn-lg" style="margin-bottom:10px" onclick="window.location.href='aa.php'"> Submit </button>
				</div>
				
		</div>
		<div class="col-md-2 pull-right">

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
unset($adminregisterfromprevious);
?>