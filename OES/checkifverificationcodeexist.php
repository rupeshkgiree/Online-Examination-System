<?php
function createverificationcodetableindb()
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
?>