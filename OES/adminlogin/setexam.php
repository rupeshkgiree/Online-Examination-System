<?php
session_start();
if ((!isset($_COOKIE['aalreadylogin'])) || (!isset($_SESSION['adminloginfromcheck'])))
{
	header("Location: adminlogin.php");
}
if (!isset($_SESSION["fromahomeset"]))
{
		header("Location: home.php");
}
$passmarkserror ="";
if ($_SERVER['REQUEST_METHOD']=="POST")
{
	if (isset($_POST['buttonforsetexam']))
	{
		
		
			
		
		function checkingforfullmarks()
		{
			
			
			
			try
			{
				$servername = "localhost";
				$username = "root";
				$password = "mukeshbhandarii1*";
				$dbname = "online_exam"; 
				$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$cid = $conn->prepare("select College_ID from admininfo where Email = :thisisemail");
				$cid->bindParam(':thisisemail',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
				$cid->execute();
				$anssrse 	= $cid->fetchColumn();
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		
		try
			{
				$servername = "localhost";
				$username = "root";
				$password = "mukeshbhandarii1*";
				$dbname = "online_exam"; 
				$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$cemail = $conn->prepare("select Subject_Code from subjects where Subject_Name = :subname");
				$cemail->bindParam(':subname',$_POST['subjectforquestionexam'],PDO::PARAM_STR);
				$cemail->execute();
				$ansemailse 	= $cemail->fetchColumn();
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
			
			try
			{
				$servername = "localhost";
				$username = "root";
				$password = "mukeshbhandarii1*";
				$dbname = "online_exam"; 
				$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$subnesubc=$conn->prepare("Select sum(Question_Marks) from question where College_ID = :collllid and Subject_Code = :eeee");
				$subnesubc->bindParam(':collllid',$anssrse,PDO::PARAM_STR);
				$subnesubc->bindParam(':eeee',$ansemailse,PDO::PARAM_STR);
			    $subnesubc->execute();
			    $fullmarks 	= $subnesubc->fetchColumn();
				return  $fullmarks;
			}
			catch (PDOException $e)
			{
				echo $sql . "<br/>". $e->getMessage();
			}
		}
		$fullmarks = checkingforfullmarks();
		if (($_POST['passmarks']) >= $fullmarks)
		{
			$error = 1;
			$passmarkserror = "Pass Marks cannot be Greater than or Equal to Full Marks";
			
		}
						/*$gethtmldate = $_POST['dateforexam'];
						$htmldateastext = strtotime($gethtmldate);
						$date = date('Y-m-d',$htmldateastext);
						$todayda = date("Y-m-d");
						$mintodayda = date('Y-m-d',strtotime($todayda . ' +1 day'));
						$maxtodayda = date('Y-m-d',strtotime($todayda . ' +64 day'));*/
						function ayuqwrcollegeid(){
							try
									{
										$servername = "localhost";
										$username = "root";
										$password = "mukeshbhandarii1*";
										$dbname = "online_exam"; 
										$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
										$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
										$subnesubc=$conn->prepare("Select College_ID from admininfo where Email =:ehyu");
										$subnesubc->bindParam(':ehyu',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
										$subnesubc->execute();
										$clid 	= $subnesubc->fetchColumn();
										return  $clid;
									}
							catch (PDOException $e)
									{
										echo $sql . "<br/>". $e->getMessage();
									}
						}
		function checkingforsubalreadysetforexam()
		{
			try
			{
				$servername = "localhost";
				$username = "root";
				$password = "mukeshbhandarii1*";
				$dbname = "online_exam"; 
				$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$clid = ayuqwrcollegeid();
				$subexisyesorno=$conn->prepare("Select Subject_Name from setexam where Subject_Name = :subjename and College_ID = :colgiddd");
				$subexisyesorno->bindParam(':subjename',$_POST['subjectforquestionexam'],PDO::PARAM_STR);
				$subexisyesorno->bindParam(':colgiddd',$clid,PDO::PARAM_STR);
			    $subexisyesorno->execute();
			    $resans 	= $subexisyesorno->fetchColumn();
				return  $resans;
			}
			catch (PDOException $e)
			{
				echo $sql . "<br/>". $e->getMessage();
			}
		}
$cango	= checkingforsubalreadysetforexam();
	if ($cango)
	{
		$wrongcausesubcodealexist = "Exam is Already Set for this Subject.";
		$error = 1;
		
	}
	if (empty($_POST['subjectforquestionexam']))
					{
						$error = 1;
						$passmarkserror = "";
						$wrongcausesubcodealexist = "Choose the Subject Name";
					}
		if (!isset($error))
		{
			
			
			
			
							function getcollegeidfromemailadmincurrent()
							{
								try{
									$servername = "localhost";
									$username = "root";
									$password = "mukeshbhandarii1*";
									$dbname = "online_exam";
									$con = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
									$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
									$collegeidequivalenceofemail=$con->prepare("Select College_ID from admininfo where Email = :emill");
									$collegeidequivalenceofemail->bindParam(':emill',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
									$collegeidequivalenceofemail->execute();
									$getresultcurrentcollegeid = $collegeidequivalenceofemail->fetchColumn();
									return $getresultcurrentcollegeid;
								}
								catch(PDOException $e)
								{
									echo $e->getMessage();
								}
							}
							
			
			
			
			
			
			
			
			
			
			
			
			
			
			function checksetexamexistind()
				{
					try
					{
						$servername = "localhost";
						$username = "root";
						$password = "mukeshbhandarii1*";
						$dbname = "online_exam"; 
						$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
						// set the PDO error mode to exception
					
						$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						$sql = "CREATE TABLE IF NOT EXISTS setexam(
						`SN` int UNSIGNED NOT NULL auto_increment,
						`Subject_Name` varchar(50) NOT NULL,
						`Subject_Code` varchar(12) NOT NULL,
						`Number_of_Hour` int NOT NULL,
						`Date_of_Exam` date NOT NULL,
						`Time_of_Exam` time NOT NULL,
						`Full_Marks` int NOT NULL,
						`Pass_Marks` int NOT NULL,
						`Flag` tinyint(1) NOT NULL,
						`College_ID` varchar(15) NOT NULL,
						 PRIMARY KEY(SN)
						)";
						$conn->exec($sql);
						$forsubjcodeequi = "SELECT Subject_Code FROM subjects WHERE Subject_Name = :subjname";	
						$forsubjcodeequiva = $conn->prepare($forsubjcodeequi);	
						$forsubjcodeequiva->bindParam(':subjname',$_POST['subjectforquestionexam'],PDO::PARAM_STR);
						$forsubjcodeequiva->execute();
						$resultforsubjcodeequiva 	= $forsubjcodeequiva->fetchColumn();
						$gethtmldate = $_POST['dateforexam'];
						$htmldateastext = strtotime($gethtmldate);
						$date = date('Y-m-d',$htmldateastext);
						
						
						$gethtmltime = $_POST['timeforexam'];
						$htmltimeastext = strtotime($gethtmltime);
						$c = date('H:i:s',$htmltimeastext);
						$flagforsetexam = 1;
						$a = $_POST['subjectforquestionexam'];
						$b = $_POST['totaltime'];
						$d = $_POST['passmarks'];
						$fullmarks = checkingforfullmarks();
						$getresultcurrentcollegeid = getcollegeidfromemailadmincurrent();
						$sql = "INSERT INTO setexam (Subject_Name,Subject_Code,Number_of_Hour,Date_of_Exam,Time_of_Exam,Full_Marks,Pass_Marks,Flag,College_ID)
						VALUES ('$a','$resultforsubjcodeequiva','$b','$date','$c','$fullmarks','$d','$flagforsetexam','$getresultcurrentcollegeid')";
						$conn->exec($sql);
						
					}
					catch(PDOException $e)
					{
						echo $sql . "<br/>". $e->getMessage();
					}
				}
				checksetexamexistind();
				$wrongcausesubcodealexist = "Exam is Set";
		}
	
	}
	if (isset($_POST['buttonforunsetexam']))
	{
		if (!empty($_POST['subjectforunsetexam']))
		{
			function abcdcolleid()
			{
			try{
									$servername = "localhost";
									$username = "root";
									$password = "mukeshbhandarii1*";
									$dbname = "online_exam";
									$con = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
									$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
									$collegeidequivalenceofema=$con->prepare("Select College_ID from admininfo where Email = :emill");
									$collegeidequivalenceofema->bindParam(':emill',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
									$collegeidequivalenceofema->execute();
									$getresultcurrentcollegei = $collegeidequivalenceofema->fetchColumn();
									return $getresultcurrentcollegei;
									
								}
								catch(PDOException $e)
								{
									echo $e->getMessage();
								}
			}
			$getresultcurrentcollegei = abcdcolleid();
			
			try{
				$servername = "localhost";
				$username = "root";
				$password = "mukeshbhandarii1*";
				$dbname = "online_exam";
				$connt = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
			    $connt->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$deletesetexm = $connt->prepare("Delete From setexam where Subject_Name = :subtnme and College_ID = :clidd");
				$deletesetexm->bindParam(':subtnme',$_POST['subjectforunsetexam'],PDO::PARAM_STR);
				$deletesetexm->bindParam(':clidd',$getresultcurrentcollegei,PDO::PARAM_STR);
				$deletesetexm->execute();
				$unsetexammerror = "Exam is unset";
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
		if (empty($_POST['subjectforunsetexam']))
		{
			$unsetexammerror = "Select Subject";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> SET / UNSET EXAM</title>
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
	<div class="container-fluid" style="background:#DFD297;padding:20px">
		<div class="row">
					<div class="col-md-4"> 
					<div class="panel panel-primary">
					<div class="panel-heading"> UNSET EXAM </div>
					<div class="panel-body">
					<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
					 <div class="form-group">
					 <?php
							  if (isset($unsetexammerror))
							   {
						 ?>
						 <div class="well">
								  <span class="text-danger"> 
								  <?php
									  echo $unsetexammerror;
									 ?>
								 </span> 
								
						 </div>
						 <?php
							   }
						  ?>
											  <?php  
											   include_once 'checkifsubjectsexist.php';
											   checksubjectexistindb();
											   include_once 'checkifquestionexist.php';
											   checkquestionexistindb();
											   include_once 'checkifsetexamexist.php';
											   checksetexamexistindb();
												  try
														{
															$servername = "localhost";
															$username = "root";
															$password = "mukeshbhandarii1*";
															$dbname = "online_exam"; 
															$connct = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
															$connct->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
															
															 $lsofsbtounset = $connct->prepare("Select Subject_Name from setexam where College_ID = (Select College_ID from admininfo where Email = :emailo)");
															 $lsofsbtounset->bindParam(':emailo',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
															 $lsofsbtounset->execute();
															 echo "<select name='subjectforunsetexam' class='form-control'>";
															 while($row = $lsofsbtounset->fetch(PDO::FETCH_ASSOC)){
																	 echo "<option>" . $row['Subject_Name'] .  "</option>";
																  }
															 echo "<select>";
														}

												   catch(PDOException $e)
														{
															echo $e->getMessage();
														}
											   ?>
							 </div>
					
					<input type="submit" class="btn-info btn" name="buttonforunsetexam"  value="UNSET" role="button"> <br/> <br/>
					</form>
					</div>
					</div>
					</div>
		
		
		
					<div class="col-md-4">
					<div class="panel panel-primary">
					<div class="panel-heading"> SET EXAM</div>
					<div class="panel-body">
					
					<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
					
					<?php
							  if (isset($wrongcausesubcodealexist))
							   {
						 ?>
						 <div class="well">
								  <span class="text-danger"> 
								  <?php
									  echo $wrongcausesubcodealexist;
									 ?>
								 </span> 
								
						 </div>
						 <?php
							   }
						  ?>
										  <div class="form-group">
											  <?php  
											   include_once 'checkifsubjectsexist.php';
											   checksubjectexistindb();
											   include_once 'checkifquestionexist.php';
											   checkquestionexistindb();
												  try
														{
															$servername = "localhost";
															$username = "root";
															$password = "mukeshbhandarii1*";
															$dbname = "online_exam"; 
															$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
															$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
															
															 $stmt = $conn->prepare("Select distinct(Subject_Code) from question where College_ID = (Select College_ID from admininfo where Email = :emailoff)");
															 $stmt->bindParam(':emailoff',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
															 $stmt->execute();
															 echo "<select name='subjectforquestionexam' class='form-control'>";
															 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
																  //$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
																	$stmtrty = $conn->prepare("Select Subject_Name from subjects where Subject_Code = :subbbcode");
																	$stmtrty->bindParam(':subbbcode',$row['Subject_Code'],PDO::PARAM_STR);
																	$stmtrty->execute();
																	$finalsubname = $stmtrty->fetchColumn();
																	 echo "<option>" . $finalsubname .  "</option>";
																  }
															 echo "<select>";
														}

												   catch(PDOException $e)
														{
															echo $sql . "<br/>". $e->getMessage();
														}
											   ?>
										  </div>
											<div class="form-group">
											<label for="totaltime"> Total Exam Time(in second) </label>
											<input type="number" class="form-control" name="totaltime"  id="totaltime" placeholder="Enter Total Exam Time in second" min="60" max="14400" autofocus required> 
											<!--<span class="text-danger">-->
													<?php
														//echo $userenterornot;
													?>
										<!--	</span> -->
										    </div>	
											<div class="form-group">
											<label for="dateforexam"> Date of Exam (YYYY-MM-DD) </label>
											<input type="text" class="form-control" pattern="\d{4}-\d{1,2}-\d{1,2}" name="dateforexam" id="dateforexam" placeholder="Enter Date of Exam (YYYY-MM-DD)" required> 
											<!--<span class="text-danger">-->
													<?php
														//echo $userenterornot;
													?>
										<!--	</span> -->
										    </div>	
										  
										  
										  <div class="form-group">
											<label for="timeforexam"> Time of Exam </label>
											<input type="time" class="form-control"  name="timeforexam" id="timeforexam" placeholder="Enter Time For Exam" required> 
											<!--<span class="text-danger">-->
													<?php
														//echo $userenterornot;
													?>
										<!--	</span> -->
										    </div>
										  
										  <div class="form-group">
											<label for="passmarks"> Pass Marks </label>
											<input type="number" class="form-control" name="passmarks" min="0.5" step="0.5" max="399" id="passmarks" placeholder="Enter Pass Marks" required> 
											<span class="text-danger">
													<?php
														echo $passmarkserror;
													?>
											</span>
										  </div>	
							<input type="submit" class="btn-info btn" name="buttonforsetexam"  value="SET" role="button"> <br/> <br/>
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
</body>
</html>