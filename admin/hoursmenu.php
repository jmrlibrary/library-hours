<?php include('config.php');?>
<title><?=librarysystemname?> Hours Tool--Menu</title>
<link type="text/css" href="css/hoursadmin.css" rel="stylesheet" />
</head>
<body>
<?php
//Connect to database
$con = mysqli_connect(databasehost, databaseuser, databasepassword, databasename); 
if (!$con) {
	die('Could not connect: ' . mysqli_error());}
//mysqli_select_db("jmrl_hours", $con);
//Get semesters
$semesterquery = "select SemID, SemYear, SeasonID from Semesters order by SemYear, SeasonID";
$semesterresult = mysqli_query($con,$semesterquery);
//Get semester names
while ($row = mysqli_fetch_array($semesterresult)) {
	$semnamequery = "select SeasonName, SeasonID from Season where SeasonID = " . $row['SeasonID'];
	$semnameresult = mysqli_query($con,$semnamequery);
	$seasonrow = mysqli_fetch_row($semnameresult);
	$semesters[] = array($row['SemID'], $row['SemYear'], $seasonrow[0]);}
?>
<br/>
<div style="background-color:white; margin-left:8%; margin-right:25%; height:55%;">
<h2><a href="hoursmenu.php"><?=librarysystemname?> Hours Tool</a></h2>
<br/>
<ul style="list-style:square;">
<li><a href="semesters.php">Set season beginning and end dates and add or delete seasons.</a></li>
<br/>
<li><form action="regular.php" method=post>Set regular hours for &nbsp;
<select name="season">
<?php
//Count number of semnames and then loop through each for the dropdown menu.
$num_semesterresults = mysqli_num_rows($semesterresult);
for ($i = 0; $i < $num_semesterresults; $i++){
echo '<option value="' . $semesters[$i][0] . "+" . $semesters[$i][1] . "+" . $semesters[$i][2] . '">' . $semesters[$i][2] . " " . $semesters[$i][1] . '</option>';}
echo '</select><input type=submit value="Go!"></input></form></li>';
?>


<li><a href="holidays.php">Set holiday closings and special hours</a></li>
<!--<br/>
<li><a href="embed.php">Generate code to add hours to your website</a></li>-->
<br/>
<li><a href="../hoursdisplay.php?name=1">View sample display of hours</a></li>
<br/>
<li><a href="../test.html">Demo of things you can add with JavaScript</a></li>
<br/>
<!--<li><a href="logout.php">Logout</a></li>-->
</ul></div></div>
</body>