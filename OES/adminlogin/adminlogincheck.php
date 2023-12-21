<?php
session_start();
if (!$_SESSION['adminloginpreviouss'])
{
	header("Location: adminlogin.php");
}
else
{
	unset($_SESSION['adminloginpreviouss']);
	checkcorrectnessindb();
}
function checkcorrectnessindb()
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
			
			$echeck = $conn->prepare("SELECT Email,Flag FROM admininfo WHERE Email = :email");	
			$echeck->bindParam(':email',$email,PDO::PARAM_STR);
			$echeck->execute();
			$resemail 	= $echeck->fetch(PDO::FETCH_ASSOC);
			
			
			$password = $_SESSION['adminloginpasswordd'];
			$pcheck = $conn->prepare("SELECT Password FROM admininfo WHERE Email = :email");
			$pcheck->bindParam(':email',$email,PDO::PARAM_STR);
			$pcheck->execute();
			$respassword 	= $pcheck->fetch(PDO::FETCH_ASSOC);
			if (($resemail['Flag']) == 0)
			{
				
				//($password == $respassword["Password"])
				
				if (($email == $resemail["Email"]) && (password_verify($password,$respassword["Password"])))
				{
				   $_SESSION['adminloginsomethingwrong'] = "Your Account Has Been Disabled By Owner. Contact Owner of the website.";
				   header('Location: adminlogin.php');
					
				}
				else
				{
				   $_SESSION['adminloginsomethingwrong'] = "Wrong Email or Password";
				   $_SESSION['fromadminlogincheckforwronglogincount'] = true;
				   $_SESSION['noofwrongloginu'] = $_SESSION['noofwrongloginu'] + 1;
					header('Location: adminlogin.php');
				}
			}
		   if (($resemail['Flag']) == 1)
			{
				if (($email == $resemail["Email"]) && (password_verify($password,$respassword["Password"])))
				{
				   setcookie("aalreadylogin",$email,time() + (10*365*24*60*60)); /*set cookie for adminemail with expiry date of 10 year or until browsers history is cleared.*/
				   $_SESSION['adminloginfromcheck'] = true;
				   header("Location: home.php");
					
				}
				else
				{
				   $_SESSION['adminloginsomethingwrong'] = "Wrong Email or Password";
					$_SESSION['fromadminlogincheckforwronglogincount'] = true;
				   $_SESSION['noofwronglogina'] = $_SESSION['noofwronglogina'] + 1;
				   header('Location: adminlogin.php');
				}
			}
			
	}
	
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

?>