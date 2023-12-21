<?php
$feedbackemailerror = "";
$feedbacksubmitted ="";
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
						$checfeedbackemail = dbconnect();
						 $forsche = "SELECT Email FROM userinfo WHERE Email = :email UNION SELECT Email FROM admininfo WHERE Email = :email";
						 $forbp = ':email';
						 $emailexistencecheck = existensechec($checfeedbackemail,$_POST['feedbacemail'],$forsche,$forbp);
							if (!$emailexistencecheck['Email'])
									{
										$feedbackemailerror = "Email Doesnot Exist. You need to be memeber to give feedback";
										$error = 1;
									}
									else
									{
										$feedbacksubmitted = "Feedback Submitted";
									}
						if (isset($_POST['sbutforfeeback']))
						{
							if (!(isset($error)))
							{
							include_once 'ainsertfeedback.php';
							 $_SESSION['afeedbackemail'] = $_POST['feedbacemail'];
							 $_SESSION['afeedbacktopic'] = $_POST['feedbactopic'];
							 $_SESSION['afeedbackdescribe'] = $_POST['feedbacdescribe'];
							acreatetableindbforfeedback();
							unset( $_SESSION['afeedbackemail']);
							unset($_SESSION['afeedbacktopic']);
							unset($_SESSION['afeedbackdescribe']);
							}
						}
					}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Feedback </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js">		</script>
	<script src="js/bootstrap.min.js">	</script>
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
		.main{
						 margin-bottom:10px;
		}
		</style>
		
</head>

<body>


<div class="container-fluid main" style="background:#C0C0C0">
	<div class="jumbotron text-center">
		 <h1>  <span class="glyphicon glyphicon-education">Online Examination System  <span class="glyphicon glyphicon-education"> </h1>
		<p> Give Online Exams For Any Subjects </p>
		<p> Improve Your Skills </p>
	</div>
<div class="container-fluid">
	<div class="col-md-3">   <a class="btn btn-info btn-block" href="../index.php" role="button"> Main Page </a> <br/>
	<a class="btn btn-info btn-block" href="userlogin.php" role="button"> User Login </a> <br/>
	<a class="btn btn-info btn-block" href="../adminlogin/adminlogin.php" role="button"> Admin Login </a> <br/>
	</div>
	 
	<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"> Feedback </div>
					<div class="panel-body"> 
						<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="userfeedbackform">
						<p style="color:red"> If you find any kind of bug in this website or you want any feature to be added or if you have any problem. Please Inform us by giving feedback. </p>
							<div class="form-group">
							<span class="text-danger"> 
									<?php
										echo $feedbacksubmitted;
										echo "<br/>";
									?>
								</span>	
								<label for="feedbackemail"> Email </label>
				      	<input type="email" class="form-control" name="feedbacemail" id="feedbackemail" maxlength="40" autofocus required>
								<span class="text-danger"> 
									<?php
										echo $feedbackemailerror;
									?>
								</span>	
							</div>
							
							<div class="form-group">
								<label for="feedbacktopic"> Topic </label>
					<input type="text" class="form-control" name="feedbactopic" id="feedbacktopic" maxlength="40"  required>
							  </div>
							  <div class="form-group">
					<label for="textare"> Description </label> 
					<textarea class="form-control" name="feedbacdescribe" rows="5" id="textare" maxlength="65535"> </textarea>
					</div>
					<button type="submit" class="btn btn-primary" style="margin-bottom:5px" name="sbutforfeeback"> Submit </button>
						</form>
						</div>
					<div class="panel-footer"> 
					</div>
				</div>
			</div>
	
	
	<div class="col-md-3 pull-right"> </div>
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
