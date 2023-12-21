<?php
session_start();
if (!isset($_COOKIE['ualreadylogin']))
{
	header("Location: userlogin.php");
}
$_SESSION['fromgiveexamofuser'] = true;
include_once 'dbconnect.php';
if (!isset($_SESSION['fromhometogiveexamclik']))
{
	unset($_SESSION['fromhometogiveexamclik']);
	header("Location: home.php");
}
//if (isset($_SESSION['formgiveexamresultbata']))
//{
	//unset($_SESSION['formgiveexamresultbata']);
	//header("Location: home.php");
//}
//to check whether this exam on todays date has been already given
$conyu78 = dbconnseparate();
$thisisdateok = date('Y-m-d');
$firstcheckalreadygiventhisexam = $conyu78->prepare("Select count(*) from result where Email = :emlai and Exam_Date = :exdate and Subject_Name = :namesubj");
$firstcheckalreadygiventhisexam->bindParam(':emlai',$_SESSION['userloginemaill'],PDO::PARAM_STR);
$firstcheckalreadygiventhisexam->bindParam(':exdate',$thisisdateok,PDO::PARAM_STR);
$firstcheckalreadygiventhisexam->bindParam(':namesubj',$_SESSION['subjectforgivingexam'],PDO::PARAM_STR);
$firstcheckalreadygiventhisexam->execute();
$isalright = $firstcheckalreadygiventhisexam->fetchColumn();

if ($isalright != 0)	
{
$_SESSION['examalreadygivenornot'] = "Exam is already given";
header("Location: home.php");
}
$conyu78 = null;							  
$firstcheckalreadygiventhisexam = null;	
	
$conn211 = dbconnseparate();		
$reandomcolegeidforbelow=$conn211->prepare("Select College_ID from userinfo where Email = :emailforfsfssresult");
$reandomcolegeidforbelow->bindParam(':emailforfsfssresult',$_COOKIE['ualreadylogin'],PDO::PARAM_STR);
$reandomcolegeidforbelow->execute();
$colllllegeiiidd = $reandomcolegeidforbelow->fetchColumn();
$conn211 = null;
$reandomcolegeidforbelow = null;

$conn311 = dbconnseparate();						 
$detailsfroddddmsetquestion=$conn311->prepare("Select Number_of_Hour,Date_of_Exam,Time_of_Exam from setexam where College_ID = :collegdddeidforexam and Subject_Name = :snameforedddd");
$detailsfroddddmsetquestion->bindParam(':collegdddeidforexam',$colllllegeiiidd,PDO::PARAM_STR);
$detailsfroddddmsetquestion->bindParam(':snameforedddd',$_SESSION['subjectforgivingexam'],PDO::PARAM_STR);
$detailsfroddddmsetquestion->execute();
$setexamrequirediddddnfo = $detailsfroddddmsetquestion->fetch(PDO::FETCH_ASSOC);

$dateofexammmmm = $setexamrequirediddddnfo['Date_of_Exam'];
$timeofexammmm = $setexamrequirediddddnfo['Time_of_Exam'];
$noofhourrrrr = $setexamrequirediddddnfo['Number_of_Hour'];
$conn311 = null;
$detailsfroddddmsetquestion = null;
date_default_timezone_set("Asia/Kathmandu");
$dateofcurrenttiming1 = date("Y-m-d");
$dateofcurrenttiming2 = date("H-i-s");
if ($dateofexammmmm != $dateofcurrenttiming1)
{
	header("Location: home.php");
}
if ($dateofexammmmm == $dateofcurrenttiming1)
{
	/*$cenvertedTime = date('H:i:s',strtotime("+$noofhourrrrr seconds",strtotime($timeofexammmm)));
	if ((strtotime($dateofcurrenttiming2) < strtotime($timeofexammmm)) || (strtotime($dateofcurrenttiming2) > strtotime($cenvertedTime)))
	{
		header("Location: home.php");
	}*/
}

if ($dateofexammmmm != $dateofcurrenttiming1)
{
	$_SESSION['whenexamforthussubj'] = "Exam for this subject is not today.";
}


if (isset($_POST['submitquestion']))
{	

if (!isset($_POST['answerq']))
{
$_POST['answerq'] = [];
}

$conn1 = dbconnseparate();	
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
$conn1->exec($sql);
$conn1 = null;
				 
							
$conn2 = dbconnseparate();		
$randommmmm=$conn2->prepare("Select First_Name,Last_Name,College_ID from userinfo where Email = :emailforresult");
$randommmmm->bindParam(':emailforresult',$_SESSION['userloginemaill'],PDO::PARAM_STR);
$randommmmm->execute();
$userrequiredinfo = $randommmmm->fetch(PDO::FETCH_ASSOC);
$userfirstname = $userrequiredinfo['First_Name'];
$userlastname = $userrequiredinfo['Last_Name'];
$_SESSION['usercollegeid'] = $userrequiredinfo['College_ID'];
$conn2 = null;
$randommmmm = null;
			
			
$conn3 = dbconnseparate();						 
$detailsfromsetquestion=$conn3->prepare("Select Number_of_Hour,Date_of_Exam,Time_of_Exam,Full_Marks,Pass_Marks from setexam where College_ID = :collegeidforexam and Subject_Name = :snameforexam");
$detailsfromsetquestion->bindParam(':collegeidforexam',$_SESSION['usercollegeid'],PDO::PARAM_STR);
$detailsfromsetquestion->bindParam(':snameforexam',$_SESSION['subjectforgivingexam'],PDO::PARAM_STR);
$detailsfromsetquestion->execute();
$setexamrequiredinfo = $detailsfromsetquestion->fetch(PDO::FETCH_ASSOC);
$fulmarks = $setexamrequiredinfo['Full_Marks'];
$pasmarks = $setexamrequiredinfo['Pass_Marks'];
$noofhour = $setexamrequiredinfo['Number_of_Hour'];
$_SESSION['dateofexam'] = $setexamrequiredinfo['Date_of_Exam'];
$timeofexam = $setexamrequiredinfo['Time_of_Exam'];
$_SESSION['timeofexamm'] = $timeofexam;
$_SESSION['pmark'] = $pasmarks;
$conn3 = null;
$detailsfromsetquestion = null;
	
	
$conn14 = dbconnseparate();				
$subjectfromsubjectcode = $conn14->prepare("Select Subject_Code from subjects where Subject_Name = :sbjtn");
$subjectfromsubjectcode->bindParam(':sbjtn',$_SESSION['subjectforgivingexam'],PDO::PARAM_STR);
$subjectfromsubjectcode->execute();
$sbjtdfromsbjtname = $subjectfromsubjectcode->fetchColumn();
$conn14 = null;
$subjectfromsubjectcode = null;

	$markob = 0;
	
				for ($i=0;$i<count($_POST['answerq']);$i++) 
				{	
					 if ($_SESSION['Correct_Answer'][$i] == $_POST['answerq'][$i])
					  {
						  
						  $markob = $markob + $_SESSION['Question_Marks'][$i];
					  }
				}
if ($markob >= $_SESSION['pmark'])
{
$passfail = "Pass";
}
else
{
$passfail = "Fail";
}
$conn14 = null;	
$subjectfromsubjectcode = null;

$conn6 = dbconnseparate();			
$todaydate = date("Y-m-d H:i:s");
$flagforr   = 1;
$emailforresultt = $_SESSION['userloginemaill'];
$subjnameresul = $_SESSION['subjectforgivingexam'];
$usercollegeid = $_SESSION['usercollegeid'];
$daexamtak= $_SESSION['dateofexam'];
$sql = "INSERT INTO result (First_Name,Last_Name,Email,College_ID,Exam_Date,Subject_Name,Pass_Fail,Position,Full_Marks_of_Subject,Pass_Marks,Total_Marks_Obtained,Flag)
VALUES ('$userfirstname','$userlastname','$emailforresultt','$usercollegeid','$daexamtak','$subjnameresul','$passfail','','$fulmarks',$pasmarks,'$markob','$flagforr')";
$conn6->exec($sql);
$conn6 = null;	
$sql = null;
$_SESSION['formgiveexambata'] = true;
header("Location: viewresults.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> Give Exam </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js">		</script>
<script src="js/bootstrap.min.js">	</script>
</head>
<style>
		.jumbotron{
						 margin-top:2px;
						 margin-bottom:5px;
						 padding-top:10px;
						 background:#50d07d;
		}

		.jumbotron p{
						 line-height:20px;
						 color:#651287;
		}
		
}

</style>
<body style="background:#C0C0C0">

<div  class="jumbotron text-center">
 <h1>  <span class="glyphicon glyphicon-education">Online Examination System  <span class="glyphicon glyphicon-education"> </h1>
		<p> Give Online Exams For Any Subjects </p>
		<p> Improve Your Skills </p>
</div>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="mynavbar">
			<span class="icon-bar"> <span>
			<span class="icon-bar"> <span>
			<span class="icon-bar"> <span>
			</button>
			<a class="navbar-brand" href="#"><img src="images/teammrj.jpg" class="img-circle img-responsive" style="max-width:20%" alt="Logo"> </a>
		</div>
		<div class="collapse navbar-collapse" id="mynavbar">
		<ul class="nav navbar-nav">
			
			<?php
						
					function checkstudentfirstnameindb()
					{
						try
						{
							
								$username = "root";
								$password = "mukeshbhandarii1*";
								$servername = "localhost";
								$dbname = "online_exam";
								$email = $_SESSION['userloginemaill'];
								
								
								$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
								$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
								$firstname = $conn->prepare("SELECT First_Name FROM userinfo WHERE Email = :email");
								$firstname->bindParam(':email',$email,PDO::PARAM_STR);
								$firstname->execute();
								$stfirstname 	= $firstname->fetchColumn();
								return $stfirstname;
								//echo "Welcome " . $stfirstname;
						}
						
							catch(PDOException $e)
						{
							echo $e->getMessage();
						}
					}
					 $userfirstnam = checkstudentfirstnameindb();
					  echo "<li class='text-center' style='color:white'>";
					  echo "Welcome " . $userfirstnam . "</li>";
			?>
			<!--<li> <a href="home.php"> User Home Page</a>  </li>-->
			
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<!--<li> <a href="uchangepassword.php"> Change Password </a> </li>-->
			<!--<li> <a href="ulogout.php">Log Out </a> </li>-->
		</ul>
		</div>
	</div>
</nav>

<div id ="status" style="color:red;margin-left:10px" class="affix"> </div>




<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 pull-left"></div>
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">
					<?php
					echo $_SESSION['subjectforgivingexam'];
					?>
				</div>
			</div>
		</div>
		<div class="col-md-3 pull-right"></div>
	</div>
</div>

<div class="container-fluid" style="margin-bottom:10px">
	<div class="row">
		<div class="col-md-3 pull-left"></div>
		<div class="col-md-6" style="background:yellow;padding-bottom:10px">
				<?php
				
$conn10 = dbconnseparate();				
$subjectidfromsubjectcode = $conn10->prepare("Select Subject_Code from subjects where Subject_Name = :sbjtnam");
$subjectidfromsubjectcode->bindParam(':sbjtnam',$_SESSION['subjectforgivingexam'],PDO::PARAM_STR);
$subjectidfromsubjectcode->execute();
$sbjtidfromsbjtname = $subjectidfromsubjectcode->fetchColumn();
$conn10 = null;
$subjectidfromsubjectcode = null;




$conn12 = dbconnseparate();		
$ra=$conn12->prepare("Select College_ID from userinfo where Email = :emailforresut");
$ra->bindParam(':emailforresut',$_SESSION['userloginemaill'],PDO::PARAM_STR);
$ra->execute();
$userrequiredclgid = $ra->fetch(PDO::FETCH_ASSOC);
$uclgid= $userrequiredclgid['College_ID'];
$conn12 = null;
$ra = null;



$conn11 = dbconnseparate();				
$ressss = $conn11->prepare("SELECT COUNT(*) FROM question where College_ID = :collegeidddd and Subject_Code = :ssco");
$ressss->bindParam(':collegeidddd',$uclgid,PDO::PARAM_STR);
$ressss->bindParam(':ssco',$sbjtidfromsbjtname,PDO::PARAM_STR);
$ressss->execute();

$countques = $ressss->fetchColumn();
$countquestion = $countques - 1;
$con11 = null;

				try
				{
					$servername = "localhost";
					$username = "root";
					$password = "mukeshbhandarii1*";
					$dbname = "online_exam";
					$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					$res = $conn->prepare("Select Questions,Option_1,Option_2,Option_3,Option_4,Correct_Answer,Question_Marks From question where College_ID = :collegeid and Subject_Code = :sco");
					$res->bindParam(':collegeid',$uclgid,PDO::PARAM_STR);
					$res->bindParam(':sco',$sbjtidfromsbjtname,PDO::PARAM_STR);
					$res->execute();
					$row = $res->fetchAll(PDO::FETCH_ASSOC);
					
					echo "<form role='form' id='myexam' method='POST' action=''>";
					echo "<ol>";
					$i = 0;
					while ($i <= $countquestion)
					{
						$_SESSION['$i']['Questions'] = $row[$i]['Questions'];
						$_SESSION['$i']['Option_1'] = $row[$i]['Option_1'];
						$_SESSION['$i']['Option_2'] = $row[$i]['Option_2'];
						$_SESSION['$i']['Option_3'] = $row[$i]['Option_3'];
						$_SESSION['$i']['Option_4'] = $row[$i]['Option_4'];
					  $que_correct_ans[] = $row[$i]['Correct_Answer'];
					  $que_ques_marks[] =  $row[$i]['Question_Marks'];
					    echo "<li>";
						 echo "<h3>" . $row[$i]['Questions'].  "</h3>";
						 
						 echo "<div>";
						 echo "<input type='radio' name='answerq[$i]' value='" . $row[$i]['Option_1'] . "'>";
						 echo $row[$i]['Option_1'];
						 echo "</div>";
						 
						 echo "<div>";
						 echo "<input type='radio' name='answerq[$i]' value='" . $row[$i]['Option_2']. "'>";
						 echo $row[$i]['Option_2'];
						 echo "</div>";
						 
						 echo "<div>";
						 echo "<input type='radio' name='answerq[$i]' value='" . $row[$i]['Option_3'] . "'>";
						 echo  $row[$i]['Option_3'];
						 echo "</div>";
						 
						 echo "<div>";
						 echo "<input type='radio' name='answerq[$i]' value='" . $row[$i]['Option_4'] .  "'>";
						echo $row[$i]['Option_4'];
						 echo  "</div>";
						 $i++;
						 
						echo "</li>";
					
						 echo "<br/>";
						 echo "<hr>";
						 
					 }
					echo "</ol>";
					echo "<input type='submit' id='submitques' class='btn btn-info' name='submitquestion' value='Submit Questions'>";
					echo "</form>";
			
				 $_SESSION['Correct_Answer'] = $que_correct_ans;
				$_SESSION['Question_Marks'] = $que_ques_marks;
				}

				catch (PDOException $e)
				{
				echo $e->getMessage();
				}
				?>
		</div>
		<div class="col-md-3 pull-right"></div>
	</div>
</div>
	


<footer class="text-center" style="color:red;margin-bottom:40px">
	Copyright &copy;
	<?php
	$date = date('Y');
	echo '2016 - ' . $date;
	?>
</footer>
<?php
$conn21dfdf1 = dbconnseparate();		
$reandomcdffolegeidforbelow=$conn21dfdf1->prepare("Select College_ID from userinfo where Email = :emailforfsfssresult");
$reandomcdffolegeidforbelow->bindParam(':emailforfsfssresult',$_COOKIE['ualreadylogin'],PDO::PARAM_STR);
$reandomcdffolegeidforbelow->execute();
$colllllegeiiidsssd = $reandomcdffolegeidforbelow->fetchColumn();
$conn21dfdf1 = null;
$reandomcdffolegeidforbelow = null;

$conn3222 = dbconnseparate();						 
$detailsddffsffromsetquestion=$conn3222->prepare("Select Number_of_Hour from setexam where College_ID = :collegeidforexam and Subject_Name = :snameforexam");
$detailsddffsffromsetquestion->bindParam(':collegeidforexam',$colllllegeiiidsssd,PDO::PARAM_STR);
$detailsddffsffromsetquestion->bindParam(':snameforexam',$_SESSION['subjectforgivingexam'],PDO::PARAM_STR);
$detailsddffsffromsetquestion->execute();
$setexamreqdddduiredinfo = $detailsddffsffromsetquestion->fetch(PDO::FETCH_ASSOC);
$noofhousssr = $setexamreqdddduiredinfo['Number_of_Hour'];
$conn3222 = null;
$detailsddffsffromsetquestion = null;
?>




<script>
var seconds= <?php echo $noofhousssr; ?>;
function timer() {
    var days        = Math.floor(seconds/24/60/60);
    var hoursLeft   = Math.floor((seconds) - (days*86400));
    var hours       = Math.floor(hoursLeft/3600);
    var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
    var minutes     = Math.floor(minutesLeft/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('status').innerHTML =  hours + " Hour " + minutes + " Minutes " + remainingSeconds + " Seconds Remaining";
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('myexam').submit();
    } else {
        seconds--;
    }
}
var countdownTimer = setInterval('timer()', 1000);
</script>

</body>
</html>