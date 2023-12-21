<?php
session_start();

if (isset($_COOKIE['aalreadylogin']))
{
	if ((isset($_SESSION["fromsuperadmincf"])))
	{
		if (($_COOKIE['aalreadylogin']) == ($_SESSION["emaildeactreact"]))
		{
				unset($_SESSION["fromsuperadmincf"]);
				unset($_SESSION["emaildeactreact"]);
				/*setcookie("ualreadylogin","10",time()-1,"/");  since cookie is expired so it is deleted */
				setcookie("aalreadylogin","",time()- 3600);
				//setting a cookie with no value is the same as deleting it. 
				$_SESSION['errorontopofactivateordeactivate'] = true;
				header("Location: ../superadmin.php");
		}
		else
		{
			$_SESSION['errorontopofactivateordeactivate'] = true;
			header("Location: ../superadmin.php");
		}
	}
	else
	{
		header("Location: index.php");
	}
}
else
{
	$_SESSION['errorontopofactivateordeactivate'] = true;
	if ((isset($_SESSION["fromsuperadmincf"])))
	{
	header("Location: ../superadmin.php");
	}
	else
	{
		header("Location: index.php");
	}
}
?>