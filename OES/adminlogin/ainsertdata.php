<?php
function acreatetableindb()
{
	try
	{
		$adminregistercollegename		=	$_SESSION['adminregistercollegenamee'];
		$adminregisteremail				=	$_SESSION['adminregisteremaill'];
		$adminregisterpwddd				=	$_SESSION['adminregisterpwdd'];
		$adminregisterpwd				=   password_hash($adminregisterpwddd,PASSWORD_BCRYPT);
		$adminregistercountry			=	$_SESSION['adminregistercountryy'];
		$adminregistersaddress			=	$_SESSION['adminregistersaddresss'];
		//$adminregisterphone				=	$_SESSION['adminregisterphonee'];
		$adminregistercollegeid			=	$_SESSION['adminregistercollegeidd'];
		//$adminregisterverification 	= 	$_SESSION['adminregisterverificationn'];
		
		
		$servername = "localhost";
		$username = "root";
		$password = "mukeshbhandarii1*";
	    $dbname = "online_exam"; 
		$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
		// set the PDO error mode to exception
	
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		//return $conn;
		//sql to create tablecreateindb
		/* column_name data_type[size] [NOt NULL|NULL] [DEFAULT value] [AUTO_INCREMENT] */
		$sql = "CREATE TABLE IF NOT EXISTS admininfo(
		`SN` int UNSIGNED NOT NULL auto_increment,
		`College_Name` varchar(40) NOT NULL,
		`Email` varchar(40) NOT NULL,
		`Password` varchar(20) NOT NULL,
		`Country` varchar(30) NOT NULL,
		`Street_Address` varchar(40) NOT NULL,
		`College_ID` varchar(15) NOT NULL,
		`Registration_Date` datetime NOT NULL,
		`Last_Password_Update` datetime,
		`Flag` tinyint(1) NOT NULL,
		 PRIMARY KEY(SN,Email)
		)";
		$conn->exec($sql);
		//date_default_timezone_set('Asia/Kathmandu'); //date function le server ko date & time dincha, yo function le kathmandu ko dincha
		$todaydate = date("Y-m-d H:i:s");
		$flagforr   = 1;
		$sql = "INSERT INTO admininfo (College_Name,Email,Password,Country,Street_Address,College_ID,Registration_Date,Last_Password_Update,Flag)
		VALUES ('$adminregistercollegename','$adminregisteremail','$adminregisterpwd','$adminregistercountry','$adminregistersaddress','$adminregistercollegeid','$todaydate','$todaydate','$flagforr')";
		$conn->exec($sql);
		
		
	}
	catch(PDOException $e)
	{
		echo $sql . "<br/>". $e->getMessage();
	}
}