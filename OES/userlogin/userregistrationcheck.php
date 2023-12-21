<?php
session_start();
if (isset($_COOKIE['ualreadylogin']))
		{
			header("Location: home.php");
		}
if (!$_SESSION['userregisterfrompreviouss'])
{
	header("Location: userregister.php");
}
$userregisterfirstname			=	$_SESSION['userregisterfirstnamee'];
$userregisterlastname			=	$_SESSION['userregisterlastnamee'];
$userregisteremail				=	$_SESSION['userregisteremaill'];
$userregisterpwd				=	$_SESSION['userregisterpwdd'];
$userregistercountry			=	$_SESSION['userregistercountryy'];
$userregistersaddress			=	$_SESSION['userregistersaddresss'];
//$userregistermobile				=	$_SESSION['userregistermobilee'];
$userregistersymbol				=	$_SESSION['userregistersymboll'];
$userregisterfromprevious		= 	$_SESSION['userregisterfrompreviouss'];
//$userregisterverification 	= 	$_SESSION['userregisterverificationn'];
if ($_SESSION['userregisterfrompreviouss'])
{
$_SESSION['userregisterfromm'] = true;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> User Registration</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js.bootstrap.min.js"> </script>
<script src="jquery.min.css"> </script>
</head>
<body style="background:#C0C0C0">
<div class="jumbotron text-center" style="margin-top:2px;background:#50d07d;padding-top:10px">
		 <h1>  <span class="glyphicon glyphicon-education">Online Examination System  <span class="glyphicon glyphicon-education"> </h1>
		<p> Give Online Exams For Any Subjects </p>
		<p> Improve Your Skills </p>
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
							<td> First Name : </td>
							<td> <span class="text-danger"> <?php 
									if (isset($userregisterfromprevious))
									{
										echo $userregisterfirstname; 
									}
								  ?>  </span>
							 </td>
						</tr>
						<tr>
							<td> Last Name : </td>
							<td> <span class="text-danger"> <?php
									if (isset($userregisterfromprevious))
									{
									  echo $userregisterlastname;
									}
								 ?>  </span>
						    </td>
						</tr>
						<tr>
							<td> Email : </td>
							<td> <span class="text-danger"> <?php if (isset($userregisterfromprevious))
									{
									  echo $userregisteremail;
									} ?>   </span>
							</td>
						</tr>
						<tr>
							<td>  Password :</td>
							<td> <span class="text-danger"> <?php if (isset($userregisterfromprevious))
									{
									  echo $userregisterpwd;
									} ?>  </span> </td> 
						</tr>
						<tr>
							<td>  Country :</td>
							<td> <span class="text-danger"> <?php if (isset($userregisterfromprevious))
									{
									  echo $userregistercountry;
									} ?>   </span> </td>
						</tr>
						<tr>
							<td>  Address :</td>
							<td> <span class="text-danger"> <?php if (isset($userregisterfromprevious))
									{
									  echo $userregistersaddress;
									} ?>  </span> </td>
						</tr>
						<!--<tr>
							<td> Mobile Number :</td>
							<td>  <span class="text-danger"> <?php //if (isset($userregisterfromprevious))
									{
									  //echo $userregistermobile;
									} ?>  </span> </td>
						</tr>-->
						<tr>
							<td> Symbol Number :</td>
							<td> <span class="text-danger">  <?php if (isset($userregisterfromprevious))
									{
									  echo $userregistersymbol;
									} ?>  </span> </td>
						</tr>
					</table>
					<div style="border-top:1px solid #000;margin-bottom:5px"> </div>
					<p> To Edit The Information Go <a onclick="javascript:history.go(-1)">Back</a>. Otherwise Click Submit Button Below.</p>
					<div style="border-bottom:1px solid #000;margin-bottom:5px"> </div>
					
						<button class="btn btn-info btn-lg" style="margin-bottom:10px" onclick="window.location.href='ua.php'"> Submit </button>
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
unset($userregisterfromprevious);
?>