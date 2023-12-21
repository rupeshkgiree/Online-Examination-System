<?php
session_start();
function createdbonlineexam(){
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
}
createdbonlineexam();
function supercreatevericodetableindb()
{
	try {
		$servername = "localhost";
		$username = "root";
		$password = "mukeshbhandarii1*";
		$dbname = "online_exam"; 
		$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$creatingtabl = "CREATE TABLE IF NOT EXISTS verificationcode(
		`SN` int UNSIGNED NOT NULL auto_increment,
		`Verification_Code` varchar(12) NOT NULL,
		`Flag` tinyint(1) NOT NULL,
		PRIMARY KEY(SN)
		)";
		$conn->exec($creatingtabl);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}
supercreatevericodetableindb();
if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (isset($_POST['superadminlogin']))
		{
			
			if ((($_POST['superadminemail']  == "mukesh@kathford") || ($_POST['superadminemail']  == "rupesh@kathford") || ($_POST['superadminemail']  == "jeevan@kathford")) && (($_POST['superadminpassword']  == "mukesh@kathford") || ($_POST['superadminpassword']  == "rupesh@kathford")) || ($_POST['superadminpassword']  == "jeevan@kathford"))
			{
				$_SESSION['frompasswordphp'] = true;
				header("Location: superadmin.php");
			}
			else
			{
				$incorrecterror = "Incorrect Email or Password";
			}
		}
		
}
?>
<!DOCTYPE html>
<html>
<head>
<title> Super Admin Log In Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="userlogin/css/bootstrap.min.css">
	<script src="userlogin/js/jquery.min.js">		</script>
	<script src="userlogin/js/bootstrap.min.js">	</script>
</head>
<body style="background:#C0C0C0">
<div class="jumbotron text-center" style="margin-bottom:5px;background:#50d07d">
<h1> <span class="glyphicon glyphicon-education"> Online Examination System <span class="glyphicon glyphicon-education"> </h1>
</div>



<div class="container-fluid">
	<div class="container-fluid" style="background:#DFD297;padding:20px">
		<div class="row">
		<div class="col-md-4 pull-left">  </div>
				<div class="col-md-4">
					<div class="panel panel-primary">
					<div class="panel-heading"> Super Admin Login </div>
					<div class="panel-body">
					
					<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<?php
							  if (isset($incorrecterror ))
							   {
						 ?>
						 <div class="well">
								  <span class="text-danger"> 
								  <?php
									  echo $incorrecterror;
									 ?>
								 </span> 
								
						 </div>
						  <?php
							   }
						  ?>					
							<div class="form-group">
								<label for="superadminemail"> Username </label>
								<input type="text" class="form-control" name="superadminemail" id="superadminemail" placeholder="Enter Email" autofocus> 
							</div>
											
							<div class="form-group">
								<label for="superadminpassword"> Password </label>
								<input type="password" class="form-control" name="superadminpassword" id="superadminpassword" placeholder="Enter Password">
							 </div>
							<input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="Log In" name="superadminlogin">
					</form>
					</div>
			</div>
			
			
			
			</div>
			
			
			
			<div class="col-md-4 pull-right">  </div>
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
</html>
</body>
