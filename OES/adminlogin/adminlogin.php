<?php
session_start();
include_once 'checkifadmininfoexist.php';
include_once 'checkifuserinfoexist.php';
include_once 'checkifsubjectsexist.php';
include_once 'checkifsetexamexist.php';
include_once 'checkifquestionexist.php';
checkadmininfoexistindb();
checkuserinfoexistindb();
checksubjectexistindb();
checksetexamexistindb();
checkquestionexistindb();
if (isset($_COOKIE['aalreadylogin']))
{
	header("Location: home.php");
}
$adminemailerror = "";
$adminpassworderror = "";
$adminemail = "";
$adminpassword = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	/*if (!$_SESSION['fromadminlogincheckforwronglogincount'])
						{
							$_SESSION['noofwronglogina']= 0;
						}
						 if ( $_SESSION['noofwronglogina']>6)
						{
							
						}*/
	
	if ((empty($_POST['adminemail']))|| (empty($_POST['adminpassword'])))
	{
		if (empty($_POST['adminemail']))
		{
			$adminemailerror = "Email is Required";
		}
		else
		{
			$adminemail = $_POST['adminemail'];
		}
		
		if (empty($_POST['adminpassword']))
		{
			$adminpassworderror = "Password is Required";
		}
		else
		{
			$adminpassword = $_POST['adminpassword'];
		}
	}
	else
	{
		$adminloginemail		 = $_POST['adminemail'];
		$adminloginpassword 	 = $_POST['adminpassword'];
		$adminloginprevious = true;
		$_SESSION['adminloginpreviouss'] = $adminloginprevious;
		$_SESSION['adminloginemaill'] 	=  $adminloginemail;
		$_SESSION['adminloginpasswordd']  = $adminloginpassword;
		header("Location: adminlogincheck.php");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> Admin Login </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../userlogin/css/bootstrap.min.css" rel="stylesheet">
<script src="../userlogin/js/bootstrap.min.js"> </script>
<script src="../userlogin/js/jquery.min.css"> </script>
</head>
<style>
		.jumbotron{
						 margin-top:2px;
						 margin-bottom:10px;
						 background:#50d07d;
		}
		body{
				background: #C0C0C0;
		}
</style>
<body>
<div class="container-fluid">

<div class="jumbotron text-center">
<h1> <span class="glyphicon glyphicon-education"> Online Examination System <span class="glyphicon glyphicon-education"> </h1>

</div>

	<div class="container">
		<div class="row">
		<div class="col-md-4"> <a class="btn btn-info btn-block" href="../index.php" role="button"> Main Page </a> <br/> 
		 <a class="btn btn-info btn-block" href="../userlogin/feedback.php" role="button"> Give Feedback </a> <br/>
		</div>
		<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading"> Admin Login </div>
						<div class="panel-body">
						
							<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="adminloginform">
						<?php
							  if (isset($_SESSION['adminloginsomethingwrong']))
							   {
						 ?>
						 <div class="well">
								  <span class="text-danger"> 
								  <?php
									  echo $_SESSION['adminloginsomethingwrong'];
									  unset($_SESSION['adminloginsomethingwrong']);
									 ?>
								 </span> 
								
						 </div>
						  <?php
							   }
						  ?>
						  
						  <?php
							  if (isset($_SESSION['fromadminchangepassword']))
							   {
						 ?>
						 <div class="well">
								  <span class="text-danger"> 
								  <?php
									  echo $_SESSION['admincpsomethingwrong'];
									  unset($_SESSION['fromadminchangepassword']);
									  unset($_SESSION['admincpsomethingwrong']);
									 ?>
								 </span> 
								
						 </div>
						  <?php
							   }
						  ?>
						  <div class="form-group">
									<label for="adminemail"> Email </label> <input type="email" class="form-control" name="adminemail" placeholder="Enter Email" id="adminemail" value="<?php echo $adminemail;?>">
								<span class="text-danger"> 
									<?php
										echo $adminemailerror;
									?>
								</span>	
								</div>
								<div class="form-group">
									<label for="adminpassword"> Password </label> <input type="password" class="form-control" name="adminpassword" placeholder="Enter Password" id="adminpassword" value="<?php echo $adminpassword;?>">
									<span class="text-danger"> 
									<?php
										echo $adminpassworderror;
									?>
								</span>
								</div>
								<input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="Log In" name="adminlogin">
								<!--<a class="btn btn-danger pull-right" data-toggle="tooltip" title="Did You Forgot Your Password? Click Here" href="../userlogin/forgotpassword.php" role="button"> Forgotten Password </a>-->
							</form>
						</div>
				</div>
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
	
</div>
</body>