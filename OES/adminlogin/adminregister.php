<?php
session_start();
include_once 'checkifadmininfoexist.php';
include_once 'checkifuserinfoexist.php';
checkadmininfoexistindb();
checkuserinfoexistindb();
$adminregisterfromprevious   = true;
$adminregistercollegename="";
$adminregisteremail="";
$adminregisterpwd="";
$adminregisterrepwd="";
$adminregistercountry="";
$adminregistersaddress="";
//$adminregisterphone="";
$adminregistercollegeid="";
$adminregisterverification="";
$error = 0;

$adminregistercollegenameerror="";
$adminregisteremailerror="";
$adminregisterpwderror="";
$adminregisterrepwderror="";
//$adminregistercountryerror="";
$adminregistersaddresserror="";
//$adminregisterphoneerror="";
$adminregistercollegeiderror="";
$adminregisterverificationerror="";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	/*if ((empty($_POST['adminregistercollegename']))||(empty($_POST['adminregisteremail']))||(empty($_POST['adminregisterpwd']))||(empty($_POST['adminregisterrepwd'])) ||(empty($_POST['adminregistersaddress']))||(empty($_POST['adminregisterphone']))||(empty($_POST['adminregistercollegeid']))||(empty($_POST['adminregisterverification'])) || ($_POST['adminregisterpwd'] != $_POST['adminregisterrepwd'])|| (!ctype_alpha($_POST['adminregistercollegename']))|| )
	{*/
		
			if (empty($_POST['adminregistercollegename']))
			{
				$adminregistercollegenameerror = "College Name is Required";
				$error = 1;
			}
			
			if ((!empty($_POST['adminregistercollegename']))&&ctype_alpha($_POST['adminregistercollegename']))
			{
				$adminregistercollegename = $_POST['adminregistercollegename'];
			}
			
			if (empty($_POST['adminregisteremail']))
			{
				$error = 1;
				$adminregisteremailerror = "Email is Required";
			}
			else
			{
				$adminregisteremail = $_POST['adminregisteremail'];
			}
			
			if ((empty($_POST['adminregisterpwd'])) || (empty($_POST['adminregisterrepwd'])))
			{
				
			
					if (empty($_POST['adminregisterpwd']))
					{
						$error = 1;
						$adminregisterpwderror = "Password is Required";
					}
					else
					{
						$adminregisterpwd = $_POST['adminregisterpwd'];
					}
					
					if (empty($_POST['adminregisterrepwd']))
					{
						$error = 1;
						$adminregisterrepwderror = "Re-Entering of Password is Required";
					}
					else
					{
						$adminregisterrepwd = $_POST['adminregisterrepwd'];
					}
			}
			else
			{
					$adminregisterpwd = $_POST['adminregisterpwd'];
					$adminregisterrepwd = $_POST['adminregisterrepwd'];
					if (($_POST['adminregisterpwd']) != ($_POST['adminregisterrepwd']))
					{
						$error = 1;
						$adminregisterrepwderror = "Password do not Match.";
					}
					else
					{
						if (strlen($_POST['adminregisterpwd'])<8 || strlen($_POST['adminregisterrepwd'])<8 )
						{
							$error = 1;
							$adminregisterrepwderror = "Password must be atleast 8 character long";
						}
					}
				
			}
			
			
			/*if (empty($_POST['adminregistercountry']))
			{
				$error = 1;
				$adminregistercountryerror = "Country is Required";
			}
			if ((!empty($_POST['adminregistercountry'])) && (!ctype_alpha($_POST['adminregistercountry'])))
			{
				$error = 1;
				$adminregistercountry = $_POST['adminregistercountry'];
				$adminregistercountryerror = "Invalid Country";
			}
			if ((!empty($_POST['adminregistercountry']))&&ctype_alpha($_POST['adminregistercountry']))
			{
				$adminregistercountry = $_POST['adminregistercountry'];
			}*/
			
			if (empty($_POST['adminregistersaddress']))
			{
				$error = 1;
				$adminregistersaddresserror = "Enter the Location of College";
			}
			else
			{
				$adminregistersaddress = $_POST['adminregistersaddress'];
			}
			
			/*if (empty($_POST['adminregisterphone']))
			{
				$error = 1;
				$adminregisterphoneerror = "Phone Number is Required";
			}
			else
			{
				$adminregisterphone = $_POST['adminregisterphone'];
			}*/
			
			if (empty($_POST['adminregistercollegeid']))
			{
				$error = 1;
				$adminregistercollegeiderror = "College ID is Required";
			}
			else
			{
				$adminregistercollegeid = $_POST['adminregistercollegeid'];
			}
			
			if (empty($_POST['adminregisterverification']))
			{
				$error = 1;
				$adminregisterverificationerror = "Verification Code is Required";
			}
			else
			{
						function verificationcodeexist()
						{
						try{
							$servername = "localhost";
								$username = "root";
								$password = "mukeshbhandarii1*";
								$dbname = "online_exam";
								$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
								$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
								$getverificationcodeynfromdb=$conn->prepare("SELECT Verification_Code FROM verificationcode WHERE Verification_Code = :verificatecode");
								$getverificationcodeynfromdb->bindParam(':verificatecode',$_POST['adminregisterverification'],PDO::PARAM_STR);
								$getverificationcodeynfromdb->execute();
								$verificateexistornot 	= $getverificationcodeynfromdb->fetchColumn();
								return $verificateexistornot;
						}
						catch(PDOException $e)
						{
							echo $e->getMessage();
						}
					}
					$verificateexistornot = verificationcodeexist();
					if ($verificateexistornot)
					{
						$adminregisterverification = $_POST['adminregisterverification'];
						
					}
					else{
						$error = 1;
						$adminregisterverificationerror = "Verification Code is Incorrect.";
					}
			}
	
	
	//if (!$error)
		//{
			$adminregistercollegename		= $_POST['adminregistercollegename'];
			$adminregisteremail				= $_POST['adminregisteremail'];
			$adminregisterpwd				= $_POST['adminregisterpwd'];
			$adminregistercountry			= $_POST['adminregistercountry'];
			$adminregistersaddress			= $_POST['adminregistersaddress'];
			//$adminregisterphone				= $_POST['adminregisterphone'];
			$adminregistercollegeid			= $_POST['adminregistercollegeid'];
			//$adminregisterverification		= $_POST['$adminregisterverification'];
			
			$_SESSION['adminregistercollegenamee'] 	= $adminregistercollegename;
			$_SESSION['adminregisteremaill'] 		= $adminregisteremail;	
			$_SESSION['adminregisterpwdd'] 			= $adminregisterpwd;
			$_SESSION['adminregistercountryy']		= $adminregistercountry;
			$_SESSION['adminregistersaddresss']		= $adminregistersaddress;
			//$_SESSION['adminregisterphonee'] 		= $adminregisterphone	;
			$_SESSION['adminregistercollegeidd'] 		= $adminregistercollegeid;	
			//$_SESSION['adminregisterverificationn'] 	= $adminregisterverification;
			$_SESSION['adminregisterfrompreviouss'] 	= $adminregisterfromprevious;
			

			
			
			
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
			    
				
				
						 $forsche = "SELECT Email FROM admininfo WHERE Email = :email UNION SELECT Email FROM userinfo WHERE Email = :email";
						 $forbp = ':email';
						 $emailexistencecheck = existensechec($chec,$_POST['adminregisteremail'],$forsche,$forbp);
							if ($emailexistencecheck['Email'])
									{
										$adminregisteremailerror = "Email Already Exists";
										$error = 1;
									}
									
									
				
						/*$forsche = "SELECT Phone_Number FROM admininfo WHERE Phone_Number = :phonenumber";
						 $forbp = ':phonenumber';
						 $mobileexistencecheck = existensechec($chec,$_POST['adminregisterphone'],$forsche,$forbp);
							if ($mobileexistencecheck["Phone_Number"])
									{ 
										$adminregisterphoneerror = "Phone Number Already Exists";
										$error = 1;
									}*/
									
						$forsche = "SELECT College_ID FROM admininfo WHERE College_ID = :collegeid";
						 $forbp = 'collegeid';
						 $symbolexistencecheck = existensechec($chec,$_POST['adminregistercollegeid'],$forsche,$forbp);
							if ($symbolexistencecheck['College_ID'])
									{
										$adminregistercollegeiderror = "College ID Already Exists";
										$error = 1;
									}

							if (!$error)
							{
								$adminregisterfromprevious   = true;
								header("Location: adminregistrationcheck.php");
							}
	
	
		//}	
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>  Admin Registration </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../userlogin/css/bootstrap.min.css" rel="stylesheet">
<script src="../userlogin/js.bootstrap.min.js"> </script>
<script src="../userlogin/jquery.min.css"> </script>
</head>
<style>
.jumbotron      {
						 margin-top:2px;
						 margin-bottom:5px;
						 padding-top:10px;
						 background:#50d07d;
				}
.jumbotron p{
						 line-height:20px;
						 color:#651287;
		}
.main{
			margin-bottom:10px;
}
</style>
<body>
<div class="container-fluid main" style="background:#C0C0C0">
<div class="jumbotron text-center">
		 <h1>  <span class="glyphicon glyphicon-education">Online Examination System  <span class="glyphicon glyphicon-education"> </h1>
		 <p> Conduct Exams Online </p>
		 <p> Sharpen Your Students Brain </p>
	</div>
<div class="container">
	<div class="row">
	<div class="col-md-3"> <a class="btn btn-info btn-block" href="../index.php" role="button"> Main Page </a> <br/> </div>
		<div class="col-md-6">
			<div class="panel panel-primary">
			<div class="panel-heading"> New Admin Registration</div>
			<div class="panel-body">
				<p style="color:red"> Warning : Except Password, Once added information cannot be edited later. So, Be careful while adding details </p>
		<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="adminregistrationform" method="POST">
		
			<div class="form-group">
			<label for="adminregistercollegename"> College Name </label> <input type="text" maxlength="40" placeholder="Enter First Name" class="form-control" value = "<?php echo $adminregistercollegename;?>" name="adminregistercollegename" id="adminregistercollegename" autofocus>
			<span class="text-danger"> 
						<?php
							echo $adminregistercollegenameerror;
						?>
			</span>	
			</div>
			
			
			<div class="form-group">
			<label for="adminregisteremail"> Email </label> <input type="email" maxlength="40" placeholder="Enter Email" class="form-control"  value = "<?php echo $adminregisteremail;?>" name="adminregisteremail" id="adminregisteremail">
			<span class="text-danger"> 
						<?php
							echo $adminregisteremailerror;
						?>
			</span>	
			</div>
			
			
			<div class="form-group">
			<label for="adminregisterpwd"> Password</label> <input type="password" maxlength="20" class="form-control" placeholder="Enter Password" value = "<?php echo $adminregisterpwd;?>" name="adminregisterpwd" id="adminregisterpwd">
			<span class="text-danger"> 
						<?php
							echo $adminregisterpwderror;
						?>
			</span>	
			</div>
			
			<div class="form-group">
			<label for="adminregisterrepwd"> Re-Enter Password </label> <input type="password" maxlength="20" class="form-control" placeholder="Re-enter Password" value = "<?php echo $adminregisterrepwd;?>" name="adminregisterrepwd" id="adminregisterrepwd">
			<span class="text-danger"> 
						<?php
							echo $adminregisterrepwderror;
						?>
			</span>	
			</div>
			
			<div class="form-group">
			<label for="adminregistercountry"> Country </label> <br/>
			<select id="adminregistercountry" class="form-control" name="adminregistercountry">
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
  <option value="NP"
                            
                             
                            
                            >
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
			<label for="adminregistersaddress"> Address </label> <input type="text" maxlength="40" class="form-control" placeholder="Enter Street Address" value = "<?php echo $adminregistersaddress;?>" name="adminregistersaddress" id="adminregistersaddress">
			<span class="text-danger"> 
						<?php
							echo $adminregistersaddresserror;
						?>
			</span>	
			</div>
			
			<!--<div class="form-group">
			<label  for="adminregisterphone">Phone Number</label> <input type="number" max="99999999999999" class="form-control" placeholder="Enter Phone Number" value = "<?php //echo $adminregisterphone;?>" name="adminregisterphone" id="adminregisterphone">
			<span class="text-danger"> 
						<?php
							//echo $adminregisterphoneerror;
						?>
			</span>
			</div>-->
			
			<div class="form-group">
			<label for="adminregistercollegeid"> College ID </label> <input type="number" min="0" max="99999999999999" class="form-control" placeholder="Enter College ID" value = "<?php echo $adminregistercollegeid;?>" name="adminregistercollegeid" id="adminregistercollegeid">
			<span class="text-danger"> 
						<?php
							echo $adminregistercollegeiderror;
						?>
			</span>
			</div>
			
			<div class="form-group">
			<label for="adminregisterverification"> Verification Code </label> <input type="text" autocomplete="off"  maxlength="6" class="form-control" placeholder="Enter Verification Code" value = "<?php echo $adminregisterverification;?>" name="adminregisterverification" id="adminregisterverification">
			<span class="text-danger"> 
						<?php
							echo $adminregisterverificationerror;
						?>
			</span>
			<br/> <br/> <button class="btn btn-info disabled"> What is Verification Code <span class="glyphicon glyphicon-question-sign"> </span> </button>
			</div>
			<div class="well" style="background:#C1C1C1">
			<h3> What is Verification Code?</h3>
			<p> Verification Code is a alphanumeric code. It helps us to make sure that your registration for admin on this online examination site is not by any random person. It is to verify that you are really team of some Company, Institute, Schools and College. </p>
			<h3> How to Get Verification Code?</h3>
			<p> You can get verification code by emailing the following documents at mukeshrupeshjeevan@engineer.com
			</p>
			<dl>
				<dt> Picture of Any Document of You Company or Institute or School or College which most include the following </dt>
				<dd> - Stamp of Government  </dd>
				<dd> - Address of College  </dd>
				<dd> - Phone Number </dd>
				<dd> - College Id </dd>
				<dd> - All Required Information </dd>
			</dl>
			<p> After Getting Verification Code, Come Back to this Page and Sign Up. </p>
			</div>
			<input type="submit" value ="Register" class="btn btn-primary" name="adminregister"> 
			
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