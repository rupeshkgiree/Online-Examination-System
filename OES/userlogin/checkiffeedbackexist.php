<?php
function checkfeedbackexistindb()
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
		$sql = "CREATE TABLE IF NOT EXISTS feedback(
		`SN` int UNSIGNED NOT NULL auto_increment,
		`Email` varchar(40) NOT NULL,
		`Topic` varchar(40) NOT NULL,
		`Description` text NOT NULL,
		`Feedback_Date` datetime NOT NULL,
		 PRIMARY KEY(SN)
		)";
		$conn->exec($sql);
	}
	catch(PDOException $e)
	{
		echo $sql . "<br/>". $e->getMessage();
	}
}
?>