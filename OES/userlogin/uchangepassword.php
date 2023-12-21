<?php
session_start();
if ((!isset($_COOKIE['ualreadylogin'])))
{
	header("Location: userlogin.php");
}
$usercpprevious = "";
$usercppresent1 = "";
$usercppresent2 = "";

$ucppresent1error = "";
$ucppresent2error = "";
$ucppreviouserror = "";
$error = 0;
	 
	function dbconnectandcp()
	{
		try
		{
			$servername = "localhost";
			$dbname = "online_exam";
			$username = "root";
			$password = "mukeshbhandarii1*";
			$emailforcp = $_COOKIE['ualreadylogin'];
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
		if ((empty($_POST['ucppresent1'])) || (empty($_POST['ucppresent2'])))
			{
				if (empty($_POST['ucppresent1']))
					{
						$ucppresent1error = "Password is Required";
					}
					else
					{
						$usercppresent1 = $_POST['ucppresent1'];
					}
					
					if (empty($_POST['ucppresent2']))
					{
						$ucppresent2error = "Re-Entering of Password is Required";
					}
					else
					{
						$usercppresent2 = $_POST['ucppresent2'];
					}
			}
			if ((!empty($_POST['ucppresent1'])) && (!empty($_POST['ucppresent2'])))
			{
					$usercppresent1 = $_POST['ucppresent1'];
					$usercppresent2 = $_POST['ucppresent2'];
					if ($_POST['ucppresent1'] != $_POST['ucppresent2'])
						{
							 $ucppresent2error = "New Password do not match";
						}
					else
					{
						if (strlen($_POST['ucppresent1'])<8 || strlen($_POST['ucppresent2'])<8 )
						{
							$ucppresent2error = "Password must be atleast 8 character long";
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
		$emailforcp = $_COOKIE['ualreadylogin'];
		$stmt=$conn->prepare( "SELECT Password FROM userinfo WHERE Email=:email");
		$stmt->bindParam(':email',$emailforcp,PDO::PARAM_STR);
		$stmt->execute();
		$resul = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if (password_verify($_POST['ucpprevious'],$resul['Password']))
		//if ($_POST['ucpprevious'] == $resul['Password'])
		{
			$emailforcp = $_COOKIE['ualreadylogin'];
			$todaydate	= date("Y-m-d H:i:s");
			$sql = "UPDATE userinfo SET Password = :password, Last_Password_Update = :todaydateforlastpass WHERE (Email = :email)";
			//prepare statement
			$stmt = $conn->prepare($sql);
			$uoripresenpassword = $_POST['ucppresent1'];
			$uhashpwd = password_hash($uoripresenpassword,PASSWORD_BCRYPT);
			$stmt->bindParam(':email',$emailforcp,PDO::PARAM_STR);
			$stmt->bindParam(':password',$uhashpwd,PDO::PARAM_STR);
			
			$stmt->bindParam(':todaydateforlastpass',$todaydate,PDO::PARAM_STR);
			
			$stmt->execute();
			$_SESSION['fromuserchangepassword'] = true ;
			$_SESSION['usercpsomethingwrong'] = "Password Changed. Please Login to Continue";
			
			header("Location: ulogout.php");
		}
		else
		{
		   $usercppresent1 = "";
		   $usercppresent2 = "";
			$usercpprevious = $_POST['ucpprevious'];
			$ucppreviouserror = "Present Password is Incorrect.";
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
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.min.js"> </script>
<script src="js/jquery.min.js"> </script>
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
<h1>  <span class="glyphicon glyphicon-education">Online Examination System  <span class="glyphicon glyphicon-education"> </h1>
		<p> Give Online Exams For Any Subjects </p>
		<p> Improve Your Skills </p>
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
			<li> <a href="home.php">User Home Page </a> </li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li> <a href="ulogout.php">Log Out </a> </li>
		</ul>
		</div>
	</div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 pull-left">
			
		</div>
		<div class="clearfix col-md-4" style="background:#DFD297">
			<h3 class="well"> Change Password <small> for User </small></h3>
			<form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="usercpform">
												<div class="form-group">
												<label for="ucpprevious" class="sr-only"> Current Password </label> <input type="password" maxlength="20" class="form-control"  autocomplete="off" placeholder="Enter Current Password" name="ucpprevious" id="ucpprevious" value = "<?php echo $usercpprevious; ?>" autofocus>
												<span class="text-danger">
												<?php
												echo $ucppreviouserror;
												?>
												</span>
												</div>
												
												<div class="form-group">
												<label for="ucppresent" class="sr-only"> New Password </label> <input type="password" maxlength="20" class="form-control" autocomplete="off" placeholder="Enter New Password" name="ucppresent1" id="ucppresent"  value = "<?php
												echo $usercppresent1;
												?>">
												<span class="text-danger">
												<?php
												  echo $ucppresent1error;
												?>
												</span>
												</div>
												
												<div class="form-group">
												<label for="ucppresent" class="sr-only"> Re-Enter New Password </label> <input type="password" maxlength="20" class="form-control" autocomplete="off" placeholder="Re-Enter New Password" name="ucppresent2" id="ucppresent" value = "<?php
												echo $usercppresent2;
												?>">
												<span class="text-danger">
												<?php
												echo $ucppresent2error;
												?>
												</span>
												</div>
						<input type="submit" class="btn btn-primary" style="margin-bottom:10px" value="Change Password"  name="ucp" >
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