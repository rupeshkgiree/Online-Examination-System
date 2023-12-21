<?php
session_start();
//if (!isset($_SESSION['flagchanged']))
//{
		if (isset($_COOKIE['ualreadylogin']))
		{
			header("Location: home.php");
		}
//}
include_once 'checkifuserinfoexist.php';
include_once 'checkifadmininfoexist.php';
include_once 'checkiffeedbackexist.php';
include_once '../adminlogin/checkifsetexamexist.php';
include_once '../adminlogin/checkifquestionexist.php';
checkuserinfoexistindb();
checkadmininfoexistindb();
checkfeedbackexistindb();
checksetexamexistindb();
checkquestionexistindb();
$userloginprevious = true;
$useremailerror = "";
$userpassworderror = "";
$useremail = "";
$userpassword = "";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
				/*if (!$_SESSION['fromuserlogincheckforwronglogincount'])
						{
							$_SESSION['noofwrongloginu']= 0;
						}
						 if ( $_SESSION['noofwrongloginu']>6)
						{
							
						}*/
	if ((empty($_POST['useremail'])) || (empty($_POST['userpassword'])))
	{
		if (empty($_POST['useremail']))
				{
					$useremailerror = "Email is Required";
				}
			else
				{
					$useremail = $_POST['useremail'];
				}
			
			if (empty($_POST['userpassword']))
				{
					$userpassworderror = "Password is Required";
				}
			else
				{
					$userpassword = $_POST['userpassword'];
				}
	}
	else
	{
		$userloginemail		 = $_POST['useremail'];
		$userloginpassword 	 = $_POST['userpassword'];
		$userloginprevious = true;
		$_SESSION['userloginpreviouss'] = $userloginprevious;
		$_SESSION['userloginemaill'] 	=  $userloginemail;
		$_SESSION['userloginpasswordd']  = $userloginpassword;
		header("Location: userlogincheck.php");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title> User Login </title>
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
		.navbar{
						 margin-bottom:5px;
		}
		.main{
						 margin-bottom:10px;
		}
		.foot{
						 background:#d3d3d3;
						 margin-top:5px;
						 padding-bottom:10px;
		}
		.modalphoto{
						 margin-left:auto;
						 margin-right:auto;
		}
		.forjscript{
						 color:#ff0000;
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

	
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand" href="#"><img src="images/teammrj.jpg" class="img-circle img-responsive" style="max-width:20%" alt="Logo"> </a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li>	<a href="../index.php"><span class="glyphicon glyphicon-home"></span> Main Page</a>	</li>
					<li>				<a href="#aboutus" data-toggle="collapse" >		 	About Us				</a>	</li>
					
					
					<li>				<a data-toggle="modal" data-target="#ourcontact">	<span class="glyphicon glyphicon-inbox">  </span>	Contact	</a>	</li>
										<div id="ourcontact" class="modal" style="background:rgba(0,0,0,0.9)" role="dialog">
										<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
										<h3> Contact Us </h3>
										<p> You can freely contact us for any work regarding Web Devlopment. </p>
										</div>
										<div class="modal-body">
										<table class="table">
										<tr>
										<td> Mobile Numbers </td>
										<td> +9779818334852, +9779813055132, +9779861117612</td>
										</tr>
										<tr>
										<td> Email </td>
										<td> mukeshrupeshjeevan@engineer.com </td>
										</tr>
										<tr>
										<td>  </td>
										<td>  </td>
										</tr>
										</table>
										
										</div>
										<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
										</div>
										</div>
										</div>
										</div>
										
					
					
					<li>	<a href="feedback.php"><span class="glyphicon glyphicon-comment"></span> Feedback </a>	</li>
					<!--
					<li>				<a  data-toggle="modal" data-target="#feedback">		<span class="glyphicon glyphicon-comment">  </span>		Feedback	</a>	</li>
					<div id="feedback" class="modal" style="background:rgba(0,0,0,0.9)" role="dialog">
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<h3> Feedback </h3>
					<p> If you find any kind of bug in this website or you want any feature to be added or if you have any problem. Please Inform us by giving feedback. </p>
					</div>
					<div class="modal-body">
					<form role="form" method="POST" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					
					<div class="form-group">
					<label for="feedbackemail"> Email </label>
					<input type="email" class="form-control" name="feedbacemail" id="feedbackemail" maxlength="40"  required>
					</div>
					
					<div class="form-group">
					<label for="feedbacktopic"> Topic </label>
					<input type="text" class="form-control" name="feedbactopic" id="feedbacktopic" maxlength="40"  required>
					</div>
					
					<div class="form-group">
					<label for="textare"> Describe </label> 
					<textarea class="form-control" name="feedbacdescribe" rows="5" id="textare" maxlength="65535"> </textarea>
					</div>
					<div class="form-group">
					<button type="submit"  class="btn btn-primary" name="sbutforfeeback"> Submit </button>
					
					</div>
					
					</form>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
					</div>
					</div>
					</div>
					</div> -->
				</ul>
			</div>
		</div>
	</nav>
	
	
	<div class="container-fluid" style="background:#ADD8E6">
		<div class="row">
			<div class="col-md-6">
			<h3> Welcome</h3> 
				<p> Here you can give online exams for different subjects. You can view the result right after you
				finish the exam and can even download the results. There will be Review of answer. So you will know what is the 
				correct answer, what mistake did you do.
				</p> 
				<img src="images/onlineexam.png" style="margin-bottom:5px" class="img-responsive"  alt="Images">
			</div>
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"> User Login </div>
					<div class="panel-body"> 
						<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" name="userloginform">
						<?php
							  if (isset($_SESSION['userloginsomethingwrong']))
							   {
						 ?>
						 <div class="well">
								  <span class="text-danger"> 
								  <?php
									  echo $_SESSION['userloginsomethingwrong'];
									  unset($_SESSION['userloginsomethingwrong']);
									 ?>
								 </span> 
								
						 </div>
						  <?php
							   }
						  ?>
						  
						  <?php
							  if (isset($_SESSION['fromuserchangepassword']))
							   {
						 ?>
						 <div class="well">
								  <span class="text-danger"> 
								  <?php
									  echo $_SESSION['usercpsomethingwrong'];
									  unset($_SESSION['fromuserchangepassword']);
									  unset($_SESSION['usercpsomethingwrong']);
									 ?>
								 </span> 
								
						 </div>
						  <?php
							   }
						  ?>
						  
						 
						
							<div class="form-group">
								<label for="useremail"> Email </label>
								<input type="email" class="form-control" name="useremail" value = "<?php echo $useremail;?>" id="useremail" placeholder="Enter Email" autofocus> 
								<span class="text-danger"> 
									<?php
										echo $useremailerror;
									?>
								</span>	
							</div>
							<div class="form-group">
								<label for="userpassword"> Password </label>
								<input type="password" class="form-control" name="userpassword" value = "<?php echo $userpassword;?>" id="userpassword" placeholder="Enter Password">
								<span class="text-danger"> 
									<?php
									   echo $userpassworderror;
									?>
							   </span>
							  </div>
							<input type="submit" class="btn btn-primary" style="margin-bottom:5px" value="Log In" name="userlogin">
							<!--<a class="btn btn-danger pull-right" data-toggle="tooltip" title="Did You Forgot Your Password? Click Here" href="forgotpassword.php" role="button"> Forgotten Password </a>-->
						</form>
						</div>
					<div class="panel-footer"> New User ? <a class="btn btn-info btn-lg" data-toggle="tooltip" title="Click Here to Register if you dont haven't Registered yet" href="userregister.php" role="button"> 
					 Register </a> 
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	
	
	
	









	
	<div id="aboutus" class="container-fluid collapse foot">
		<div class="container-fluid">
			<div class="row">
			<h2 style="font-style:italic"> Our Developers </h2>
				<div class="col-md-4">
						<img src="images/mukesh.jpg" class="img-circle img-responsive" style="max-width:30%" alt="Image"> <br/>
						<address>
							Er. Mukesh Bhandari     <br/>					
							Computer Engineering    <br/>				
							Kathmandu,Nepal			<br/> <br/>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#mukeshmodal"> More </button>
						    <div id="mukeshmodal" class="modal" role="dialog" style="background:rgba(0,0,0,0.9)">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<img src="images/mukesh.jpg" class="img-circle img-responsive modalphoto" style="max-width:20%" alt="Image"> <br/>
											<h3> Personal Contact </h3>
										</div>
										<div class="modal-body" >
											<table class="table">
											<tr>
												<td> Name </td>
												<td> Mukesh Bhandari</td>
											</tr>
											<tr>
												<td> Education </td>
												<td> Computer Engineering </td>
											</tr>
											<tr>
												<td> Permanent Address </td>
												<td> Kathmandu,Nepal </td>
											</tr>
											<tr>
												<td> Email </td>
												<td> bhandarimukesh40@gmail.com </td>
											</tr>
											<tr>
											<td> </td>
											<td> </td>
											</tr>
											</table>
											<h4> Follow Me @ </h4>
											<a target="_blank" href="https://www.twitter.com/tmukeshbhandari"> Twitter </a>
										</div>
										 <div class="modal-footer">
											  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										 </div>
									</div>
								</div>
							</div>
						</address>									
				</div>											
				<div class="col-md-4">								
					<img src="images/rupesh.jpg" class="img-circle img-responsive" style="max-width:30%" alt="Image"> <br/>
					<address>									
							Er. Rupesh Kumar Giree  <br/>
							Computer Engineering    <br/>
							Kavrepalanchwok,Nepal	<br/> <br/>	
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#rupeshmodal"> More </button>
						    <div id="rupeshmodal" class="modal" role="dialog" style="background:rgba(0,0,0,0.9)">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<img src="images/rupesh.jpg" class="img-circle img-responsive modalphoto" style="max-width:20%" alt="Image"> <br/>
											<h3> Personal Contact </h3>
										</div>
										<div class="modal-body" >
											<table class="table">
											<tr>
												<td> Name </td>
												<td> Rupesh Kumar Giree</td>
											</tr>
											<tr>
												<td> Education </td>
												<td> Computer Engineering </td>
											</tr>
											<tr>
												<td> Permanent Address </td>
												<td> Kavrepalanchwok,Nepal </td>
											</tr>
											<tr>
												<td> Email </td>
												<td> rupesh.giree@gmail.com </td>
											</tr>
											<tr>
											<td> </td>
											<td> </td>
											</tr>
											</table>
											<h4> Follow Me @ </h4>
											<a target="_blank" href="https://twitter.com/Rupesh_Giree"> Twitter </a>
										</div>
										 <div class="modal-footer">
											  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										 </div>
									</div>
								</div>
							</div>
					</address>										
				</div>										
				<div class="col-md-4">								
					<img src="images/jeevan.jpg" class="img-circle img-responsive" style="max-width:30%" alt="Image">
					<br/>
					<address>							
							Er. Jeevan KC 			<br/>
							Computer Engineering	<br/>
							Dang,Nepal				<br/> <br/>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#jeevanmodal"> More </button>
						    <div id="jeevanmodal" class="modal" role="dialog" style="background:rgba(0,0,0,0.9)">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<img src="images/jeevan.jpg" class="img-circle img-responsive  modalphoto" style="max-width:20%" alt="Image"> <br/>
											<h3> Personal Contact </h3>
										</div>
										<div class="modal-body" >
											<table class="table">
											<tr>
												<td> Name </td>
												<td> Jeevan KC</td>
											</tr>
											<tr>
												<td> Education </td>
												<td> Computer Engineering </td>
											</tr>
											<tr>
												<td> Permanent Address </td>
												<td> Dang,Nepal </td>
											</tr>
											<tr>
												<td> Email </td>
												<td> jkc51550@gmail.com </td>
											</tr>
											<tr>
											<td> </td>
											<td> </td>
											</tr>
											</table>
											<h4> Follow Me @ </h4>
											<a target="_blank" href="https://www.facebook.com/xivan.kc"> Facebook </a>
										</div>
										 <div class="modal-footer">
											  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										 </div>
									</div>
								</div>
							</div>
					</address>
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
</div>
</body>
</html>
