<?php
session_start();
include_once 'checkifuserinfoexist.php';
include_once 'checkifadmininfoexist.php';

checkuserinfoexistindb();
checkadmininfoexistindb();
if (isset($_COOKIE['ualreadylogin']))
		{
			header("Location: home.php");
		}
$userregisterfromprevious   = true;
$userregisterfirstname="";
$userregisterlastname="";
$userregisteremail="";
$userregisterpwd="";
$userregisterrepwd="";
$userregistercountry="";
$userregistersaddress="";
//$userregistermobile="";
$userregistersymbol="";
//$userregisterverification="";
$error = 0;


$userregisterfirstnameerror="";
$userregisterlastnameerror="";
$userregisteremailerror="";
$userregisterpwderror="";
$userregisterrepwderror="";
//$userregistercountryerror="";
$userregistersaddresserror="";
//$userregistermobileerror="";
$userregistersymbolerror="";
//$userregisterverificationerror="";
$userregistercollegeiderror = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	/*if ((empty($_POST['userregisterfirstname']))||(empty($_POST['userregisterlastname']))||(empty($_POST['userregisteremail']))||(empty($_POST['userregisterpwd']))||(empty($_POST['userregisterrepwd'])) ||(empty($_POST['userregistersaddress']))||(empty($_POST['userregistermobile']))||(empty($_POST['userregistersymbol']))||(empty($_POST['userregisterverification'])) || ($_POST['userregisterpwd'] != $_POST['userregisterrepwd'])|| (!ctype_alpha($_POST['userregisterfirstname']))||(!ctype_alpha($_POST['userregisterlastname']))|| (strlen($_POST['userregisterpwd'])<8) || (strlen($_POST['userregisterrepwd'])<8))
	{*/
		
			if (empty($_POST['userregisterfirstname']))
			{
				$userregisterfirstnameerror = "First Name is Required";
				$error = 1;
			}
			if ((!empty($_POST['userregisterfirstname'])) && (!ctype_alpha($_POST['userregisterfirstname'])))
			{
				$userregisterfirstname = $_POST['userregisterfirstname'];
				$userregisterfirstnameerror = "First Name contains invalid character or there is a white space at the end.";
				$error = 1;
			}
			if ((!empty($_POST['userregisterfirstname']))&&ctype_alpha($_POST['userregisterfirstname']))
			{
				$userregisterfirstname = $_POST['userregisterfirstname'];
			}
			
			if (empty($_POST['userregisterlastname']))
			{
				$error = 1;
				$userregisterlastnameerror = "Last Name is Required";
			}
			if ((!empty($_POST['userregisterlastname'])) && (!ctype_alpha($_POST['userregisterlastname'])))
			{
				$error = 1;
				$userregisterlastname = $_POST['userregisterlastname'];
				$userregisterlastnameerror="Last Name contains invalid character or there is a white space at the end.";
			}
			if ((!empty($_POST['userregisterlastname']))&&ctype_alpha($_POST['userregisterlastname']))
			{
				$userregisterlastname = $_POST['userregisterlastname'];
			}
			
			if (empty($_POST['userregisteremail']))
			{
				$error = 1;
				$userregisteremailerror = "Email is Required";
			}
			else
			{
				$userregisteremail = $_POST['userregisteremail'];
			}
			
			if ((empty($_POST['userregisterpwd'])) || (empty($_POST['userregisterrepwd'])))
			{
				$error = 1;
			
					if (empty($_POST['userregisterpwd']))
					{
						$userregisterpwderror = "Password is Required";
					}
					else
					{
						$userregisterpwd = $_POST['userregisterpwd'];
					}
					
					if (empty($_POST['userregisterrepwd']))
					{
						$userregisterrepwderror = "Re-Entering of Password is Required";
					}
					else
					{
						$userregisterrepwd = $_POST['userregisterrepwd'];
					}
			}
	
			else
			{
					$userregisterpwd = $_POST['userregisterpwd'];
					$userregisterrepwd = $_POST['userregisterrepwd'];
					if (($_POST['userregisterpwd']) != ($_POST['userregisterrepwd']))
					{
						$error = 1;
						$userregisterrepwderror = "Password do not Match.";
					}
					else
					{
						if (strlen($_POST['userregisterpwd'])<8 || strlen($_POST['userregisterrepwd'])<8 )
						{
							$error = 1;
							$userregisterrepwderror = "Password must be atleast 8 character long";
						}
						
					}
				
			}
			
		
			/*if (empty($_POST['userregistercountry']))
			{
				$error = 1;
				$userregistercountryerror = "Country is Required";
			}
			if ((!empty($_POST['userregistercountry'])) && (!ctype_alpha($_POST['userregistercountry'])))
			{
				$error = 1;
				$userregistercountry = $_POST['userregistercountry'];
				$userregistercountryerror = "Invalid Country";
			}
			if ((!empty($_POST['userregistercountry']))&&ctype_alpha($_POST['userregistercountry']))
			{
				$userregistercountry = $_POST['userregistercountry'];
			}*/
			
			if (empty($_POST['userregistersaddress']))
			{
				$error = 1;
				$userregistersaddresserror = "Street Address is Required";
			}
			else
			{
				$userregistersaddress = $_POST['userregistersaddress'];
			}
			
			/*if (empty($_POST['userregistermobile']))
			{
				$error = 1;
				$userregistermobileerror = "Mobile Number is Required";
			}
			else
			{
				$userregistermobile = $_POST['userregistermobile'];
			}*/
			if (empty($_POST['userregistercollegeid']))
			{
				$error = 1;
				$userregistercollegeiderror = "College ID is Required";
			}
			else
			{
				
				function checkcollegeidexistinadmininfo()
				{
						try
								{
									$servername = "localhost";
									$username = "root";
									$password = "mukeshbhandarii1*";
									$dbname = "online_exam"; 
									$conn = new PDO("mysql:host =$servername;dbname=$dbname",$username,$password);
									$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
									$subnesubc=$conn->prepare("Select College_ID from admininfo where College_ID = :colid");
									$subnesubc->bindParam(':colid',$_POST['userregistercollegeid'],PDO::PARAM_STR);
									$subnesubc->execute();
									$ans 	= $subnesubc->fetchColumn();
									return $ans;
								}
						catch (PDOException $e)
								{
									echo $sql . "<br/>". $e->getMessage();
								}
				}
			
				$ans = checkcollegeidexistinadmininfo();
				if ($ans == $_POST['userregistercollegeid'])
				{
					$userregistercollegeid = $_POST['userregistercollegeid'];
				}
				else
				{
					$userregistercollegeiderror = "No College/School/Institute has Registered the site with this College ID ";
				}
			}
			
			if (empty($_POST['userregistersymbol']))
			{
				$error = 1;
				$userregistersymbolerror = "Symbol Number is Required";
			}
			else
			{
				$userregistersymbol = $_POST['userregistersymbol'];
			}
			
			/*if (empty($_POST['userregisterverification']))
			{
				$error = 1;
				$userregisterverificationerror = "Verification Code is Required";
			}
			else
			{
				$userregisterverification = $_POST['userregisterverification'];
			}*/
	//}

	//if (!$error)
	
			//else
		//{
			
			
				$userregisterfirstname		= $_POST['userregisterfirstname'];
				$userregisterlastname		= $_POST['userregisterlastname'];
				$userregisteremail			= $_POST['userregisteremail'];
				$userregisterpwd			= $_POST['userregisterpwd'];
				$userregistercountry		= $_POST['userregistercountry'];
				$userregistersaddress		= $_POST['userregistersaddress'];
				//$userregistermobile			= $_POST['userregistermobile'];
				$userregistercollegeid		= $_POST['userregistercollegeid'];
				$userregistersymbol			= $_POST['userregistersymbol'];
				//$userregisterverification	= $_POST['$userregisterverification'];
				//$error = 0;
				
				
				$_SESSION['userregisterfirstnamee'] 	= $userregisterfirstname;
				$_SESSION['userregisterlastnamee'] 		= $userregisterlastname;
				$_SESSION['userregisteremaill'] 		= $userregisteremail;
				$_SESSION['userregisterpwdd'] 			= $userregisterpwd;
				$_SESSION['userregistercountryy']		= $userregistercountry;
				$_SESSION['userregistersaddresss']		= $userregistersaddress;
				//$_SESSION['userregistermobilee'] 		= $userregistermobile;
				$_SESSION['userregistercollegeidd']		= $userregistercollegeid;
				$_SESSION['userregistersymboll'] 		= $userregistersymbol;
				//$_SESSION['userregisterverificationn'] 	= $userregisterverification;
				$_SESSION['userregisterfrompreviouss'] 	= $userregisterfromprevious;
			
			
				function dbconnect()
				{
					try
					{
						$servername = "localhost";
						$username = "root";
						$password = "mukeshbhandarii1*";
						$dbname = "online_exam";
						$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
						$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						return $conn;
					}
					catch(PDOException $e)
					{
						echo $e->getMessage();
					}
				}
				
			function existensechec($conn,$data,$forsche,$forbp)
				{
					$existensecheck = $conn->prepare($forsche);	
					$existensecheck->bindParam($forbp,$data,PDO::PARAM_STR);
					$existensecheck->execute();
					$reg 	= $existensecheck->fetch(PDO::FETCH_ASSOC);
					return $reg;
				}
				
			
			
		 $chec = dbconnect();
			 $forsche = "SELECT Email FROM userinfo WHERE Email = :email UNION SELECT Email FROM admininfo WHERE Email = :email";
			 $forbp = ':email';
			 $emailexistencecheck = existensechec($chec,$_POST['userregisteremail'],$forsche,$forbp);
				if ($emailexistencecheck['Email'])
						{
							$userregisteremailerror = "Email Already Exists";
							$error = 1;
						}
						
						
	
			/*$forsche = "SELECT Mobile_Number FROM userinfo WHERE Mobile_Number = :mobilenumber";
			 $forbp = ':mobilenumber';
			 $mobileexistencecheck = existensechec($chec,$_POST['userregistermobile'],$forsche,$forbp);
				if ($mobileexistencecheck['Mobile_Number'])
						{ 
							$userregistermobileerror = "Mobile Number Already Exists";
							$error = 1;
						}*/
						
			$forsche = "SELECT Symbol FROM userinfo WHERE Symbol = :symbol";
			 $forbp = 'symbol';
			 $symbolexistencecheck = existensechec($chec,$_POST['userregistersymbol'],$forsche,$forbp);
				if ($symbolexistencecheck['Symbol'])
						{
							$userregistersymbolerror = "Symbol Already Exists";
							$error = 1;
						}
						

				if (!$error)
				{
					$userregisterfromprevious   = true;
					header("Location: userregistrationcheck.php");
				}

		//}
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> User Registration</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js.bootstrap.min.js"> </script>
<script src="jquery.min.css"> </script>
</head>
<style>
.jumbotron      {
						 margin-top:2px;
						 margin-bottom:5px;
						 padding-top:10px;
						 background:#50d07d;
				}
.jumbotron p	{
						 line-height:20px;
						 color:#651287;
				}
.main {
	margin-bottom:10px;
}
</style>
<body>
<div class="container-fluid main" style="background:#C0C0C0">
<div class="jumbotron text-center">
		 <h1>  <span class="glyphicon glyphicon-education">Online Examination System  <span class="glyphicon glyphicon-education"> </h1>
		<p> Give Online Exams For Any Subjects </p>
		<p> Improve Your Skills </p>
	</div>
<div class="container">
	<div class="row">
	<div class="col-md-3"> <a class="btn btn-info btn-block" href="../index.php" role="button"> Main Page </a> <br/> </div>
		<div class="col-md-6">
			<div class="panel panel-primary">
			<div class="panel-heading"> New User Registration
			</div>
			<div class="panel-body">
			<p style="color:red"> Warning : Except Password, Once added information cannot be edited later. So, Be careful while adding details </p>
		<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="userregistrationform" method="POST">
		
			<div class="form-group">
			<label for="userregisterfirstname"> First Name </label> <input type="text" maxlength="25" placeholder="Enter First Name" class="form-control" value = "<?php echo $userregisterfirstname;?>" name="userregisterfirstname" id="userregisterfirstname"  autofocus>
			<span class="text-danger"> 
						<?php
							echo $userregisterfirstnameerror;
						?>
			</span>	
			</div>
			
			<div class="form-group">
			<label for="userregisterlastname"> Last Name</label> <input type="text" maxlength="25" placeholder="Enter Last Name" class="form-control" value = "<?php echo $userregisterlastname;?>" name="userregisterlastname" id="userregisterlastname">
			<span class="text-danger"> 
						<?php
							echo $userregisterlastnameerror;
						?>
			</span>	
			</div>
			
			<div class="form-group">
			<label for="userregisteremail"> Email </label> <input type="email"  maxlength="40" placeholder="Enter Email" class="form-control" value = "<?php echo $userregisteremail;?>" name="userregisteremail" id="userregisteremail">
			<span class="text-danger"> 
						<?php
							echo $userregisteremailerror;
						?>
			</span>	
			</div>
			
			<div class="form-group">
			<label for="userregisterpwd"> Password</label> <input type="password" maxlength="20" class="form-control" placeholder="Enter Password" value = "<?php echo $userregisterpwd;?>" name="userregisterpwd" id="userregisterpwd">
			<span class="text-danger"> 
						<?php
							echo $userregisterpwderror;
						?>
			</span>	
			</div>
			
			<div class="form-group">
			<label for="userregisterrepwd"> Re-Enter Password </label> <input type="password" maxlength="20" class="form-control" placeholder="Re-enter Password" value = "<?php echo $userregisterrepwd;?>" name="userregisterrepwd" id="userregisterrepwd">
			<span class="text-danger"> 
						<?php
							echo $userregisterrepwderror;
						?>
			</span>	
			</div>
			
			<div class="form-group">
			<label for="userregistercountry"> Country </label> <br/>
			<select id="userregistercountry" class="form-control"  name="userregistercountry">
  <option value="AF"
                            
                            >
  Afghanistan 
  </option>
  <option value="AX"
                            
                            >
  Åland Islands 
  </option>
  <option value="AL"
                            
                            >
  Albania 
  </option>
  <option value="DZ"
                            
                            >
  Algeria
  </option>
  <option value="AS"
                            
                            >
  American Samoa
  </option>
  <option value="AD"
                            
                            >
  Andorra
  </option>
  <option value="AO"
                            
                            >
  Angola
  </option>
  <option value="AI"
                            
                            >
  Anguilla
  </option>
  <option value="AQ"
                            
                            >
  Antarctica
  </option>
  <option value="AG"
                            
                            >
  Antigua &amp; Barbuda
  </option>
  <option value="AR"
                            
                            >
  Argentina
  </option>
  <option value="AM"
                            
                            >
  Armenia 
  </option>
  <option value="AW"
                            
                            >
  Aruba
  </option>
  <option value="AC"
                            
                            >
  Ascension Island
  </option>
  <option value="AU"
                            
                            >
  Australia
  </option>
  <option value="AT"
                            
                            >
  Austria 
  </option>
  <option value="AZ"
                            
                            >
  Azerbaijan 
  </option>
  <option value="BS"
                            
                            >
  Bahamas
  </option>
  <option value="BH"
                            
                            >
  Bahrain 
  </option>
  <option value="BD"
                            
                            >
  Bangladesh 
  </option>
  <option value="BB"
                            
                            >
  Barbados
  </option>
  <option value="BY"
                            
                            >
  Belarus 
  </option>
  <option value="BE"
                            
                            >
  Belgium
  </option>
  <option value="BZ"
                            
                            >
  Belize
  </option>
  <option value="BJ"
                            
                            >
  Benin 
  </option>
  <option value="BM"
                            
                            >
  Bermuda
  </option>
  <option value="BT"
                            
                            >
  Bhutan 
  </option>
  <option value="BO"
                            
                            >
  Bolivia
  </option>
  <option value="BA"
                            
                            >
  Bosnia &amp; Herzegovina 
  </option>
  <option value="BW"
                            
                            >
  Botswana
  </option>
  <option value="BV"
                            
                            >
  Bouvet Island
  </option>
  <option value="BR"
                            
                            >
  Brazil 
  </option>
  <option value="IO"
                            
                            >
  British Indian Ocean Territory
  </option>
  <option value="VG"
                            
                            >
  British Virgin Islands
  </option>
  <option value="BN"
                            
                            >
  Brunei
  </option>
  <option value="BG"
                            
                            >
  Bulgaria 
  </option>
  <option value="BF"
                            
                            >
  Burkina Faso
  </option>
  <option value="BI"
                            
                            >
  Burundi 
  </option>
  <option value="KH"
                            
                            >
  Cambodia 
  </option>
  <option value="CM"
                            
                            >
  Cameroon 
  </option>
  <option value="CA"
                            
                            >
  Canada
  </option>
  <option value="IC"
                            
                            >
  Canary Islands 
  </option>
  <option value="CV"
                            
                            >
  Cape Verde 
  </option>
  <option value="BQ"
                            
                            >
  Caribbean Netherlands
  </option>
  <option value="KY"
                            
                            >
  Cayman Islands
  </option>
  <option value="CF"
                            
                            >
  Central African Republic 
  </option>
  <option value="EA"
                            
                            >
  Ceuta &amp; Melilla 
  </option>
  <option value="TD"
                            
                            >
  Chad
  </option>
  <option value="CL"
                            
                            >
  Chile
  </option>
  <option value="CN"
                            
                            >
  China 
  </option>
  <option value="CX"
                            
                            >
  Christmas Island
  </option>
  <option value="CP"
                            
                            >
  Clipperton Island
  </option>
  <option value="CC"
                            
                            >
  Cocos  Islands 
  </option>
  <option value="CO"
                            
                            >
  Colombia
  </option>
  <option value="KM"
                            
                            >
  Comoros 
  </option>
  <option value="CG"
                            
                            >
  Congo - Brazzaville 
  </option>
  <option value="CD"
                            
                            >
  Congo - Kinshasa 
  </option>
  <option value="CK"
                            
                            >
  Cook Islands
  </option>
  <option value="CR"
                            
                            >
  Costa Rica
  </option>
  <option value="CI"
                            
                            >
  Côte d’Ivoire
  </option>
  <option value="HR"
                            
                            >
  Croatia 
  </option>
  <option value="CU"
                            
                            >
  Cuba
  </option>
  <option value="CW"
                            
                            >
  Curaçao
  </option>
  <option value="CY"
                            
                            >
  Cyprus 
  </option>
  <option value="CZ"
                            
                            >
  Czechia 
  </option>
  <option value="DK"
                            
                            >
  Denmark 
  </option>
  <option value="DG"
                            
                            >
  Diego Garcia
  </option>
  <option value="DJ"
                            
                            >
  Djibouti
  </option>
  <option value="DM"
                            
                            >
  Dominica
  </option>
  <option value="DO"
                            
                            >
  Dominican Republic 
  </option>
  <option value="EC"
                            
                            >
  Ecuador
  </option>
  <option value="EG"
                            
                            >
  Egypt 
  </option>
  <option value="SV"
                            
                            >
  El Salvador
  </option>
  <option value="GQ"
                            
                            >
  Equatorial Guinea 
  </option>
  <option value="ER"
                            
                            >
  Eritrea
  </option>
  <option value="EE"
                            
                            >
  Estonia 
  </option>
  <option value="ET"
                            
                            >
  Ethiopia
  </option>
  <option value="FK"
                            
                            >
  Falkland Islands 
  </option>
  <option value="FO"
                            
                            >
  Faroe Islands 
  </option>
  <option value="FJ"
                            
                            >
  Fiji
  </option>
  <option value="FI"
                            
                            >
  Finland 
  </option>
  <option value="FR"
                            
                            >
  France
  </option>
  <option value="GF"
                            
                            >
  French Guiana 
  </option>
  <option value="PF"
                            
                            >
  French Polynesia 
  </option>
  <option value="TF"
                            
                            >
  French Southern Territories 
  </option>
  <option value="GA"
                            
                            >
  Gabon
  </option>
  <option value="GM"
                            
                            >
  Gambia
  </option>
  <option value="GE"
                            
                            >
  Georgia 
  </option>
  <option value="DE"
                            
                            >
  Germany 
  </option>
  <option value="GH"
                            
                            >
  Ghana 
  </option>
  <option value="GI"
                            
                            >
  Gibraltar
  </option>
  <option value="GR"
                            
                            >
  Greece 
  </option>
  <option value="GL"
                            
                            >
  Greenland 
  </option>
  <option value="GD"
                            
                            >
  Grenada
  </option>
  <option value="GP"
                            
                            >
  Guadeloupe
  </option>
  <option value="GU"
                            
                            >
  Guam
  </option>
  <option value="GT"
                            
                            >
  Guatemala
  </option>
  <option value="GG"
                            
                            >
  Guernsey
  </option>
  <option value="GN"
                            
                            >
  Guinea 
  </option>
  <option value="GW"
                            
                            >
  Guinea-Bissau 
  </option>
  <option value="GY"
                            
                            >
  Guyana
  </option>
  <option value="HT"
                            
                            >
  Haiti
  </option>
  <option value="HM"
                            
                            >
  Heard &amp; McDonald Islands
  </option>
  <option value="HN"
                            
                            >
  Honduras
  </option>
  <option value="HK"
                            
                            >
  Hong Kong 
  </option>
  <option value="HU"
                            
                            >
  Hungary 
  </option>
  <option value="IS"
                            
                            >
  Iceland 
  </option>
  <option value="IN"
                            
                            >
  India 
  </option>
  <option value="ID"
                            
                            >
  Indonesia
  </option>
  <option value="IR"
                            
                            >
  Iran 
  </option>
  <option value="IQ"
                            
                            >
  Iraq 
  </option>
  <option value="IE"
                            
                            >
  Ireland
  </option>
  <option value="IM"
                            
                            >
  Isle of Man
  </option>
  <option value="IL"
                            
                            >
  Israel 
  </option>
  <option value="IT"
                            
                            >
  Italy 
  </option>
  <option value="JM"
                            
                            >
  Jamaica
  </option>
  <option value="JP"
                            
                            >
  Japan
  </option>
  <option value="JE"
                            
                            >
  Jersey
  </option>
  <option value="JO"
                            
                            >
  Jordan 
  </option>
  <option value="KZ"
                            
                            >
  Kazakhstan 
  </option>
  <option value="KE"
                            
                            >
  Kenya
  </option>
  <option value="KI"
                            
                            >
  Kiribati
  </option>
  <option value="XK"
                            
                            >
  Kosovo 
  </option>
  <option value="KW"
                            
                            >
  Kuwait 
  </option>
  <option value="KG"
                            
                            >
  Kyrgyzstan 
  </option>
  <option value="LA"
                            
                            >
  Laos 
  </option>
  <option value="LV"
                            
                            >
  Latvia 
  </option>
  <option value="LB"
                            
                            >
  Lebanon 
  </option>
  <option value="LS"
                            
                            >
  Lesotho
  </option>
  <option value="LR"
                            
                            >
  Liberia
  </option>
  <option value="LY"
                            
                            >
  Libya 
  </option>
  <option value="LI"
                            
                            >
  Liechtenstein
  </option>
  <option value="LT"
                            
                            >
  Lithuania 
  </option>
  <option value="LU"
                            
                            >
  Luxembourg
  </option>
  <option value="MO"
                            
                            >
  Macau 
  </option>
  <option value="MK"
                            
                            >
  Macedonia
  </option>
  <option value="MG"
                            
                            >
  Madagascar 
  </option>
  <option value="MW"
                            
                            >
  Malawi
  </option>
  <option value="MY"
                            
                            >
  Malaysia
  </option>
  <option value="MV"
                            
                            >
  Maldives
  </option>
  <option value="ML"
                            
                            >
  Mali
  </option>
  <option value="MT"
                            
                            >
  Malta
  </option>
  <option value="MH"
                            
                            >
  Marshall Islands
  </option>
  <option value="MQ"
                            
                            >
  Martinique
  </option>
  <option value="MR"
                            
                            >
  Mauritania 
  </option>
  <option value="MU"
                            
                            >
  Mauritius 
  </option>
  <option value="YT"
                            
                            >
  Mayotte
  </option>
  <option value="MX"
                            
                            >
  Mexico 
  </option>
  <option value="FM"
                            
                            >
  Micronesia
  </option>
  <option value="MD"
                            
                            >
  Moldova 
  </option>
  <option value="MC"
                            
                            >
  Monaco
  </option>
  <option value="MN"
                            
                            >
  Mongolia 
  </option>
  <option value="ME"
                            
                            >
  Montenegro 
  </option>
  <option value="MS"
                            
                            >
  Montserrat
  </option>
  <option value="MA"
                            
                            >
  Morocco
  </option>
  <option value="MZ"
                            
                            >
  Mozambique 
  </option>
  <option value="MM"
                            
                            >
  Myanmar (Burma) 
  </option>
  <option value="NA"
                            
                            >
  Namibia 
  </option>
  <option value="NR"
                            
                            >
  Nauru
  </option>
  <option value="NP">
  Nepal 
  </option>
  <option value="NL"
                            
                            >
  Netherlands 
  </option>
  <option value="NC"
                            
                            >
  New Caledonia 
  </option>
  <option value="NZ"
                            
                            >
  New Zealand
  </option>
  <option value="NI"
                            
                            >
  Nicaragua
  </option>
  <option value="NE"
                            
                            >
  Niger
  </option>
  <option value="NG"
                            
                            >
  Nigeria
  </option>
  <option value="NU"
                            
                            >
  Niue
  </option>
  <option value="NF"
                            
                            >
  Norfolk Island
  </option>
  <option value="MP"
                            
                            >
  Northern Mariana Islands
  </option>
  <option value="KP"
                            
                            >
  North Korea 
  </option>
  <option value="NO"
                            
                            >
  Norway
  </option>
  <option value="OM"
                            
                            >
  Oman 
  </option>
  <option value="PK"
                            
                            >
  Pakistan 
  </option>
  <option value="PW"
                            
                            >
  Palau
  </option>
  <option value="PS"
                            
                            >
  Palestine 
  </option>
  <option value="PA"
                            
                            >
  Panama 
  </option>
  <option value="PG"
                            
                            >
  Papua New Guinea
  </option>
  <option value="PY"
                            
                            >
  Paraguay
  </option>
  <option value="PE"
                            
                            >
  Peru 
  </option>
  <option value="PH"
                            
                            >
  Philippines
  </option>
  <option value="PN"
                            
                            >
  Pitcairn Islands
  </option>
  <option value="PL"
                            
                            >
  Poland 
  </option>
  <option value="PT"
                            
                            >
  Portugal
  </option>
  <option value="PR"
                            
                            >
  Puerto Rico
  </option>
  <option value="QA"
                            
                            >
  Qatar 
  </option>
  <option value="RE"
                            
                            >
  Réunion 
  </option>
  <option value="RO"
                            
                            >
  Romania 
  </option>
  <option value="RU"
                            
                            >
  Russia 
  </option>
  <option value="RW"
                            
                            >
  Rwanda
  </option>
  <option value="WS"
                            
                            >
  Samoa
  </option>
  <option value="SM"
                            
                            >
  San Marino
  </option>
  <option value="ST"
                            
                            >
  São Tomé &amp; Príncipe 
  </option>
  <option value="SA"
                            
                            >
  Saudi Arabia 
  </option>
  <option value="SN"
                            
                            >
  Senegal
  </option>
  <option value="RS"
                            
                            >
  Serbia 
  </option>
  <option value="SC"
                            
                            >
  Seychelles
  </option>
  <option value="SL"
                            
                            >
  Sierra Leone
  </option>
  <option value="SG"
                            
                            >
  Singapore
  </option>
  <option value="SX"
                            
                            >
  Sint Maarten
  </option>
  <option value="SK"
                            
                            >
  Slovakia 
  </option>
  <option value="SI"
                            
                            >
  Slovenia 
  </option>
  <option value="SB"
                            
                            >
  Solomon Islands
  </option>
  <option value="SO"
                            
                            >
  Somalia 
  </option>
  <option value="ZA"
                            
                            >
  South Africa
  </option>
  <option value="GS"
                            
                            >
  South Georgia &amp; South Sandwich Islands
  </option>
  <option value="KR"
                            
                            >
  South Korea 
  </option>
  <option value="SS"
                            
                            >
  South Sudan 
  </option>
  <option value="ES"
                            
                            >
  Spain 
  </option>
  <option value="LK"
                            
                            >
  Sri Lanka 
  </option>
  <option value="BL"
                            
                            >
  St. Barthélemy
  </option>
  <option value="SH"
                            
                            >
  St. Helena
  </option>
  <option value="KN"
                            
                            >
  St. Kitts &amp; Nevis
  </option>
  <option value="LC"
                            
                            >
  St. Lucia
  </option>
  <option value="MF"
                            
                            >
  St. Martin 
  </option>
  <option value="PM"
                            
                            >
  St. Pierre &amp; Miquelon 
  </option>
  <option value="VC"
                            
                            >
  St. Vincent &amp; Grenadines
  </option>
  <option value="SD"
                            
                            >
  Sudan 
  </option>
  <option value="SR"
                            
                            >
  Suriname
  </option>
  <option value="SJ"
                            
                            >
  Svalbard &amp; Jan Mayen 
  </option>
  <option value="SZ"
                            
                            >
  Swaziland
  </option>
  <option value="SE"
                            
                            >
  Sweden 
  </option>
  <option value="CH"
                            
                            >
  Switzerland 
  </option>
  <option value="SY"
                            
                            >
  Syria 
  </option>
  <option value="TW"
                            
                            >
  Taiwan 
  </option>
  <option value="TJ"
                            
                            >
  Tajikistan
  </option>
  <option value="TZ"
                            
                            >
  Tanzania
  </option>
  <option value="TH"
                            
                            >
  Thailand
  </option>
  <option value="TL"
                            
                            >
  Timor-Leste
  </option>
  <option value="TG"
                            
                            >
  Togo
  </option>
  <option value="TK"
                            
                            >
  Tokelau
  </option>
  <option value="TO"
                            
                            >
  Tonga
  </option>
  <option value="TT"
                            
                            >
  Trinidad &amp; Tobago
  </option>
  <option value="TA"
                            
                            >
  Tristan da Cunha
  </option>
  <option value="TN"
                            
                            >
  Tunisia
  </option>
  <option value="TR"
                            
                            >
  Turkey 
  </option>
  <option value="TM"
                            
                            >
  Turkmenistan
  </option>
  <option value="TC"
                            
                            >
  Turks &amp; Caicos Islands
  </option>
  <option value="TV"
                            
                            >
  Tuvalu
  </option>
  <option value="UM"
                            
                            >
  U.S. Outlying Islands
  </option>
  <option value="VI"
                            
                            >
  U.S. Virgin Islands
  </option>
  <option value="UG"
                            
                            >
  Uganda
  </option>
  <option value="UA"
                            
                            >
  Ukraine 
  </option>
  <option value="AE"
                            
                            >
  United Arab Emirates 
  </option>
  <option value="GB"
                            
                            >
  United Kingdom
  </option>
  <option value="US"
                            
                            >
  United States
  </option>
  <option value="UY"
                            
                            >
  Uruguay
  </option>
  <option value="UZ"
                            
                            >
  Uzbekistan 
  </option>
  <option value="VU"
                            
                            >
  Vanuatu
  </option>
  <option value="VA"
                            
                            >
  Vatican City 
  </option>
  <option value="VE"
                            
                            >
  Venezuela
  </option>
  <option value="VN"
                            
                            >
  Vietnam 
  </option>
  <option value="WF"
                            
                            >
  Wallis &amp; Futuna
  </option>
  <option value="EH"
                            
                            >
  Western Sahara 
  </option>
  <option value="YE"
                            
                            >
  Yemen 
  </option>
  <option value="ZM"
                            
                            >
  Zambia
  </option>
  <option value="ZW"
                            
                            >
  Zimbabwe
  </option>
  </select>
			
			</div>
			
			<div class="form-group">
			<label for="userregistersaddress"> Address </label> <input type="text" maxlength="40" class="form-control" placeholder="Enter Street Address" value = "<?php echo $userregistersaddress;?>" name="userregistersaddress" id="userregistersaddress">
			<span class="text-danger"> 
						<?php
							echo $userregistersaddresserror;
						?>
			</span>	
			</div>
			
			<!--<div class="form-group">
			<label  for="userregistermobile">Mobile Number</label> <input type="number" max="99999999999999" class="form-control" placeholder="Enter Mobile Number" value = "<?php echo $userregistermobile;?>" name="userregistermobile" id="userregistermobile">
			<span class="text-danger"> 
						<?php
							echo $userregistermobileerror;
						?>
			</span>	
			</div>  -->
			
			<div class="form-group">
			<label for="userregistercollegeid"> College ID </label> <input type="number" min="0"  max="99999999999999" class="form-control" placeholder="Enter College ID" value = "<?php echo $userregistercollegeid;?>" name="userregistercollegeid" id="userregistercollegeid">
			<span class="text-danger"> 
						<?php
							echo $userregistercollegeiderror;
						?>
			</span>
			</div>
			
			<div class="form-group">
			<label for="userregistersymbol"> Symbol Number </label> <input type="number" max="99999999999999" class="form-control" placeholder="Enter Symbol Number" value = "<?php echo $userregistersymbol;?>" name="userregistersymbol" id="userregistersymbol">
			<span class="text-danger"> 
						<?php
							echo $userregistersymbolerror;
						?>
			</span>
			</div>
			
		
			
			<!--<div class="form-group">
			<label for="userregisterverification"> Verification Code </label> <input type="text" autocomplete="off"  maxlength="6" class="form-control" placeholder="Enter Verification Code" value = "<?php //echo $userregisterverification;?>" name="userregisterverification" id="userregisterverification">
			<span class="text-danger"> 
						<?php
							//echo $userregisterverificationerror;
						?>
			</span>
			<br/> <br/> <button class="btn btn-info disabled"> What is Verification Code <span class="glyphicon glyphicon-question-sign"> </span> </button>
			</div>
			
			<div class="well" style="background:#C1C1C1">
			<h3> What is Verification Code?</h3>
			<p> Verification Code is a 6 digit number. It helps us to make sure that you are registering and using this online examination site under some Company, Institute, Schools and College. </p>
			<h3> How to Get Verification Code?</h3>
			<p> You can get 6-digit verification code with the help of the schools or college or institute or company you are current in.</p>
			</div>-->
			<input type="submit" value ="Register" class="btn btn-primary" name="userregisterbutton"> 
			
		</form>
		</div>
		</div>
		</div>
	</div>
</div>
<footer class="text-center" style="color:red">
	Copyright &copy;
	<?php
	$date = date('Y');
	echo '2016 - ' . $date;
	?>
</footer>
</div>
</body>