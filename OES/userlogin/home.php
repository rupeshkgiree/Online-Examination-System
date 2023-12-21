<?php
session_start();

if ((!isset($_COOKIE['ualreadylogin'])) || (!isset($_SESSION['userloginfromcheck'])))
{
	header("Location: userlogin.php");
}
if (isset($_SESSION['fromgiveexamofuser']))
{
	unset($_SESSION['fromhometogiveexamclik']);
}
if (isset($_SESSION['formgiveexamresultbata']))
{
	unset($_SESSION['formgiveexamresultbata']);
	header("Location: home.php");
}
$_SESSION["fromuhome"] = true;
$_SESSION["fromuhometoviewresults"] = true;
/*if (isset($_SESSION['subjectforgivingexam']))
{
	unset($_SESSION['subjectforgivingexam']);
}*/
/*if (isset($_SESSION['fromsubmitquestionexam']))
{
	try
	{
		$servername = "localhost";
		$username = "root";
		$password = "mukeshbhandarii1*";
		$dbname = "online_exam";
		$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
		function getcollegeid()
			{
			try
						{
							$servername = "localhost";
							$username = "root";
							$password = "mukeshbhandarii1*";
							$dbname = "online_exam";
							$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
							$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
							$idofcollege = $conn->prepare("Select College_ID From userinfo where Email = :e");
							$idofcollege->bindParam(':e',$_SESSION['userloginemaill'],PDO::PARAM_STR);
							$idofcollege->execute();
							$idcollegeeee = $idofcollege->fetchColumn();
							return $idcollegeeee;
						}
			catch (PDOException $e)
						{
							echo $e->getMessage();
						}
			}
			$idcollegeeee = getcollegeid();
		
		$deleteallqueofsub = $conn->prepare("DELETE FROM question where College_ID = :cid and Subject_Code = :scodee");
		$deleteallqueofsub->bindParam(':cid',$idcollegeeee,PDO::PARAM_STR);
		$deleteallqueofsub->bindParam(':scodee',$_SESSION['subjectforgivingexam'],PDO::PARAM_STR);
		$deleteallqueofsub->execute();
	}
	catch (PDOException $e)
	{
		echo $e-<getMessage();
	}
}*/
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (isset($_POST['startexam']));
	{
		if (!empty($_POST['subjectforgiveexamuser']))
		{
			$_SESSION['subjectforgivingexam'] = $_POST['subjectforgiveexamuser'];
			$_SESSION['fromhometogiveexamclik'] = true;
			header("Location: giveexam.php");
		}
		else
		{
			$giveexamerror = "Select Subject";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> HOME </title>
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
					  echo "Welcome " . $userfirstnam . "</li>";
			?>
			<li> <a href="viewprofileinfo.php"> View Profile Info</a>  </li>
			<li> <a href="deletemyaccount.php"> Delete My Account</a>  </li>
			
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li> <a href="uchangepassword.php"> Change Password </a> </li>
			<li> <a href="ulogout.php">Log Out </a> </li>
		</ul>
		</div>
	</div>
</nav>

<div class="container-fluid">
		<div class="container-fluid" style="background:#DFD297;padding:20px">
			<div class="row">
			<div class="col-md-6">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" role="form" method="POST">
			<?php
			if ((isset($giveexamerror)) || (isset($_SESSION['examalreadygivenornot'])) || (isset($_SESSION['whenexamforthussubj'])))
			{
				?>
				<div class="well">
				<?php 
				if (isset($giveexamerror))
				{
					echo $giveexamerror;
				}
					if (isset($_SESSION['examalreadygivenornot']))
					{
						echo $_SESSION['examalreadygivenornot'];
						unset($_SESSION['examalreadygivenornot']);
					}
					if (isset($_SESSION['whenexamforthussubj']))
					{
					echo $_SESSION['whenexamforthussubj'];
					unset($_SESSION['whenexamforthussubj']);
					}
				?>
				</div>
				<?php
			}
				?>
						<!--<div>-->
						<?php
							try
								{
									$servername = "localhost";
									$username = "root";
									$password = "mukeshbhandarii1*";
									$dbname = "online_exam"; 
									$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
									$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
									
									 
									 $stmt = $conn->prepare("Select Subject_Name from setexam where College_ID = (Select College_ID from userinfo where Email = :eml)");
									 $stmt->bindParam(':eml',$_SESSION['userloginemaill'],PDO::PARAM_STR);
									 $stmt->execute();
								 echo "<select name='subjectforgiveexamuser' class='form-control'>";
									  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										echo "<option>" . $row['Subject_Name']. "</option>";    
										  }
										  echo "</select>";
									
									
								}

							catch(PDOException $e)
								{
									echo $e->getMessage();
								}
								
							?>
							
						
						<!--</div>-->
						<br/><input type="submit" class="btn btn-primary" name="startexam" value="Start Exam"> <br/>
						</form>
						
				</div>
				<div class="col-md-6">
				<a href="viewresults.php" class="btn btn-primary btn-block"> View Results</a>
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
</body>
</html>