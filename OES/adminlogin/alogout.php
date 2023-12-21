<?php
session_start();
if (isset($_COOKIE['aalreadylogin']))
{
	if ((isset($_SESSION["fromahome"])))
	{
		unset($_SESSION["fromahome"]);
		/*setcookie("aalreadylogin","10",time()-1,"/");  since cookie is expired so it is deleted */
		setcookie("aalreadylogin","",time()- 3600);
		//setting a cookie with no value is the same as deleting it. 
		header("Location: adminlogin.php");
	}
	else
	{
		header("Location: home.php");
	}
}
else
{
	header("Location: adminlogin.php");
}
?>