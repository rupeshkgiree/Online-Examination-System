<?php
session_start();
if ((!isset($_COOKIE['aalreadylogin'])) || (!isset($_SESSION['adminloginfromcheck'])))
{
	header("Location: adminlogin.php");
}
$_SESSION["fromahome"] = true;
require_once 'checkifquestionexist.php';
checkquestionexistindb();
function dbconnect()
				{
					try
					{
						$servername = "localhost";
						$username = "root";
						$password = "mukeshbhandarii1*";
						$dbname = "online_exam";
						$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
						$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						return $conn;
					}
					catch(PDOException $e)
					{
						echo $e->getMessage();
					}
				}
				function existensechec($conn,$data,$forsche,$forbp)
				{
					$existensecheck = $conn->prepare($forsche);	
					$existensecheck->bindParam($forbp,$data,PDO::PARAM_STR);
					$existensecheck->execute();
					$reg 	= $existensecheck->fetch(PDO::FETCH_ASSOC);
					return $reg;
				}
				


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if ((!empty($_POST['asubjectname'])) && (!empty($_POST['asubjectcode'])))
	{
				$checkduplicatesubjectcamecode =  dbconnect();
				if (isset($_POST['addbtnforsubadd']))
				{
					
					
					$forsche = "SELECT Subject_Name FROM subjects WHERE Subject_Name = :subname and College_ID = (Select College_ID From admininfo where Email = :eeemmmail)";
					
					function checksubjalreadyexistincurcol()
					{
					try{
								$servername = "localhost";
								$username = "root";
								$password = "mukeshbhandarii1*";
								$dbname = "online_exam";
								$getcoliddd = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
								$getcoliddd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
								$getcolgid=$getcoliddd->prepare("SELECT Subject_Name FROM subjects WHERE Subject_Name = :subname and College_ID = (Select College_ID From admininfo where Email = :eeemmmail)");
								$getcolgid->bindParam(':subname',$_POST['asubjectname'],PDO::PARAM_STR);
								$getcolgid->bindParam(':eeemmmail',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
								$getcolgid->execute();
								$qwerq 	= $getcolgid->fetchColumn();
								return $qwerq;
				
							}
							catch(PDOException $e)
							{
								echo $e->getMessage();
							}
					}
					$qwerq = checksubjalreadyexistincurcol();
					
					
						function checksubjcoalreadyexistincurcol()
					{
					try{
								$servername = "localhost";
								$username = "root";
								$password = "mukeshbhandarii1*";
								$dbname = "online_exam";
								$getcoliddd = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
								$getcoliddd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
								$getcolgid=$getcoliddd->prepare("SELECT Subject_Code FROM subjects WHERE Subject_Code = :subcode and College_ID = (Select College_ID From admininfo where Email = :eeemmmail)");
								$getcolgid->bindParam(':subcode',$_POST['asubjectcode'],PDO::PARAM_STR);
								$getcolgid->bindParam(':eeemmmail',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
								$getcolgid->execute();
								$qwerqty 	= $getcolgid->fetchColumn();
								return $qwerqty;
				
							}
							catch(PDOException $e)
							{
								echo $e->getMessage();
							}
					}
					$qwerqty = checksubjcoalreadyexistincurcol();
					
					if ($qwerq || $qwerqty)
					{
						 $error = 1;
						$acknowledgeaboutsubjectadd = "Subject Name or Code Already Exists";
					}
					
					/*$forsche = "SELECT Subject_Name FROM subjects WHERE Subject_Name = :subname";
					$forbp = ':subname';
					$emailexistencecheck = existensechec($checkduplicatesubjectcamecode,$_POST['asubjectname'],$forsche,$forbp);
					if ($emailexistencecheck['Subject_Name'])
						{
							 $acknowledgeaboutsubjectadd = "Subject Name or Code Already Exists";
							 $error = 1;
						}
					$forsche = "SELECT Subject_Code FROM subjects WHERE Subject_Code = :subcode";
					$forbp = ':subcode';
					$emailexistencecheck = existensechec($checkduplicatesubjectcamecode,$_POST['asubjectcode'],$forsche,$forbp);
					if ($emailexistencecheck['Subject_Code'])
						{
							$acknowledgeaboutsubjectadd = "Subject Name or Code Already Exists";
							$error = 1;
						}*/
					if (!(isset($error)))
						{
							$_SESSION['asubjectnamee'] = $_POST['asubjectname'];
							$_SESSION['asubjectcodee'] = $_POST['asubjectcode'];
							function abccolgid(){
							try{
								$servername = "localhost";
								$username = "root";
								$password = "mukeshbhandarii1*";
								$dbname = "online_exam";
								$getcoliddd = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
								$getcoliddd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
								$getcolgid=$getcoliddd->prepare("Select College_ID from admininfo where Email =:ema");
								$getcolgid->bindParam(':ema',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
								$getcolgid->execute();
								$colgid 	= $getcolgid->fetchColumn();
								return $colgid;
				
							}
							catch(PDOException $e)
							{
								echo $e->getMessage();
							}
					}
					$colgid = abccolgid();
					$_SESSION['asubjectiddd']	= $colgid;
							require_once 'ainsertsubjects.php';
							acreatetableindbforsubject();
							$acknowledgeaboutsubjectadd = "Subject Added Successfully in Database.";
						}
						
				}
				if (isset($_POST['deletebtnforsubdelete']))
				{
					function ab(){
							try{
								$servername = "localhost";
								$username = "root";
								$password = "mukeshbhandarii1*";
								$dbname = "online_exam";
								$getcoliddd = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
								$getcoliddd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
								$getcolgid=$getcoliddd->prepare("Select College_ID from subjects where Subject_Code = :subcode and Subject_Name = :subname");
								$getcolgid->bindParam(':subcode',$_POST['asubjectcode'],PDO::PARAM_STR);
								$getcolgid->bindParam(':subname',$_POST['asubjectname'],PDO::PARAM_STR);
								$getcolgid->execute();
								$rrr 	= $getcolgid->fetchColumn();
								return $rrr;
				
							}
							catch(PDOException $e)
							{
								echo $e->getMessage();
							}
					}
					
					
					function abccolgid(){
							try{
								$servername = "localhost";
								$username = "root";
								$password = "mukeshbhandarii1*";
								$dbname = "online_exam";
								$getcoliddd = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
								$getcoliddd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
								$getcolgid=$getcoliddd->prepare("Select College_ID from admininfo where Email =:ema");
								$getcolgid->bindParam(':ema',$_SESSION['adminloginemaill'],PDO::PARAM_STR);
								$getcolgid->execute();
								$xyz 	= $getcolgid->fetchColumn();
								return $xyz;
				
							}
							catch(PDOException $e)
							{
								echo $e->getMessage();
							}
					}
					
					$colgid = abccolgid();
					$isequal = ab();
					if ($isequal)
					{
					if ($colgid == $isequal)
					{
							$forqcheckforsubdel = "SELECT distinct(College_ID) FROM question WHERE Subject_Code = :subcodeforqcheck";	
							$subcodeinquestioncheck = $checkduplicatesubjectcamecode->prepare($forqcheckforsubdel);	
							$subcodeinquestioncheck->bindParam(':subcodeforqcheck',$_POST['asubjectcode'],PDO::PARAM_STR);
							$subcodeinquestioncheck->execute();
							if (!$subcodeinquestioncheck->fetchColumn())
							{
							
							
									$forsche = "SELECT Subject_Name,Subject_Code FROM subjects WHERE Subject_Name = :subname and Subject_Code = :subcode";	
									$existensecheck = $checkduplicatesubjectcamecode->prepare($forsche);	
									$existensecheck->bindParam(':subname',$_POST['asubjectname'],PDO::PARAM_STR);
									$existensecheck->bindParam(':subcode',$_POST['asubjectcode'],PDO::PARAM_STR);
									$existensecheck->execute();
									$subjectcoexistencecheck 	= $existensecheck->fetch(PDO::FETCH_ASSOC);
									if (($subjectcoexistencecheck['Subject_Name']) && ($subjectcoexistencecheck['Subject_Code']))
										{	 
											$fordeletesub = "DELETE FROM subjects WHERE Subject_Name = :subname && Subject_Code = :subcodee";
											$forbp = $_POST['asubjectcode'];
											$deletesubnaco = $checkduplicatesubjectcamecode->prepare($fordeletesub);	
											$deletesubnaco->bindParam(':subname',$_POST['asubjectname'],PDO::PARAM_STR);
											$deletesubnaco->bindParam(':subcodee',$_POST['asubjectcode'],PDO::PARAM_STR);
											$deletesubnaco->execute();
											$acknowledgeaboutsubjectadd = "Sucessfully Deleted the Record";
										}
									else
									{
										//$error = 1;
										$acknowledgeaboutsubjectadd = "Subject Name and Code Doesnot Match Each Other";
									}
							}
							else
							{
								$acknowledgeaboutsubjectadd = "Question is Added for this Subject. First Delete Question";
							}
				}
				if ($colgid != $isequal)
				{
					$acknowledgeaboutsubjectadd = "Subject Doesnot Exist.";
				}
				}
				if (!$isequal)
				{
					$acknowledgeaboutsubjectadd = "Subject Doesnot Exist (or Subject Name and Code Doesnot Match Each Other)";
				}
				}
    }	
    else
	{
		$acknowledgeaboutsubjectadd = "Both Field are Required.";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> HOME </title>
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
		<ul class="nav navbar-nav">
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
				<a href="#exploresubject" data-toggle="collapse" style="margin-bottom:5px" class="btn btn-primary btn-block"> ADD / DELETE SUBJECTS </a>
					<?php
				if (isset($acknowledgeaboutsubjectadd))
				{
				?>
				<div class="well">
				<span class="text-danger">
				<?php
				echo $acknowledgeaboutsubjectadd;
				unset($acknowledgeaboutsubjectadd);
				?>
				</span>
				</div>
				<?php
				}
				?>
				<div id="exploresubject" class="container-fluid collapse">
				<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				<div class="form-group">
				<label for="asubjectname" class="text-danger"> Enter Subject Name </label> <input type="text" placeholder="Subject Name" class="form-control" value="" name="asubjectname" id="asubjectname" maxlength="50" >
				</div>
				
				<div class="form-group">
				<label for="asubjectcode" class="text-danger"> Enter Subject Code </label> <input type="text" placeholder="Subject Code" class="form-control" value="" name="asubjectcode" id="asubjectcode" maxlength="12" >
				</div>
				
				<input type="submit" value="ADD" name="addbtnforsubadd" class="btn btn-info">
				<input type="submit" value="DELETE" name="deletebtnforsubdelete" class="btn btn-info pull-right">
				</form>
				</div>
				</div>
				<div class="col-md-4">
				<a href="viewresults.php" class="btn btn-primary btn-block"> View Results </a>
				</div>
				<div class="col-md-4">
				<a href="viewusers.php" class="btn btn-primary btn-block"> View All Users </a>
				</div>
			</div>
		</div>
	</div>
	
	<div class = "container-fluid" style="margin-top:20px">
			<?php
			$servername = "localhost";
			$username = "root";
			$password = "mukeshbhandarii1*";
			$dbname = "online_exam";

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $conn->prepare("SELECT Subject_Code,Subject_Name FROM subjects where College_ID = (Select College_ID from admininfo where Email = :eofadin)");
				$stmt->bindParam(':eofadin',$_SESSION['adminloginemaill'],PDO::PARAM_STR);				
				$stmt->execute();
				echo "<table class='table table-striped table-bordered'>";
				echo "<tr><th> SUBJECT CODE</th><th> SUBJECT NAME </th> <th> ADD / DELETE QUESTION </th> <th> SET / UNSET EXAM </th> </tr>";
				$addquestionlink = "addquestion.php";
				$setexam = "setexam.php";

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$_SESSION["fromahomeset"] = true;
	echo "<tr style='background: grey; border: 2px solid red;'> <td>" . $row['Subject_Code'] . "</td><td>" . $row['Subject_Name'] . "</td><td> <a href='$addquestionlink'> Click Here </a> </td><td> <a href='$setexam'> Click Here </a> </td></tr>";

}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			$conn = null;
			echo "</table>";
			?> 
				</table>
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