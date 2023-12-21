<?php
function checkadmininfoexistindb()
{
	try
	{
		$servername = "localhost";
		$username = "root";
		$password = "mukeshbhandarii1*";
	    $dbname = "online_exam"; 
		$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
		// set the PDO error mode to exception
	
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE IF NOT EXISTS admininfo(
		`SN` int UNSIGNED NOT NULL auto_increment,
		`College_Name` varchar(40) NOT NULL,
		`Email` varchar(40) NOT NULL,
		`Password` varchar(100) NOT NULL,
		`Country` varchar(30) NOT NULL,
		`Street_Address` varchar(40) NOT NULL,
		`College_ID` varchar(15) NOT NULL,
		`Registration_Date` datetime NOT NULL,
		`Last_Password_Update` datetime,
		`Flag` tinyint(1) NOT NULL,
		 PRIMARY KEY(SN,Email)
		)";
		$conn->exec($sql);
	}
	catch(PDOException $e)
	{
		echo $sql . "<br/>". $e->getMessage();
	}
}
?>