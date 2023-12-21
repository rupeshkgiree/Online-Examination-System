<?php
function acreatetableindbforquestions()
{
	try
	{
		$asubjectforquestion = $_SESSION['ssuborquestionn'];
		$aquestionnn = $_SESSION['aquestionn'];
		$optiononeee = $_SESSION['optiononee'];
		$optiontwooo = $_SESSION['optiontwoo'];
		$optionthreeee = $_SESSION['optionthreee'];
		$optionfourrr = $_SESSION['optionfourr'];
		$correctanswerrr = $_SESSION['correctanswerr'];
		$questionmarksss = $_SESSION['questionmarkss'];
		 $collegeidofacuadmin = $_SESSION['collegeidofacuadmin'];
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
		$sql = "INSERT INTO question (Subject_Code,Questions,Option_1,Option_2,Option_3,Option_4,Correct_Answer,Question_Marks,College_ID)
		VALUES ('$asubjectforquestion','$aquestionnn','$optiononeee','$optiontwooo','$optionthreeee','$optionfourrr','$correctanswerrr','$questionmarksss','$collegeidofacuadmin')";
		$conn->exec($sql);
		
		
	}
	catch(PDOException $e)
	{
		echo $sql . "<br/>". $e->getMessage();
	}
}	
?>