<?php
session_start();
if (!isset($_COOKIE['ualreadylogin']))
{
	header("Location: userlogin.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (isset($_POST['btnfordeleteacc']))
	{
		function findpassword()
		{
			try
					{
							
								$username = "root";
								$password = "mukeshbhandarii1*";
								$servername = "localhost";
								$dbname = "online_exam";
								$email = $_SESSION['userloginemaill'];
								
								
								$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
								$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
								$passfromdb = $conn->prepare("SELECT Password FROM userinfo WHERE Email = :email");
								$passfromdb->bindParam(':email',$email,PDO::PARAM_STR);
								$passfromdb->execute();
								$respassfromdb	= $passfromdb->fetchColumn();
								//$respassfromdb 	= $passfromdb->fetch(PDO::FETCH_ASSOC);
								return $respassfromdb;
					}
						
			catch(PDOException $e)
					{
								echo $e->getMessage();
					}
		}
		
		$respassfromdb = findpassword();
		
		if (password_verify($_POST['userdeletepassword'],$respassfromdb))
		//if ($respassfromdb == $_POST['userdeletepassword'])
		{
			try{
				$servername ="localhost";
				$username = "root";
				$password = "mukeshbhandarii1*";
				$dbname = "online_exam";
				$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$deleteque = $conn->prepare("DELETE FROM userinfo where Email = :email");
				$deleteque->bindParam(':email',$_SESSION['userloginemaill'],PDO::PARAM_STR);
				$deleteque->execute();
				setcookie("ualreadylogin","",time()- 3600);
				unset($_SESSION["fromuhome"]);
				header("Location: userlogin.php");
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
		if (!password_verify($respassfromdb,$_POST['userdeletepassword']))
		{
			$userdeletepassworderror = "Incorrect Password";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Delete My Account</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js">		</script>
	<script src="js/bootstrap.min.js">	</script>
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
<body>
<div class="container-fluid main" style="background:#C0C0C0">
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
			<a class="navbar-brand" href="#"><img src="images/teammrj.jpg" class="img-circle img-responsive" style="max-width:20%" alt="Logo"> </a>
		</div>
		<div class="collapse navbar-collapse" id="mynavbar">
		<ul class="nav navbar-nav">
			
			<?php
						
					function checkstudentfirstnameindb()
					{
						try
						{
							
								$username = "root";
								$password = "mukeshbhandarii1*";
								$servername = "localhost";
								$dbname = "online_exam";
								$email = $_SESSION['userloginemaill'];
								
								
								$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
								$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
								$firstname = $conn->prepare("SELECT First_Name FROM userinfo WHERE Email = :email");
								$firstname->bindParam(':email',$email,PDO::PARAM_STR);
								$firstname->execute();
								$stfirstname 	= $firstname->fetchColumn();
								return $stfirstname;
								//echo "Welcome " . $stfirstname;
						}
						
							catch(PDOException $e)
						{
							echo $e->getMessage();
						}
					}
					 $userfirstnam = checkstudentfirstnameindb();
					  echo "<li class='text-center' style='color:white'>";
					  echo $userfirstnam . "</li>";
			?>
			<li> <a href="viewprofileinfo.php"> View Profile Info</a>  </li>
			<li> <a href="home.php"> User Home Page</a>  </li>
			
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li> <a href="uchangepassword.php"> Change Password </a> </li>
			<li> <a href="ulogout.php">Log Out </a> </li>
		</ul>
		</div>
	</div>
</nav>

<div class="container-fluid" style="background:#ADD8E6">
<div class="row">
<div class="col-md-3"> </div>
<div class="col-md-6">
<div class="panel panel-primary">
<div class="panel-heading"> Delete My Account </div>
<div class="panel-body"> 
<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<div class="form-group">
		<label for="userdeletepassword"> Password </label>
		<input type="password" class="form-control" name="userdeletepassword" id="userdeletepassword" placeholder="Enter Password" required>
			<?php
			if (isset($userdeletepassworderror))
			{
				?>
			<span class="text-danger"> 
				<?php
					 echo $userdeletepassworderror;
				?>
			</span>
			<?php
			}
			?>
</div>
<input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="Delete" name="btnfordeleteacc">
</form>
</div>
</div>
</div>
<div class="col-md-3"> </div>
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
</html>
