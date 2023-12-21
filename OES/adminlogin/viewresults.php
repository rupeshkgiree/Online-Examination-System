<?php
if (!isset($_COOKIE['aalreadylogin']))
{
	header("Location: userlogin.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Students Results </title>
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
			$email = $_COOKIE['aalreadylogin'];
			
			
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
		<li> <a href="home.php"> Admin Home Page </a> </li>
		<li> <a href="viewprofileinfo.php"> View Profile Info</a>  </li>
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
			<li> <a href="achangepassword.php"> Change Password </a> </li>
			<li> <a href="alogout.php">Log Out </a> </li>
		</ul>
		</div>
	</div>
</nav>


<div class="container-fluid">
		<div class="container-fluid" style="background:#DFD297;padding:20px">
			<div class="row">
				<div class="col-md-4">
				<a href="#explorers" data-toggle="collapse" style="margin-bottom:5px" class="btn btn-primary btn-block"> Result According to Email </a>
					<?php
				if (isset($acknowledgeaboutrs))
				{
				?>
				<div class="well">
				<span class="text-danger">
				<?php
				echo $acknowledgeaboutrs;
				unset($acknowledgeaboutrs);
				?>
				</span>
				</div>
				<?php
				}
				?>
				<div id="explorers" class="container-fluid collapse">
				<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				<div class="form-group">
				<label for="adminrsemail" class="text-danger"> Email </label> <input type="email" class="form-control" name="adminrsemail" placeholder="Enter Email" id="adminrsemail" required>
				</div>
				
				<input type="submit" value="GO" name="gobtnforresu" class="btn btn-info">
				</form>
				</div>
				</div>
				<div class="col-md-4">
						<a href="#explorers2" data-toggle="collapse" style="margin-bottom:5px" class="btn btn-primary btn-block">Result According to Particular Date and Subject </a>
					<?php
				if (isset($acknowledgeaboutrs2))
				{
				?>
				<div class="well">
				<span class="text-danger">
				<?php
				echo $acknowledgeaboutrs2;
				unset($acknowledgeaboutrs2);
				?>
				</span>
				</div>
				<?php
				}
				?>
				<div id="explorers2" class="container-fluid collapse">
				<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				<div class="form-group">
				<label for="dateforexamrs" class="text-danger"> Date of Exam Taken</label> 
				<input type="text" class="form-control" pattern="\d{4}-\d{1,2}-\d{1,2}" name="dateforexamrs" id="dateforexamrs" placeholder="Enter Date of Exam Taken(YYYY-MM-DD)" required> 
				</div>
				
				<div class="form-group">
				<label for="asubjectnamers" class="text-danger"> Enter Subject Name </label> <input type="text" placeholder="Subject Name" class="form-control" name="asubjectnamers" id="asubjectnamers" maxlength="50" required>
				</div>
				
				<input type="submit" value="GO" name="gobtnforresu2" class="btn btn-info">
				</form>
				</div>
				</div>
			</div>
		</div>
	</div>
<br/>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
if (isset($_POST['gobtnforresu']) )
{
?>	
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2 pull-left"></div>
		<div class="col-md-8" style="border:1px solid grey">
			<div class="panel panel-primary">
				<div class="panel-heading text-center" style="background:red">
					<?php
					echo "Result for " .$_POST['adminrsemail'];
					?>
				</div>
			</div>
		</div>
		<div class="col-md-2 pull-right"></div>
	</div>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<?php
include_once 'dbconnect.php';
$connecttodb = dbconnseparate();
 $stmtrtyuio = $connecttodb->prepare("SELECT College_ID FROM userinfo where Email = :emlai");
	$stmtrtyuio->bindParam(':emlai',$_POST['adminrsemail'],PDO::PARAM_STR);
    $stmtrtyuio->execute();
	$exisornot = $stmtrtyuio->fetchColumn();




    $stmt = $connecttodb->prepare("SELECT Exam_Date,Subject_Name,Full_Marks_of_Subject,Pass_Marks,Total_Marks_Obtained,Pass_Fail FROM result where Email = :emailema and College_ID = :ciddddddd");
	$stmt->bindParam(':emailema',$_POST['adminrsemail'],PDO::PARAM_STR);
	$stmt->bindParam(':ciddddddd',$exisornot,PDO::PARAM_STR);
    $stmt->execute();
	echo "<table class='table table-striped table-bordered'>";
	echo "<tr><th> Date of Exam Taken </th><th> Subject </th><th>Full Marks </th><th> Pass Marks </th><th> Obtained Marks 	</th> <th>Result </th></tr>";
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo "<tr style='background: grey; border: 2px solid red;'> <td>" . $row['Exam_Date'] . "</td> <td>" . $row['Subject_Name']. "</td> <td>" . $row['Full_Marks_of_Subject'] . "</td><td>" . $row['Pass_Marks']. "</td><td>" .$row['Total_Marks_Obtained'] . "</td><td>" .$row['Pass_Fail'] . "</td></tr>";
	}
echo "</table>";
$connecttodb = null;
?>
	
</div>
</div>
</div>
	
<?php
}
?>
	
	
	
	<?php
if (isset($_POST['gobtnforresu2']) )
{
?>	
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2 pull-left"></div>
		<div class="col-md-8" style="border:1px solid grey">
			<div class="panel panel-primary">
				<div class="panel-heading text-center" style="background:red">
					<?php
					echo "Result of " .$_POST['asubjectnamers'] . " Taken on " . $_POST['dateforexamrs'];
					?>
				</div>
			</div>
		</div>
		<div class="col-md-2 pull-right"></div>
	</div>
</div>

<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<?php
include 'dbconnect.php';
$connecttodb = dbconnseparate();
    $stmt = $connecttodb->prepare("SELECT First_Name,Last_Name,Email,Full_Marks_of_Subject,Pass_Marks,Total_Marks_Obtained,Pass_Fail FROM result where Exam_Date = :dateeee and Subject_Name = :subnnn");
	$stmt->bindParam(':dateeee',$_POST['dateforexamrs'],PDO::PARAM_STR);
	$stmt->bindParam(':subnnn',$_POST['asubjectnamers'],PDO::PARAM_STR);
    $stmt->execute();
	echo "<table class='table table-striped table-bordered'>";
	echo "<tr><th> Name </th><th> Email </th><th>Full Marks </th><th> Pass Marks </th><th> Obtained Marks 	</th> <th>Result </th></tr>";
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo "<tr style='background: grey; border: 2px solid red;'> <td>" . $row['First_Name'] . " " . $row['Last_Name'] . "</td> <td>" . $row['Email']. "</td> <td>" . $row['Full_Marks_of_Subject'] . "</td><td>" . $row['Pass_Marks']. "</td><td>" .$row['Total_Marks_Obtained'] . "</td><td>" .$row['Pass_Fail'] . "</td></tr>";
	}
echo "</table>";
$connecttodb = null;
?>
	
</div>
</div>
</div>
	
<?php
}
}
?>
	
	
	
	
	
	
		
<footer class="text-center" style="color:red;margin-bottom:40px">
	Copyright &copy;
	<?php
	$date = date('Y');
	echo '2016 - ' . $date;
	?>
</footer>
</body>
</html>
