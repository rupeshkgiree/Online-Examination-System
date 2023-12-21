<?php
session_start();
if (!isset($_COOKIE['aalreadylogin']))
{
	header("Location: adminlogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> View Profile Information</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../userlogin/css/bootstrap.min.css" rel="stylesheet">
<script src="../userlogin/js/bootstrap.min.js"> </script>
<script src="../userlogin/js/jquery.min.css"> </script>
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
		<ul class="nav navbar-nav">
			<li> <a href="Home.php">Admin Home Page </a> </li>
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
<div class="col-md-12">
<?php
$servername = "localhost";
$username = "root";
$password = "mukeshbhandarii1*";
$dbname = "online_exam";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT College_Name,Email,Country,Street_Address,College_ID,Registration_Date FROM admininfo where Email = :emai");
	$stmt->bindParam(':emai',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
    $stmt->execute();
	echo "<table class='table table-striped table-bordered'>";
	echo "<tr><th> College Name</th><th> EMAIL	</th><th> COUNTRY  </th><th> ADDRESS  </th><th>College ID 	</th><th>Registration Date 	</th></tr>";
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo "<tr style='background: grey; border: 2px solid red;'> <td>" . $row['College_Name'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['Country'] . "</td> <td>" . $row['Street_Address'] . "</td> <td>" . $row['College_ID']. "</td> <td>" . $row['Registration_Date'] . "</td> </tr>";

}
   }
	
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
	?>
	</
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