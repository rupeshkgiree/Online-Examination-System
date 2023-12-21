<?php
if (!isset($_COOKIE['ualreadylogin']))
{
	header("Location: userlogin.php");
}

$_SESSION['formgiveexamresultbata'] = true;
unset($_SESSION["fromuhometoviewresults"]);
unset($_SESSION['formgiveexambata']);
/*if (isset($_SESSION['subjectforgivingexam']))
{
	unset($_SESSION['subjectforgivingexam']);
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> Instant Result </title>
<meta charset="UTF-8">
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
		
}

</style>
<body style="background:#C0C0C0">

<div  class="jumbotron text-center">
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
						
					function checkstudentfirstnameeeindb()
					{
						try
						{
							
								$username = "root";
								$password = "mukeshbhandarii1*";
								$servername = "localhost";
								$dbname = "online_exam";
								$email = $_COOKIE['ualreadylogin'];
								
								
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
					 $userfirstnameee = checkstudentfirstnameeeindb();
					  echo "<li class='text-center' style='color:white'>";
					  echo "Welcome " . $userfirstnameee . "</li>";
			?>
			<li> <a href="home.php"> User Home Page</a>  </li>
			
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li> <a href="uchangepassword.php"> Change Password </a> </li>
			<li> <a href="ulogout.php">Log Out </a> </li>
		</ul>
		</div>
	</div>
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2 pull-left"></div>
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
					<?php
					echo "Result for " .$_COOKIE['ualreadylogin'];
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
    $stmt = $connecttodb->prepare("SELECT Exam_Date,Subject_Name,Full_Marks_of_Subject,Pass_Marks,Total_Marks_Obtained,Pass_Fail FROM result where Email = :emai");
	$stmt->bindParam(':emai',$_COOKIE['ualreadylogin'],PDO::PARAM_STR);
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

<footer class="text-center" style="color:red;margin-bottom:40px">
	Copyright &copy;
	<?php
	$date = date('Y');
	echo '2016 - ' . $date;
	?>
</footer>



</body>
</html>
