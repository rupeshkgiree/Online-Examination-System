<?php
session_start();
if (!$_SESSION['userloginpreviouss'])
{
	header("Location: userlogin.php");
}
else
{
	unset($_SESSION['userloginpreviouss']);
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
			$email = $_SESSION['userloginemaill'];
			
			
			$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			
			$echeck = $conn->prepare("SELECT Email,Flag FROM userinfo WHERE Email = :email");	
			$echeck->bindParam(':email',$email,PDO::PARAM_STR);
			$echeck->execute();
			$resemail 	= $echeck->fetch(PDO::FETCH_ASSOC);
			
			
			$password = $_SESSION['userloginpasswordd'];
			$pcheck = $conn->prepare("SELECT Password FROM userinfo WHERE Email = :email");
			$pcheck->bindParam(':email',$email,PDO::PARAM_STR);
			$pcheck->execute();
			$respassword 	= $pcheck->fetch(PDO::FETCH_ASSOC);
			if (($resemail['Flag']) == 0)
			{
				//($password == $respassword["Password"])
				if (($email == $resemail["Email"]) && (password_verify($password,$respassword["Password"])))
				{
				   $_SESSION['userloginsomethingwrong'] = "Your Account Has Been Disabled By Admin. Contact Your Admin.";
				   header('Location: userlogin.php');
					
				}
				else
				{
				   $_SESSION['userloginsomethingwrong'] = "Wrong Email or Password";
				   $_SESSION['fromuserlogincheckforwronglogincount'] = true;
				   $_SESSION['noofwrongloginu'] = $_SESSION['noofwrongloginu'] + 1;
					header('Location: userlogin.php');
				}
			}
			if (($resemail['Flag']) == 1)
			{
				if (($email == $resemail["Email"]) && (password_verify($password,$respassword["Password"])))
				{
				   setcookie("ualreadylogin",$email,time() + (10*365*24*60*60)); /*set cookie for useremail with expiry date of 10 year or until browsers history is cleared.*/
				   $_SESSION['userloginfromcheck'] = true;
				   header("Location: home.php");
					
				}
				else
				{
				   $_SESSION['userloginsomethingwrong'] = "Wrong Email or Password";
				   $_SESSION['fromuserlogincheckforwronglogincount'] = true;
				   $_SESSION['noofwrongloginu'] = $_SESSION['noofwrongloginu'] + 1;
					header('Location: userlogin.php');
				}
			}
		   
			
	}
	
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

?>