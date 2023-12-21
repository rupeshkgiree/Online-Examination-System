<?php
function checkquestionexistindb()
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
		$sql = "CREATE TABLE IF NOT EXISTS question(
		`SN` int UNSIGNED NOT NULL auto_increment,
		`Subject_Code` varchar(12) NOT NULL,
		`Questions` text NOT NULL,
		`Option_1` varchar(40) NOT NULL,
		`Option_2` varchar(40) NOT NULL,
		`Option_3` varchar(40) NOT NULL,
		`Option_4` varchar(40) NOT NULL,
		`Correct_Answer` varchar(40) NOT NULL,
		`Question_Marks` tinyint NOT NULL,
		`College_ID` varchar(15) NOT NULL,
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