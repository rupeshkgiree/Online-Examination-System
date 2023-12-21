<?php
function checkresultexistindb()
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
		$sql = "CREATE TABLE IF NOT EXISTS result(
										`SN` int UNSIGNED NOT NULL auto_increment,
										`First_Name` varchar(25) NOT NULL,
										`Last_Name` varchar(25) NOT NULL,
										`Email` varchar(40) NOT NULL,
										`College_ID` varchar(15) NOT NULL,
										`Exam_Date` date NOT NULL,
										`Subject_Name` varchar(50) NOT NULL,
										`Pass_Fail` varchar(4),
										`Position` int UNSIGNED,
										`Full_Marks_of_Subject` int UNSIGNED,
										`Pass_Marks` int UNSIGNED,
										`Total_Marks_Obtained` int UNSIGNED,
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