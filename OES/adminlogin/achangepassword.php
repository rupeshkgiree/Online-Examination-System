<?php
if ((!isset($_COOKIE['aalreadylogin'])))
{
	header("Location: adminlogin.php");
}
session_start();

$admincpprevious = "";
$admincppresent1 = "";
$admincppresent2 = "";

$acppresent1error = "";
$acppresent2error = "";
$acppreviouserror = "";
$error = 0;
	 
	function dbconnectandcp()
	{
		try
		{
			$servername = "localhost";
			$dbname = "online_exam";
			$username = "root";
			$password = "mukeshbhandarii1*";
			$emailforcp = $_COOKIE['aalreadylogin'];
			$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $conn;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	 
 

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
		if ((empty($_POST['acppresent1'])) || (empty($_POST['acppresent2'])))
			{
				if (empty($_POST['acppresent1']))
					{
						$acppresent1error = "Password is Required";
					}
					else
					{
						$admincppresent1 = $_POST['acppresent1'];
					}
					
					if (empty($_POST['acppresent2']))
					{
						$acppresent2error = "Re-Entering of Password is Required";
					}
					else
					{
						$admincppresent2 = $_POST['acppresent2'];
					}
			}
			if ((!empty($_POST['acppresent1'])) && (!empty($_POST['acppresent2'])))
			{
					$admincppresent1 = $_POST['acppresent1'];
					$admincppresent2 = $_POST['acppresent2'];
					if ($_POST['acppresent1'] != $_POST['acppresent2'])
						{
							 $acppresent2error = "New Password do not match";
						}
					else
					{
						if (strlen($_POST['acppresent1'])<8 || strlen($_POST['acppresent2'])<8 )
						{
							$acppresent2error = "Password must be atleast 8 character long";
						}
						else
						{
							$error = 1;
						}
					}
				
			}
       
	
	if ($error)
	{
		
		$conn = dbconnectandcp();
		$emailforcp = $_COOKIE['aalreadylogin'];
		$stmt=$conn->prepare( "SELECT Password FROM admininfo WHERE Email=:email");
		$stmt->bindParam(':email',$emailforcp,PDO::PARAM_STR);
		$stmt->execute();
		$resul = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if (password_verify($_POST['acpprevious'],$resul['Password']))
		//if ($_POST['acpprevious'] == $resul['Password'])
		{
			$emailforcp = $_COOKIE['aalreadylogin'];
			$todaydate = date("Y-m-d H:i:s");
			$sql = "UPDATE admininfo SET Password = :password, Last_Password_Update = :todaydateforlastpass WHERE (Email = :email)";
			//prepare statement
			$stmt = $conn->prepare($sql);
			$oripresenpassword = $_POST['acppresent1'];
			$hashpwd = password_hash($oripresenpassword,PASSWORD_BCRYPT);
			$stmt->bindParam(':email',$emailforcp,PDO::PARAM_STR);
			$stmt->bindParam(':password',$hashpwd,PDO::PARAM_STR);
			$stmt->bindParam(':todaydateforlastpass',$todaydate,PDO::PARAM_STR);
			$stmt->execute();
			$_SESSION['fromadminchangepassword'] = true ;
			$_SESSION['admincpsomethingwrong'] = "Password Changed. Please Login to Continue";
			header("Location: alogout.php");
		}
		else
		{
		   $admincppresent1 = "";
		   $admincppresent2 = "";
			$admincpprevious = $_POST['acpprevious'];
			$acppreviouserror = "Present Password is Incorrect.";
		}
	}
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> Change Password </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../userlogin/css/bootstrap.min.css" rel="stylesheet">
<script src="../userlogin/js/bootstrap.min.js"> </script>
<script src="../userlogin/js/jquery.min.js"> </script>
</head>
<style>
		.jumbotron{
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
<h1> <span class="glyphicon glyphicon-education"> Online Examination System <span class="glyphicon glyphicon-education"> </h1>
<?php
$collegename = "Kathford College";
echo $collegename;
?>
</div>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="mynavbar">
			<span class="icon-bar"> <span>
			<span class="icon-bar"> <span>
			<span class="icon-bar"> <span>
			</button>
			<a class="navbar-brand" href="#"><img src="../userlogin/images/teammrj.jpg" class="img-circle img-responsive" style="max-width:20%" alt="Logo"> </a>
		</div>
		<div class="collapse navbar-collapse" id="mynavbar">
		<ul class="nav navbar-nav navbar-left">
			<li> <a href="home.php">Admin Home Page </a> </li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li> <a href="alogout.php">Log Out </a> </li>
		</ul>
		</div>
	</div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 pull-left">
		
		</div>
		<div class="clearfix col-md-4" style="background:#DFD297">
			<h3 class="well"> Change Password <small> for Admin </small></h3>
			<form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="admincpform">
												<div class="form-group">
												<label for="acpprevious" class="sr-only"> Current Password </label> <input type="password" maxlength="20" class="form-control" autocomplete="off" placeholder="Enter Current Password" name="acpprevious" id="acpprevious" value = "<?php echo $admincpprevious; ?>" autofocus>
												<span class="text-danger">
												<?php
												echo $acppreviouserror;
												?>
												</span>
												</div>
												
												<div class="form-group">
												<label for="acppresent" class="sr-only"> New Password </label> <input type="password" maxlength="20" class="form-control" autocomplete="off" placeholder="Enter New Password" name="acppresent1" id="acppresent"  value = "<?php
												echo $admincppresent1;
												?>">
												<span class="text-danger">
												<?php
												  echo $acppresent1error;
												?>
												</span>
												</div>
												
												<div class="form-group">
												<label for="acppresent" class="sr-only"> Re-Enter New Password </label> <input type="password" maxlength="20" class="form-control" autocomplete="off" placeholder="Re-Enter New Password" name="acppresent2" id="acppresent" value = "<?php
												echo $admincppresent2;
												?>">
												<span class="text-danger">
												<?php
												echo $acppresent2error;
												?>
												</span>
												</div>
						<input type="submit" class="btn btn-primary" style="margin-bottom:10px" value="Change Password"  name="acp" >
			</form>
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