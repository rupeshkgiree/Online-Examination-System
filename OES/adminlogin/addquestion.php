<?PHP
session_start();
if ((!isset($_COOKIE['aalreadylogin'])) || (!isset($_SESSION['fromahome'])))
{
	header("Location: adminlogin.php");
}
if (!isset($_SESSION["fromahomeset"]))
{
		header("Location: home.php");
}
$questionaddedornot="";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
if (isset($_POST['adddd']))
	{
		include 'dbconnect.php';
		$cn20 =  dbconnseparate();
			$collegekoid = $cn20->prepare("SELECT College_ID FROM admininfo WHERE Email = :maile");
			$collegekoid->bindParam(':maile',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
			$collegekoid->execute();
			$clgkoid = $collegekoid->fetchColumn();
			$cn20 = null;
			$collegekoid = null;
			
			$cn21= dbconnseparate();
			$setexamexistforsubjectlai = $cn21->prepare("Select Subject_Name from setexam where College_ID = :clokoid and Subject_Name = :samekon");
			$setexamexistforsubjectlai->bindParam(':clokoid',$clgkoid,PDO::PARAM_STR);
			$setexamexistforsubjectlai->bindParam(':samekon',$_POST['subjectforquestion'],PDO::PARAM_STR);
			$setexamexistforsubjectlai->execute();
			$sethokihaina = $setexamexistforsubjectlai->fetchColumn();
			$cn21 = null;
			
			
			
		if (!$sethokihaina)
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
				$anssr 	= $cid->fetchColumn();
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
				$cemail->bindParam(':subname',$_POST['subjectforquestion'],PDO::PARAM_STR);
				$cemail->execute();
				$ansemail 	= $cemail->fetchColumn();
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		
		function checkingfortotalmarksexceed()
		{
			try
			{
				$servername = "localhost";
				$username = "root";
				$password = "mukeshbhandarii1*";
				$dbname = "online_exam"; 
				$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$subnesubc=$conn->prepare("Select sum(Question_Marks) from question where College_ID = :abcd and Subject_Code = :efgh");
				$subnesubc->bindParam(':abcd',$anssr,PDO::PARAM_STR);
				$subnesubc->bindParam(':efgh',$ansemail,PDO::PARAM_STR);
			    $subnesubc->execute();
			    $ans 	= $subnesubc->fetchColumn();
				return $ans;
			}
			catch (PDOException $e)
			{
				echo $sql . "<br/>". $e->getMessage();
			}
		}
		$getresoftotalmarks = checkingfortotalmarksexceed();
			if (($getresoftotalmarks + $_POST['aquestionmarks'])<=400)
			{
			
					function subnameequisubcode()
					{
						try
						{
							$servername = "localhost";
							$username = "root";
							$password = "mukeshbhandarii1*";
							$dbname = "online_exam"; 
							$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
							$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
							$subnesubc=$conn->prepare("Select Subject_Code from subjects where Subject_Name = :subname");
							$subnesubc->bindParam(':subname',$_POST['subjectforquestion'],PDO::PARAM_STR);
							$subnesubc->execute();
							$ans 	= $subnesubc->fetchColumn();
							return $ans;
						}
						catch (PDOException $e)
						{
							echo $sql . "<br/>". $e->getMessage();
						}
					}
					
					 $subnamequisubcod = subnameequisubcode();
					
					 $_SESSION['ssuborquestionn'] = $subnamequisubcod;
					$_SESSION['aquestionn'] = $_POST['aquestion'];
					$_SESSION['optiononee'] = $_POST['aquestionanswer1'];
					$_SESSION['optiontwoo'] = $_POST['aquestionanswer2'];
					$_SESSION['optionthreee'] = $_POST['aquestionanswer3'];
					$_SESSION['optionfourr'] = $_POST['aquestionanswer4'];
					 if ($_POST['aquestiondefaultanswer'] == "Option 1")
						{
							$corrans = $_POST['aquestionanswer1'];
						}
					else if ($_POST['aquestiondefaultanswer'] == "Option 2")	 
						{
							$corrans = $_POST['aquestionanswer2'];
						}
					else if ($_POST['aquestiondefaultanswer'] == "Option 3")
						{
							$corrans = $_POST['aquestionanswer3'];
						}
					else
						{
							$corrans = $_POST['aquestionanswer4'];
						}
						
						
							function getcollegeidfromemailcurrent()
							{
								try{
									$servername = "localhost";
									$username = "root";
									$password = "mukeshbhandarii1*";
									$dbname = "online_exam";
									$co = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
									$co->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
									$randommmm=$co->prepare("Select College_ID from admininfo where Email = :emill");
									$randommmm->bindParam(':emill',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
									$randommmm->execute();
									$answre = $randommmm->fetchColumn();
									return $answre;
								}
								catch(PDOException $e)
								{
									echo $e->getMessage();
								}
							}
							$answre = getcollegeidfromemailcurrent();
					$_SESSION['collegeidofacuadmin'] = $answre;
					$_SESSION['correctanswerr'] = $corrans;
					$_SESSION['questionmarkss'] = $_POST['aquestionmarks'];
					if (!empty($_POST['subjectforquestion']))
					{
						
					require_once 'ainsertquestions.php';
					acreatetableindbforquestions();
					$questionaddedornot="Question Added Sucessfully";
					}
					else
					{
						$questionaddedornot = "Choose the Subject Name.";
					}
		}
		else
		{
			$questionaddedornot = "Total Marks Exceed By 400. Question cannot be added further";
		}
	}
	if ($sethokihaina)
	{
		$questionaddedornot = "Exam is Already SET for this exam. First UNSET The Exam";
	}
	}
	
	if (isset($_POST['buttonfordeleteexam']))
	{
		if (!empty($_POST['subjectfordeque']))
		{
			
			include_once 'dbconnect.php';
			
			$con1j = dbconnseparate();
			$colgdi = $con1j->prepare("SELECT College_ID FROM admininfo WHERE Email = :maile");
			$colgdi->bindParam(':maile',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
			$colgdi->execute();
			$clgdi = $colgdi->fetchColumn();
			$con1j = null;
			$colgdi = null;
			
			include_once 'dbconnect.php';
			$con1e = dbconnseparate();
			$setexamexistforsubject = $con1e->prepare("Select Subject_Name from setexam where College_ID = :cloid and Subject_Name = :samen");
			$setexamexistforsubject->bindParam(':cloid',$clgdi,PDO::PARAM_STR);
			$setexamexistforsubject->bindParam(':samen',$_POST['subjectfordeque'],PDO::PARAM_STR);
			$setexamexistforsubject->execute();
			$abcdieo = $setexamexistforsubject->fetchColumn();
			$con1e = null;
			
			$con1ui = dbconnseparate();
			if (!$abcdieo)
			{
			$ertyu = $con1ui->prepare("Select Subject_Code from subjects where College_ID= :cliddc and Subject_Name = :sbdce");
			$ertyu->bindParam(':cliddc',$clgdi,PDO::PARAM_STR);
			$ertyu->bindParam(':sbdce',$_POST['subjectfordeque'],PDO::PARAM_STR);
			$ertyu->execute();
			$abcdi= $ertyu->fetchColumn();
			$con1ui = null;
			$ertyu = null;
			
			$con1f = dbconnseparate();
			$deleteallquestionforssub = $con1f->prepare("Delete from question where College_ID= :cloiddd and Subject_Code = :sbcode");
			$deleteallquestionforssub->bindParam(':cloiddd',$clgdi,PDO::PARAM_STR);
			$deleteallquestionforssub->bindParam(':sbcode',$abcdi,PDO::PARAM_STR);
			$deleteallquestionforssub->execute();
			$deletequestionerror = "All Question Successfully Deleted";
			}
			if ($abcdieo)
			{
				$deletequestionerror = "Exam is SET for this subject.First UNSET the EXAM";
			
			}
		}
		if (empty($_POST['subjectfordeque']))
		{
			$deletequestionerror = "Select Subject";
		}
	}
	$con1f = null;
	$deleteallquestionforssub = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> ADD / DELETE QUESTIONS </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../userlogin/css/bootstrap.min.css">
<script src="../userlogin/js/jquery.min.js">		</script>
<script src="../userlogin/js/bootstrap.min.js">	</script>
</head>
<style>
		.jumbotron{
						 margin-top:2px;
						 margin-bottom:3px;
						 padding-top:10px;
						 background:#50d07d;
		}

		.jumbotron p{
						 line-height:20px;
						 color:#651287;
		}
</style>
<body style = "background:#C0C0C0">
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
			//$email = $_SESSION['adminloginemaill'];
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

<div class="container-fluid" style="background:#DFD297;padding-bottom:10px;padding-top:10px">

<div class="row">

<div class="col-md-4">
<div class="panel panel-primary">
<div class="panel-heading"> DELETE ALL QUESTION </div>
<div class="panel-body">

<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
					 <div class="form-group">
					 <?php
							  if (isset($deletequestionerror))
							   {
						 ?>
						 <div class="well">
								  <span class="text-danger"> 
								  <?php
									  echo $deletequestionerror;
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
												 
															 include_once 'dbconnect.php';
															$connact = dbconnseparate();
															$stmt = $connact->prepare("Select distinct(Subject_Code) from question where College_ID = (Select College_ID from admininfo where Email = :emao)");
															 $stmt->bindParam(':emao',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
															 $stmt->execute();
															 echo "<select name='subjectfordeque' class='form-control'>";
															 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
																	$ssname = $connact->prepare("Select Subject_Name from subjects where Subject_Code = :subbbbbcode");
																	$ssname->bindParam(':subbbbbcode',$row['Subject_Code'],PDO::PARAM_STR);
																	$ssname->execute();
																	$finalsubnam = $ssname->fetchColumn();
																	 echo "<option>" . $finalsubnam .  "</option>";
																  }
															 echo "<select>";
														

												  
											   ?>
							 </div>
					
					<input type="submit" class="btn-info btn" name="buttonfordeleteexam"  value="DELETE" role="button"> <br/> <br/>
					</form>
</div>
</div>


</div>

<div class="col-md-6">
<div class="panel panel-primary">
					<div class="panel-heading"> ADD QUESTION</div>
					<div class="panel-body" style="background:yellow">
<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<span class="text-danger">
				<?php
				echo $questionaddedornot;
				?>
</span>
<div class="form-group">
		  <?php  
		   include_once 'checkifsubjectsexist.php';
		   checksubjectexistindb();
			  try
					{
						$servername = "localhost";
						$username = "root";
						$password = "mukeshbhandarii1*";
						$dbname = "online_exam"; 
						$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
						$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						 $stmt = $conn->prepare("select Subject_Name,Subject_Code from subjects where College_ID = (Select College_ID from admininfo where Email = :liame)");
						 $stmt->bindParam(':liame',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
						 $stmt->execute();
						 echo "<select name='subjectforquestion' class='form-control'>";
						  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
								 echo "<option>" . $row['Subject_Name'] .  "</option>";
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
<label for="aquestionnnnn"> Type Question </label>
<textarea rows="5" maxlength="65535" class="form-control" name="aquestion" id="aquestionnnnn" placeholder="Type Question" autofocus required>  </textarea>
</div>

<div class="form-group">
<label for="aquestionanswerone"> Option 1 </label>
<input type="text" maxlength="40" class="form-control" name="aquestionanswer1" id="aquestionanswerone" placeholder="Option 1" required>
</div>

<div class="form-group">
<label for="aquestionanswertwo"> Option 2 </label>
<input type="text" maxlength="40" class="form-control" name="aquestionanswer2" id="aquestionanswertwo" placeholder="Option 2" required>
</div>

<div class="form-group">
<label for="aquestionanswerthree"> Option 3 </label>
<input type="text" maxlength="40" class="form-control" name="aquestionanswer3" id="aquestionanswerthree" placeholder="Option 3" required>
</div>

<div class="form-group">
<label for="aquestionanswerfour"> Option 4 </label>
<input type="text" maxlength="40" class="form-control" name="aquestionanswer4" id="aquestionanswerfour" placeholder="Option 4" required>
</div>

<div class="form-group">
<label for="aquestiondefaultanswer"> Correct Answer </label>
<select id="aquestiondefaultanswer" class="form-control"  name="aquestiondefaultanswer">
<option>Option 1</option>
<option>Option 2</option>
<option>Option 3</option>
<option>Option 4</option>
</select>
</div>

<div class="form-group">
<label for="aquestionmarks"> Question Marks</label>
<input type="number" min="1" step="0.5"  max="5" class="form-control" id="aquestionmarks" name="aquestionmarks" placeholder="Question_Marks" required>
</div>

<input type="submit" class="btn btn-info" name="adddd" value="ADD">
<a href="home.php" class="btn btn-info pull-right"> Finish </a>
</form>
</div>
</div>
</div>
<div class="col-md-2 pull-right">
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
