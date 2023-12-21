<?php
session_start();
if (isset($_COOKIE['ualreadylogin']))
{
	if ((isset($_SESSION["fromuhome"])))
	{
		unset($_SESSION["fromuhome"]);
		/*setcookie("ualreadylogin","10",time()-1,"/");  since cookie is expired so it is deleted */
		setcookie("ualreadylogin","",time()- 3600);
		//setting a cookie with no value is the same as deleting it. 
		header("Location: userlogin.php");
	}
	else
	{
		header("Location: home.php");
	}
}
else
{
	header("Location: userlogin.php");
}
?>
