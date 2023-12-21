<?php
session_start();
if (!isset($_SESSION['frompasswordphp']))
{
	header("Location: password.php");
}
function createdbonlineexam(){
try {
	$servername = "localhost";
	$username = "root";
	$password = "mukeshbhandarii1*";
	$conn = new PDO("mysql:host=$servername", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$creatingdatabse = "Create Database if not exists online_exam";
	$conn->exec($creatingdatabse);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
}
createdbonlineexam();
function supercreatevericodetableindb()
{
	try {
		$servername = "localhost";
		$username = "root";
		$password = "mukeshbhandarii1*";
		$dbname = "online_exam"; 
		$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$creatingtabl = "CREATE TABLE IF NOT EXISTS verificationcode(
		`SN` int UNSIGNED NOT NULL auto_increment,
		`Verification_Code` varchar(12) NOT NULL,
		`Flag` tinyint(1) NOT NULL,
		PRIMARY KEY(SN)
		)";
		$conn->exec($creatingtabl);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}
supercreatevericodetableindb();
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
										$emalforcf = $_POST['adminemaildeactreact'];
										$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
										$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
										
										$echeckforuflagchng = $conn->prepare("SELECT Email FROM admininfo WHERE Email = :email");	
										$echeckforuflagchng->bindParam(':email',$emalforcf,PDO::PARAM_STR);
										$echeckforuflagchng->execute();
										$resemail 	= $echeckforuflagchng->fetch(PDO::FETCH_ASSOC);
										$result = $resemail['Email'];
										
										/*Updating Flag to 0 or 1 according to pressed button after knowing the email*/
										$updateflagonadm = "UPDATE admininfo SET Flag = :flagvalue WHERE (Email = :email)";
										
										if (($emalforcf == $resemail["Email"]))
										{
											if (isset($_POST['buttonfordeact']))
											{
												$flagggvalue = 0;
												$_SESSION['adminemaildeactreacterror'] = "Succesfully Disabled " . $result . " account";
											}
											if (isset($_POST['buttonforreact']))
											{
												$flagggvalue = 1;
												$_SESSION['adminemaildeactreacterror'] = "Succesfully Enabled " . $result . " account";
											}
											
												$stmttt = $conn->prepare($updateflagonadm);
												$stmttt->bindParam(':email',$emalforcf,PDO::PARAM_STR);
												$stmttt->bindParam(':flagvalue',$flagggvalue,PDO::PARAM_STR);
												$stmttt->execute();
												$_SESSION["fromsuperadmincf"] = true;
												$_SESSION["emaildeactreact"] = $_POST['adminemaildeactreact'];
												$_SESSION['errorontopofactivateordeactivate'] = "true";
												if ($flagggvalue == 0)
													{
														header("Location: adminlogin/alogoutaftersuperadmin.php");
													}
										}
										else
										{
											$_SESSION['errorontopofactivateordeactivate'] = "true";
											$_SESSION['adminemaildeactreacterror'] = "Incorrect Email";
										}
										
								}
								catch (PDOException $e)
								{
									echo $e->getMessage();
								}
			}
		if (isset($_POST['buttonforaddvericode']))
		{
			
			function vcodealreadyexistornot()
			{
					try {
							$servername = "localhost";
							$username = "root";
							$password = "mukeshbhandarii1*";
							$dbname = "online_exam"; 
							$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$vcode = $_POST['vericode'];
							$checkvcodexist=$conn->prepare("Select Verification_Code from verificationcode where Verification_Code = :vc");
							$checkvcodexist->bindParam(':vc',$vcode,PDO::PARAM_STR);
							$checkvcodexist->execute();
							$existyesorno = $checkvcodexist->fetchColumn();
							return $existyesorno;
										
						}
					catch(PDOException $e)
						{
								echo $e->getMessage();
						}
			
			}
			$existyesorno = vcodealreadyexistornot();
			if (!$existyesorno)
			{
				try {
						$servername = "localhost";
						$username = "root";
						$password = "mukeshbhandarii1*";
						$dbname = "online_exam"; 
						$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
						$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$flagfo   = 1;
						$vcode = $_POST['vericode'];
						$sql = "INSERT INTO verificationcode (Verification_Code,Flag)
						VALUES ('$vcode','$flagfo')";
						$conn->exec($sql);
						$vcodeerror = "Verification Code Added Sucessfully";
									
					}
				catch(PDOException $e)
					{
							echo $e->getMessage();
					}
				
				
			}
			else
					{
						$vcodeerror = "Verification Code Already Exist on Database";
					}
		}
		
		if (isset($_POST['buttonfordeletevericode']))
		{
			function vcodealreadyexistornot()
			{
					try {
							$servername = "localhost";
							$username = "root";
							$password = "mukeshbhandarii1*";
							$dbname = "online_exam"; 
							$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$vcode = $_POST['vericode'];
							$checkvcodexist=$conn->prepare("Select Verification_Code from verificationcode where Verification_Code = :vc");
							$checkvcodexist->bindParam(':vc',$vcode,PDO::PARAM_STR);
							$checkvcodexist->execute();
							$existyesorno = $checkvcodexist->fetchColumn();
							return $existyesorno;
										
						}
					catch(PDOException $e)
						{
								echo $e->getMessage();
						}
			
			}
			$existyesorno = vcodealreadyexistornot();
			if ($existyesorno)
			{
				try {
							$servername = "localhost";
							$username = "root";
							$password = "mukeshbhandarii1*";
							$dbname = "online_exam"; 
							$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$vcode = $_POST['vericode'];
							$checkvcodelete=$conn->prepare("Delete From verificationcode where Verification_Code = :vc");
							$checkvcodelete->bindParam(':vc',$vcode,PDO::PARAM_STR);
							$checkvcodelete->execute();
							$vcodeerror = "Verification Code Deleted Sucessfully";
										
						}
					catch(PDOException $e)
						{
								echo $e->getMessage();
						}
			
			}
			if (!$existyesorno)
			{
				$vcodeerror = "Verification Code Doesnot Exist";
			}
			
		}
		
}
?>
<!DOCTYPE html>
<html>
<head>
<title> Super Admin Home Page </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="userlogin/css/bootstrap.min.css">
	<script src="userlogin/js/jquery.min.js">		</script>
	<script src="userlogin/js/bootstrap.min.js">	</script>
</head>
<body style="background:#C0C0C0">
<div class="jumbotron text-center" style="margin-bottom:5px;background:#50d07d">
<h1> <span class="glyphicon glyphicon-education"> Online Examination System <span class="glyphicon glyphicon-education"> </h1>
</div>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div>
		<ul class="nav navbar-nav navbar-right">
			<li> <a href="superadminlogout.php">Log Out </a> </li>
		</ul>
		</div>
	</div>
</nav>
<div class="container-fluid">
	<div class="container-fluid" style="background:#DFD297;padding:20px">
		<div class="row">
					<div class="col-md-4">  
					
					<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
					<?php
						if (isset($_SESSION['errorontopofactivateordeactivate']))
							   {
								  
					?>
					 <div class="well">
							 <span class="text-danger"> 
									<?php
										echo $_SESSION['adminemaildeactreacterror'];
									 ?>
							  </span> 
										
					</div>
					 <?php
					 unset($_SESSION['errorontopofactivateordeactivate']);
							}
					?>
								 
							  <div class="form-group">
								<label for="adminemaildeactreact">Admin Email </label>
								<input type="email" class="form-control" name="adminemaildeactreact"  id="adminemaildeactreact" placeholder="Enter Admin Email" required> 
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
		
					<div class="col-md-4">
					<div class="panel panel-primary">
					<div class="panel-heading"> ADD / DELETE VERIFICATION CODE </div>
					<div class="panel-body">
					
					<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">	
					<?php
							  if (isset($vcodeerror))
							   {
						 ?>
						 <div class="well">
								  <span class="text-danger"> 
								  <?php
									  echo $vcodeerror;
									 ?>
								 </span> 
								
						 </div>
						  <?php
							   }
						  ?>
											<div class="form-group">
											<label for="vericode"> Verification Code </label>
											<input type="text" class="form-control" maxlength="12" name="vericode" id="vericode" placeholder="Enter Verification Code" required> 
										    </div>
							<input type="submit" class="btn-info btn" name="buttonforaddvericode"  value="ADD" role="button"> 
							<input type="submit" class="btn-info btn pull-right" name="buttonfordeletevericode"  value="DELETE" role="button">
					</form>
					</div>
			</div>
			
			
			
			</div>
			
			
			
			<div class="col-md-4"> <div class="dropdown">
						<?php
							try
								{
									$servername = "localhost";
									$username = "root";
									$password = "mukeshbhandarii1*";
									$dbname = "online_exam"; 
									$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
									$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
									 $stmt = $conn->prepare("Select Verification_Code from verificationcode");
									 $stmt->execute();
								echo "<select class='form-control'>";
									  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										echo "<option>" . $row['Verification_Code']. "</option>";    
										  }
										   echo "<select>";
									
								}

							catch(PDOException $e)
								{
									echo $e->getMessage();
								}
								
							?>
							
						
						</div> 
						</div>
		</div>
	</div>
</div>


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
    $stmt = $conn->prepare("SELECT College_Name,Email,Country,Street_Address,College_ID,Registration_Date,Flag FROM admininfo");
    $stmt->execute();
	echo "<table class='table table-striped table-bordered'>";
	echo "<tr><th> COLLEGE NAME</th> <th> EMAIL	</th><th> COUNTRY  </th><th> ADDRESS  </th> <th>College_ID 	</th><th>Registration Date 	</th><th>Account_Status	</th>  </tr>";
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		if ($row['Flag'] == 0)
		{
			$accountstatus = "Disabled";
		}
		if ($row['Flag'] == 1)
		{
			$accountstatus = "Enabled";
		}
	echo "<tr style='background: grey; border: 2px solid red;'> <td>" . $row['College_Name'] . "</td> <td>" . $row['Email'] . "</td><td>" . $row['Country'] . "</td> <td>" . $row['Street_Address'] . "</td> <td>" . $row['College_ID']. "</td> <td>" . $row['Registration_Date'] . "</td><td>" .$accountstatus. "</td></tr>";

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