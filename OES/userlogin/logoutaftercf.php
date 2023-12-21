<?php
session_start();

if (isset($_COOKIE['ualreadylogin']))
{
	if ((isset($_SESSION["fromacf"])))
	{
		if (($_COOKIE['ualreadylogin']) == ($_SESSION["emaildeactreact"]))
		{
				unset($_SESSION["fromacf"]);
				unset($_SESSION["emaildeactreact"]);
				/*setcookie("ualreadylogin","10",time()-1,"/");  since cookie is expired so it is deleted */
				setcookie("ualreadylogin","",time()- 3600);
				//setting a cookie with no value is the same as deleting it. 
				$_SESSION['errorontopofactivateordeactivate'] = true;
				header("Location: ../adminlogin/viewusers.php");
		}
		else
		{
			$_SESSION['errorontopofactivateordeactivate'] = true;
			header("Location: ../adminlogin/viewusers.php");
		}
	}
	else
	{
		header("Location: ../adminlogin/adminlogin.php");
	}
}
else
{
	$_SESSION['errorontopofactivateordeactivate'] = true;
	header("Location: ../adminlogin/viewusers.php");
}
?>