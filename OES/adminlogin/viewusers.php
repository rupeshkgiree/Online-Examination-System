<?PHP
session_start();
if ((!isset($_COOKIE['aalreadylogin'])) || (!isset($_SESSION['fromahome'])))
{
	header("Location: adminlogin.php");
}
$userenterornot="";

if ($_SERVER["REQUEST_METHOD"] == "POST")
	
{
	if ((isset($_POST['buttonfordeact'])) || (isset($_POST['buttonforreact'])))
	{
				try
						{
								$username = "root";
								$password = "mukeshbhandarii1*";
								$servername = "localhost";
								$dbname = "online_exam";
								$emalforcf = $_POST['useremaildeactreact'];
								$colllegem = $_SESSION['adminloginemaill'];
								$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
								$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
								
								$echeckforuflagchng = $conn->prepare("SELECT Email FROM userinfo WHERE Email = :email and College_ID=(Select College_ID from admininfo where Email = :em)");	
								$echeckforuflagchng->bindParam(':email',$emalforcf,PDO::PARAM_STR);
								$echeckforuflagchng->bindParam(':em',$colllegem,PDO::PARAM_STR);
								$echeckforuflagchng->execute();
								$resemail 	= $echeckforuflagchng->fetch(PDO::FETCH_ASSOC);
								$result = $resemail['Email'];
								
								/*Updating Flag to 0 or 1 according to pressed button after knowing the email*/
								$updateflagonadm = "UPDATE userinfo SET Flag = :flagvalue WHERE (Email = :email)";
								
								if (($emalforcf == $resemail["Email"]))
								{
									if (isset($_POST['buttonfordeact']))
									{
										$flagggvalue = 0;
										$_SESSION['useremaildeactreacterror'] = "Succesfully Disabled " . $result . " account";
									}
									if (isset($_POST['buttonforreact']))
									{
										$flagggvalue = 1;
										$_SESSION['useremaildeactreacterror'] = "Succesfully Enabled " . $result . " account";
									}
									
										$stmttt = $conn->prepare($updateflagonadm);
										$stmttt->bindParam(':email',$emalforcf,PDO::PARAM_STR);
										$stmttt->bindParam(':flagvalue',$flagggvalue,PDO::PARAM_STR);
										$stmttt->execute();
										$_SESSION["fromacf"] = true;
										$_SESSION["emaildeactreact"] = $_POST['useremaildeactreact'];
										$_SESSION['errorontopofactivateordeactivate'] = "true";
										if ($flagggvalue == 0)
											{
												header("Location: ../userlogin/logoutaftercf.php");
											}
								}
								else
								{
									$_SESSION['errorontopofactivateordeactivate'] = "true";
									$_SESSION['useremaildeactreacterror'] = "Incorrect Email";
								}
								
						}
						catch (PDOException $e)
						{
							echo $e->getMessage();
						}
		
	}
			
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> View Users </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../userlogin/css/bootstrap.min.css">
<script src="../userlogin/js/jquery.min.js">		</script>
<script src="../userlogin/js/bootstrap.min.js">	</script>
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
checkcollegenameindb();
function checkcollegenameindb()
{
	try
	{
		
			$username = "root";
			$password = "mukeshbhandarii1*";
			$servername = "localhost";
			$dbname = "online_exam";
			$email = $_SESSION['adminloginemaill'];
			
			
			$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$colgname = $conn->prepare("SELECT College_Name FROM admininfo WHERE Email = :email");
			$colgname->bindParam(':email',$email,PDO::PARAM_STR);
			$colgname->execute();
			$rcolgname 	= $colgname->fetchColumn();
			echo $rcolgname;
//print ($rcolgname);
			
	}
	
		catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}
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
			<li> <a href="home.php"> Admin Home Page </a> </li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		<li> <a href="achangepassword.php"> Change Password </a> </li>
			<li> <a href="alogout.php">Log Out </a> </li>
		</ul>
		</div>
	</div>
</nav>

<div class="container-fluid">
<div class="row">

<div class="col-md-3" style="border:2px solid grey;padding-top:10px">
		<!--<a class="btn btn-info" href="home.php" role="button">Admin Home Page </a> <br/>  <br/>
		
		<hr> -->
		<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
					<?php
					if (isset($_SESSION['errorontopofactivateordeactivate']))
							   {
								  
					?>
					 <div class="well">
							 <span class="text-danger"> 
									<?php
										echo $_SESSION['useremaildeactreacterror'];
									 ?>
							  </span> 
										
					</div>
					 <?php
					 unset($_SESSION['errorontopofactivateordeactivate']);
							}
					?>
								 
							  <div class="form-group">
								<label for="useremaildeactreact">Student Email </label>
								<input type="email" class="form-control" name="useremaildeactreact"  id="useremaildeactreact" placeholder="Enter Student Email" required> 
								<!--<span class="text-danger">-->
										<?php
											//echo $userenterornot;
										?>
							<!--	</span> -->
							  </div>	
				<input type="submit" class="btn-info btn"  name="buttonfordeact" value="Disable Account"  role="button">
				<input type="submit" class="btn-info btn" name="buttonforreact"  value="Enable Account" role="button"> <br/> <br/>
		</form>
</div>

<div class="col-md-9">
<?php
/*echo "<table class='table table-striped table-bordered'>";
echo "<tr><th> S.N </th><th> FIRST NAME</th><th> LAST NAME </th><th> EMAIL	</th><th> COUNTRY  </th><th> ADDRESS  </th><th> MOBILE NO</th><th>SYMBOL 	</th><th>Registration Date 	</th>  </tr>";*/
$servername = "localhost";
$username = "root";
$password = "mukeshbhandarii1*";
$dbname = "online_exam";

try {
	$adminemailforcolgid = $_SESSION['adminloginemaill'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT First_Name,Last_Name,Email,Country,Street_Address,Symbol,Registration_Date,Flag FROM userinfo where College_ID = (Select College_ID From admininfo where Email = :emai)");
	$stmt->bindParam(':emai',$adminemailforcolgid,PDO::PARAM_STR);
    $stmt->execute();
	echo "<table class='table table-striped table-bordered'>";
	echo "<tr><th> FIRST NAME</th><th> LAST NAME </th><th> EMAIL	</th><th> COUNTRY  </th><th> ADDRESS  </th><th>SYMBOL 	</th><th>Registration Date 	</th> <th>Account Status </th> </tr>";
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		if ($row['Flag'] == 0)
		{
			$accountstatus = "Disabled";
		}
		if ($row['Flag'] == 1)
		{
			$accountstatus = "Enabled";
		}
		
	echo "<tr style='background: grey; border: 2px solid red;'> <td>" . $row['First_Name'] . "</td><td>" .$row['Last_Name']. "</td> <td>" . $row['Email'] . "</td><td>" . $row['Country'] . "</td> <td>" . $row['Street_Address'] . "</td> <td>" . $row['Symbol']. "</td> <td>" . $row['Registration_Date'] . "</td> <td>" .$accountstatus . "</td> </tr>";

}
   }
	
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
	?>
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

