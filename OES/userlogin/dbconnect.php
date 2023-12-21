<?php
function dbconnseparate()
{
		try{
			$servername = "localhost";
			$username = "root";
			$password = "mukeshbhandarii1*";
			$dbname = "online_exam";
			$dbconn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
			$dbconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $dbconn;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
}
?>