<?php
function checksetexamexistindb()
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
		$sql = "CREATE TABLE IF NOT EXISTS setexam(
		`SN` int UNSIGNED NOT NULL auto_increment,
		`Subject_Name` varchar(50) NOT NULL,
		`Subject_Code` varchar(12) NOT NULL,
		`Number_of_Hour` int NOT NULL,
		`Date_of_Exam` date NOT NULL,
		`Time_of_Exam` time NOT NULL,
		`Full_Marks` int NOT NULL,
		`Pass_Marks` int NOT NULL,
		`Flag` tinyint(1) NOT NULL,
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