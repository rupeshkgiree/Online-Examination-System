<?php
function acreatetableindbforfeedback()
{
	try
	{
		$afeedbackemailll = $_SESSION['afeedbackemail'];
		$afeedbacktopiccc = $_SESSION['afeedbacktopic'];
		$afeedbackdescribeee = $_SESSION['afeedbackdescribe'];
		
		
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
		//date_default_timezone_set('Asia/Kathmandu'); //date function le server ko date & time dincha, yo function le kathmandu ko dincha
		$todaydatefeedback = date("Y-m-d H:i:s");
		$sql = "INSERT INTO feedback (Email,Topic,Description,Feedback_Date)
		VALUES ('$afeedbackemailll','$afeedbacktopiccc','$afeedbackdescribeee','$todaydatefeedback')";
		$conn->exec($sql);
		
		
	}
	catch(PDOException $e)
	{
		echo $sql . "<br/>". $e->getMessage();
	}
}	
?>