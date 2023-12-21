<?php
function ucreatetableindb()
{
	try
	{
		$userregisterfirstname			=	$_SESSION['userregisterfirstnamee'];
		$userregisterlastname			=	$_SESSION['userregisterlastnamee'];
		$userregisteremail				=	$_SESSION['userregisteremaill'];
		$userregisterpwddd				=	$_SESSION['userregisterpwdd'];
		$userregisterpwd				=   password_hash($userregisterpwddd,PASSWORD_BCRYPT);
		$userregistercountry			=	$_SESSION['userregistercountryy'];
		$userregistersaddress			=	$_SESSION['userregistersaddresss'];
		//$userregistermobile				=	$_SESSION['userregistermobilee'];
		$userregistercollegeid			=	$_SESSION['userregistercollegeidd'];
		$userregistersymbol				=	$_SESSION['userregistersymboll'];
		//$userregisterverification 		= 	$_SESSION['userregisterverificationn'];
		
		
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
		$sql = "CREATE TABLE IF NOT EXISTS userinfo(
		`SN` int UNSIGNED NOT NULL auto_increment,
		`First_Name` varchar(25) NOT NULL,
		`Last_Name` varchar(25) NOT NULL,
		`Email` varchar(40) NOT NULL,
		`Password` varchar(20) NOT NULL,
		`Country` varchar(30) NOT NULL,
		`Street_Address` varchar(40) NOT NULL,
		`College_ID` varchar(15) NOT NULL,
		`Symbol` varchar(15) NOT NULL,
		`Registration_Date` datetime NOT NULL,
		`Last_Password_Update` datetime,
		`Flag` tinyint(1) NOT NULL,
		 PRIMARY KEY(SN,Email)
		)";
		$conn->exec($sql);
		//date_default_timezone_set('Asia/Kathmandu'); //date function le server ko date & time dincha, yo function le kathmandu ko dincha
		$todaydate = date("Y-m-d H:i:s");
		$flagfor   = 1;
		$sql = "INSERT INTO userinfo (First_Name,Last_Name,Email,Password,Country,Street_Address,College_ID,Symbol,Registration_Date,Last_Password_Update, Flag)
		VALUES ('$userregisterfirstname','$userregisterlastname','$userregisteremail','$userregisterpwd','$userregistercountry','$userregistersaddress','$userregistercollegeid','$userregistersymbol','$todaydate','$todaydate','$flagfor')";
		$conn->exec($sql);
		
		
	}
	catch(PDOException $e)
	{
		echo $sql . "<br/>". $e->getMessage();
	}
}
?>