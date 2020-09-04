<head>
<?php include('config.php');?>
<title><?=librarysystemname?> Hours Tool--Edit Semesters</title>
<!--CSS and javascript link for calendar date-picker:-->
<link type="text/css" href="css/hoursadmin.css" rel="stylesheet" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript">
	window.onload = function(){
	var startfields = document.getElementsByName("start");
	var endfields = document.getElementsByName("end");
	for (var i = 0; i < startfields.length; i++)
	{
		var startfield = startfields[i].id;
		$( "#" + startfield ).datepicker({
			showOn: "button",
			buttonImage: "css/smoothness/images/calendar.jpg",
			buttonImageOnly: true
		});
	};
	for (var i = 0; i < startfields.length; i++)
	{
			var endfield = endfields[i].id;
		$( "#" + endfield ).datepicker({
			showOn: "button",
			buttonImage: "css/smoothness/images/calendar.jpg",
			buttonImageOnly: true
		});
	}
	};
</script>

</head>
<body>
<!-- Javascript "Are you sure?" script for deleting things -->
<script type="text/javascript">
 function makesure($message) {
  if (confirm($message)) {
    return true;
  }
  else {
    return false;
  }
 }
</script>
<br/>
<div style="background-color:white; margin-left:8%; margin-right:25%;">
<h2><a href="hoursmenu.php"><?=librarysystemname?> Hours Tool</a></h2>
<br/>
<?php
include('config.php');
//Connect to database
$con = mysqli_connect(databasehost, databaseuser, databasepassword, databasename);
if (!$con) {
	die('Could not connect: ' . mysqli_error());}
//
//Functions:
function mysqli_fetch_rowsarr($result, $numass=MYSQLI_BOTH) {
  $i=0;
  $keys=array_keys(mysqli_fetch_array($result, $numass));
  mysqli_data_seek($result, 0);
    while ($row = mysqli_fetch_array($result, $numass)) {
      foreach ($keys as $speckey) {
        $got[$i][$speckey]=$row[$speckey];
      }
    $i++;
    }
  return $got;
}
function sqldate($usdate) {
	return date("Y-m-d", strtotime($usdate));
	}
function usdate($sqldate) {
	return date("m/d/Y", strtotime($sqldate));
	}
function newcheckdate($data) {
    if (date('m/d/Y', strtotime($data)) == $data or date('n/d/Y', strtotime($data)) == $data or date('n/d/y', strtotime($data)) == $data or date('m/d/Y', strtotime($data)) == $data) {
        return true;
    }
	elseif (date('m/j/Y', strtotime($data)) == $data or date('n/j/Y', strtotime($data)) == $data or date('n/j/y', strtotime($data)) == $data or date('m/j/Y', strtotime($data)) == $data) {
        return true;
    }	
	elseif (date('m/j/Y', strtotime($data)) == $data . "/" . date(Y) or date('n/j/Y', strtotime($data)) == $data  . "/" . date(Y) or date('n/j/y', strtotime($data)) == $data  . "/" . date(Y) or date('m/j/Y', strtotime($data)) == $data  . "/" . date(Y) ) {
        return true;
    }
	elseif (date('m/d/Y', strtotime($data)) == $data . "/" . date(Y) or date('n/d/Y', strtotime($data)) == $data  . "/" . date(Y) or date('n/d/y', strtotime($data)) == $data  . "/" . date(Y) or date('m/d/Y', strtotime($data)) == $data  . "/" . date(Y) ) {
        return true;
	}
	else {
        return false;
    }
}

//Default Hours
$librarysched = array();
//Central
$librarysched[1][0]['start'] = '13:00:00';
$librarysched[1][0]['end'] = '17:00:00';
$librarysched[1][0]['closed'] = 0;
$librarysched[1][1]['start'] = '09:00:00';
$librarysched[1][1]['end'] = '21:00:00';
$librarysched[1][1]['closed'] = 0;
$librarysched[1][2]['start'] = '09:00:00';
$librarysched[1][2]['end'] = '21:00:00';
$librarysched[1][2]['closed'] = 0;
$librarysched[1][3]['start'] = '09:00:00';
$librarysched[1][3]['end'] = '21:00:00';
$librarysched[1][3]['closed'] = 0;
$librarysched[1][4]['start'] = '09:00:00';
$librarysched[1][4]['end'] = '21:00:00';
$librarysched[1][4]['closed'] = 0;
$librarysched[1][5]['start'] = '09:00:00';
$librarysched[1][5]['end'] = '17:00:00';
$librarysched[1][5]['closed'] = 0;
$librarysched[1][6]['start'] = '09:00:00';
$librarysched[1][6]['end'] = '17:00:00';
$librarysched[1][6]['closed'] = 0;
//Crozet
$librarysched[2][0]['start'] = '00:00:00';
$librarysched[2][0]['end'] = '00:00:00';
$librarysched[2][0]['closed'] = 1;
$librarysched[2][1]['start'] = '13:00:00';
$librarysched[2][1]['end'] = '21:00:00';
$librarysched[2][1]['closed'] = 0;
$librarysched[2][2]['start'] = '13:00:00';
$librarysched[2][2]['end'] = '21:00:00';
$librarysched[2][2]['closed'] = 0;
$librarysched[2][3]['start'] = '09:00:00';
$librarysched[2][3]['end'] = '21:00:00';
$librarysched[2][3]['closed'] = 0;
$librarysched[2][4]['start'] = '09:00:00';
$librarysched[2][4]['end'] = '17:00:00';
$librarysched[2][4]['closed'] = 0;
$librarysched[2][5]['start'] = '09:00:00';
$librarysched[2][5]['end'] = '17:00:00';
$librarysched[2][5]['closed'] = 0;
$librarysched[2][6]['start'] = '09:00:00';
$librarysched[2][6]['end'] = '17:00:00';
$librarysched[2][6]['closed'] = 0;
//Gordon
$librarysched[3][0]['start'] = '00:00:00';
$librarysched[3][0]['end'] = '00:00:00';
$librarysched[3][0]['closed'] = 1;
$librarysched[3][1]['start'] = '09:00:00';
$librarysched[3][1]['end'] = '21:00:00';
$librarysched[3][1]['closed'] = 0;
$librarysched[3][2]['start'] = '09:00:00';
$librarysched[3][2]['end'] = '18:00:00';
$librarysched[3][2]['closed'] = 0;
$librarysched[3][3]['start'] = '12:00:00';
$librarysched[3][3]['end'] = '21:00:00';
$librarysched[3][3]['closed'] = 0;
$librarysched[3][4]['start'] = '10:00:00';
$librarysched[3][4]['end'] = '18:00:00';
$librarysched[3][4]['closed'] = 0;
$librarysched[3][5]['start'] = '10:00:00';
$librarysched[3][5]['end'] = '17:00:00';
$librarysched[3][5]['closed'] = 0;
$librarysched[3][6]['start'] = '10:00:00';
$librarysched[3][6]['end'] = '17:00:00';
$librarysched[3][6]['closed'] = 0;
//Greeene
$librarysched[4][0]['start'] = '00:00:00';
$librarysched[4][0]['end'] = '00:00:00';
$librarysched[4][0]['closed'] = 1;
$librarysched[4][1]['start'] = '12:00:00';
$librarysched[4][1]['end'] = '20:00:00';
$librarysched[4][1]['closed'] = 0;
$librarysched[4][2]['start'] = '12:00:00';
$librarysched[4][2]['end'] = '20:00:00';
$librarysched[4][2]['closed'] = 0;
$librarysched[4][3]['start'] = '10:00:00';
$librarysched[4][3]['end'] = '18:00:00';
$librarysched[4][3]['closed'] = 0;
$librarysched[4][4]['start'] = '10:00:00';
$librarysched[4][4]['end'] = '18:00:00';
$librarysched[4][4]['closed'] = 0;
$librarysched[4][5]['start'] = '09:00:00';
$librarysched[4][5]['end'] = '17:00:00';
$librarysched[4][5]['closed'] = 0;
$librarysched[4][6]['start'] = '09:00:00';
$librarysched[4][6]['end'] = '17:00:00';
$librarysched[4][6]['closed'] = 0;
//Louisa
$librarysched[5][0]['start'] = '00:00:00';
$librarysched[5][0]['end'] = '00:00:00';
$librarysched[5][0]['closed'] = 1;
$librarysched[5][1]['start'] = '10:00:00';
$librarysched[5][1]['end'] = '19:00:00';
$librarysched[5][1]['closed'] = 0;
$librarysched[5][2]['start'] = '10:00:00';
$librarysched[5][2]['end'] = '19:00:00';
$librarysched[5][2]['closed'] = 0;
$librarysched[5][3]['start'] = '10:00:00';
$librarysched[5][3]['end'] = '18:00:00';
$librarysched[5][3]['closed'] = 0;
$librarysched[5][4]['start'] = '10:00:00';
$librarysched[5][4]['end'] = '18:00:00';
$librarysched[5][4]['closed'] = 0;
$librarysched[5][5]['start'] = '10:00:00';
$librarysched[5][5]['end'] = '17:00:00';
$librarysched[5][5]['closed'] = 0;
$librarysched[5][6]['start'] = '10:00:00';
$librarysched[5][6]['end'] = '17:00:00';
$librarysched[5][6]['closed'] = 0;
//Nelson
$librarysched[6][0]['start'] = '00:00:00';
$librarysched[6][0]['end'] = '00:00:00';
$librarysched[6][0]['closed'] = 1;
$librarysched[6][1]['start'] = '09:30:00';
$librarysched[6][1]['end'] = '19:00:00';
$librarysched[6][1]['closed'] = 0;
$librarysched[6][2]['start'] = '09:30:00';
$librarysched[6][2]['end'] = '19:00:00';
$librarysched[6][2]['closed'] = 0;
$librarysched[6][3]['start'] = '09:30:00';
$librarysched[6][3]['end'] = '17:00:00';
$librarysched[6][3]['closed'] = 0;
$librarysched[6][4]['start'] = '09:30:00';
$librarysched[6][4]['end'] = '17:00:00';
$librarysched[6][4]['closed'] = 0;
$librarysched[6][5]['start'] = '09:30:00';
$librarysched[6][5]['end'] = '17:00:00';
$librarysched[6][5]['closed'] = 0;
$librarysched[6][6]['start'] = '09:30:00';
$librarysched[6][6]['end'] = '16:00:00';
$librarysched[6][6]['closed'] = 0;
//Northside
$librarysched[7][0]['start'] = '00:00:00';
$librarysched[7][0]['end'] = '00:00:00';
$librarysched[7][0]['closed'] = 1;
$librarysched[7][1]['start'] = '10:00:00';
$librarysched[7][1]['end'] = '21:00:00';
$librarysched[7][1]['closed'] = 0;
$librarysched[7][2]['start'] = '10:00:00';
$librarysched[7][2]['end'] = '21:00:00';
$librarysched[7][2]['closed'] = 0;
$librarysched[7][3]['start'] = '10:00:00';
$librarysched[7][3]['end'] = '21:00:00';
$librarysched[7][3]['closed'] = 0;
$librarysched[7][4]['start'] = '10:00:00';
$librarysched[7][4]['end'] = '21:00:00';
$librarysched[7][4]['closed'] = 0;
$librarysched[7][5]['start'] = '10:00:00';
$librarysched[7][5]['end'] = '17:00:00';
$librarysched[7][5]['closed'] = 0;
$librarysched[7][6]['start'] = '10:00:00';
$librarysched[7][6]['end'] = '17:00:00';
$librarysched[7][6]['closed'] = 0;
//Scottsville
$librarysched[8][0]['start'] = '00:00:00';
$librarysched[8][0]['end'] = '00:00:00';
$librarysched[8][0]['closed'] = 1;
$librarysched[8][1]['start'] = '11:00:00';
$librarysched[8][1]['end'] = '19:00:00';
$librarysched[8][1]['closed'] = 0;
$librarysched[8][2]['start'] = '13:00:00';
$librarysched[8][2]['end'] = '21:00:00';
$librarysched[8][2]['closed'] = 0;
$librarysched[8][3]['start'] = '09:00:00';
$librarysched[8][3]['end'] = '19:00:00';
$librarysched[8][3]['closed'] = 0;
$librarysched[8][4]['start'] = '09:00:00';
$librarysched[8][4]['end'] = '19:00:00';
$librarysched[8][4]['closed'] = 0;
$librarysched[8][5]['start'] = '09:00:00';
$librarysched[8][5]['end'] = '17:00:00';
$librarysched[8][5]['closed'] = 0;
$librarysched[8][6]['start'] = '09:00:00';
$librarysched[8][6]['end'] = '17:00:00';
$librarysched[8][6]['closed'] = 0;


//Update database if user has changed semester dates 
//(looks like: Array ( [start] => 08/04/2012 [end] => 08/20/2012 [semester] => 4 [type] => update ) )
if ($_POST['type'] == "update"){
	//Validate content
	echo '<p style="color:red;">';
	if (newcheckdate($_POST['start']) != True) {
		echo "Please enter a valid start date.</p>";
	}
	elseif (newcheckdate($_POST['end']) != True) {
		echo "Please enter a valid end date.</p>";
	}
	elseif ((strtotime($_POST['start'])) >= (strtotime($_POST['end']))){
		echo "Please enter an end date that comes after the start date.</p>";
	}
	//If validation passed: process form
	else{
	$changequery = "update Semesters set DayStart = '" . sqldate($_POST['start']) . "', DayEnd = '" . sqldate($_POST['end']) . "' where SemID = " . $_POST['semester']; 
	$changeresult = mysqli_query($con,$changequery);
	if ($changeresult) {
		echo '<p style="color:#00CC00;">Semester dates have been updated.';
	}
	else{
		echo '<p style="color:red;">Semester dates have not been updated.</p>';
	}
	}
}
//Update database if user has added a semester
//Looks like: Array ( [season] => 1 [year] => 2012 [start] => 08/28/2012 [end] => 12/20/2012 ) 
if ($_POST['type'] == "new"){
	//Validate content
	echo '<p style="color:red;">';
	if (newcheckdate($_POST['start']) != True) {
		echo "Please enter a valid start date.</p>";
		print_r($_POST);
	}
	elseif (newcheckdate($_POST['end']) != True) {
		echo "Please enter a valid end date.</p>";
	}
	elseif ((strtotime($_POST['start'])) >= (strtotime($_POST['end']))){
		echo "Please enter an end date that comes after the start date.</p>";
	}
	elseif (date('Y', strtotime("1/1/" . $_POST['year'])) != $_POST['year']){
		echo "Please enter a valid year.</p>";
	}
	//If validation passed: process form
	else{
		$newquery = "insert into Semesters (SemID, SemYear, SeasonID, DayStart, DayEnd) values (NULL, " . $_POST['year'] . ', ' . $_POST['season'] . ', "' . sqldate($_POST['start']) . '", "' . sqldate($_POST['end']) . '")';
		$newresult = mysqli_query($con,$newquery);
		if ($newresult) {
			echo '<p style="color:#00CC00;">New semester has been added.</p>';
			$libraries = array(1,2,3,4,5,6,7,8);
			$days = array(0,1,2,3,4,5,6);
			$semidquery = "select SemID from Semesters where SemYear = " . $_POST['year'] . " and SeasonID = " . $_POST['season'];
			$semidresult = mysqli_query($con,$semidquery);
			$semid = mysqli_fetch_row($semidresult);
			$success = 0;
			foreach ($libraries as $library){
				foreach ($days as $day) {
					$schedquery = 'insert into Schedule (SchedID, LibID, SemID, Day, OpenTime, CloseTime, Closed, Appointment, Open24) values (NULL, ' . $library . ', ' . $semid[0] . ', ' . $day . ', "' . $librarysched[$library][$day]['start'] . '", "' . $librarysched[$library][$day]['end'] . '", ' . $librarysched[$library][$day]['closed'] . ', 0, 0)';
					$schedresult = mysqli_query($con,$schedquery);
					if ($schedresult){
						$success = 1;
					}
					else {
						$success = 0;
					}
				}
			}
			if ($success == 1) {
				echo '<p style="color:#00CC00;">Default schedule successfully added.</p>';
			}
			else {
				'<p style="color:red;">Default schedule creation failed.</p>';
			}
		}
		else {
			echo '<p style="color:red;">New semester has not been added.  Check to see if semester already exists.</p>';
		}
	}
}
//Delete a semester from the database (Doesn't need validation)
if ($_POST['type'] == "delete") {
	$deletequery = "delete from Semesters where SemID = " . $_POST['semester'];
	$deleterelatedquery = "delete from Schedule where SemID = " . $_POST['semester'];
	$deleteresults = mysqli_query($con,$deletequery);
	if  ($deleteresults) {
		echo '<p style="color:#00CC00;">Semester deleted</p>';
		$deleterelatedresults = mysqli_query($con,$deleterelatedquery);
		if ($deleterelatedresults) {
			echo '<p style="color:#00CC00;">Related schedules successfully removed.</p>';
		}
		else {
			echo '<p style="color:red;">Unable to remove all related records.</p>';
		}
	}
	else {
		echo '<p style="color:red;">Unable to delete selected semester</p>';
	}
}
//Add category to Seasons table (doesn't need validation)
if ($_POST['type'] == "addseason"){
	$seasonquery = 'insert into Season (SeasonID, SeasonName) values (NULL, "' . $_POST['season'] . '")';
	$seasonresult = mysqli_query($con,$seasonquery);
	if ($seasonresult) {
		echo '<p style="color:#00CC00;">New category has been added.</p>';
	}
	else {
		echo '<p style="color:red;">New category has not been added.  Check to see if semester already exists.</p>';
	}
}
//Delete category from Seasons table (doesn't need validation)
if ($_POST['type'] == "deleteseason"){
	$delseasonquery = 'delete from Season where SeasonID = ' . $_POST['season'];
	$delseasonresult = mysqli_query($con,$delseasonquery);
	if ($delseasonresult) {
		echo '<p style="color:#00CC00;">Category Deleted.  Note: Semesters in this category have <b>NOT</b> been deleted.</p>';
	}
	else {
		echo '<p style="color:red;">Unable to delete category.</p>';
		echo $delseasonquery;
	}
}	
//Get semester names and semester IDs.  
$semnamequery = "select SeasonName, SeasonID from Season order by SeasonID";
$semnamequery = "select SeasonName, SeasonID from Season order by SeasonID";
$semnameresult = mysqli_query($con,$semnamequery);
while ($row = mysqli_fetch_array($semnameresult)) { 
		$semnames[] = array($row['SeasonName'], $row['SeasonID']);}
//Put semester date range information into array
$semdatequery = "select SeasonID, SemYear, DayStart, DayEnd, SemID from Semesters order by SemYear, SeasonID";
$semdateresult = mysqli_query($con,$semdatequery);
while ($row = mysqli_fetch_array($semdateresult)) {
	$semdates[] = array($row['SeasonID'], $row['SemYear'], $row['DayStart'], $row['DayEnd'], $row['SemID']);}
//For each semester, get semester dates
echo '<table width=100%>';
//Set table row class
$class = "b";
foreach ($semdates as $semester){
	//Form to change semester dates
	//Match SeasonName to SeasonID
	$season = NULL;
	foreach ($semnames as $name) {
		if ($name[1] == $semester[0]){
			$season = $name[0];
		}
	}
	echo '<tr class="header"><td>' . $season . " "  . $semester[1] . ': </td><td></td><td></td><td></td><td></td></tr>';
	echo '<tr class="' . $class . '"><td></td><td><form action="semesters.php" method="post"><input name="start" type="text" size="10" maxlength="10" id="' . $semester[4] . 'start" Value="' . usdate($semester[2]) . '" />&nbsp; -  &nbsp;</td>';
	echo '<td><input name="end" type="text" size="10" maxlength="10" id="' . $semester[4] . 'end" Value="' . usdate($semester[3]) . '"/><input name="semester" value ="' . $semester[4] . '" type="hidden"/><input name="type" value ="update" type="hidden"/></p></td>';
	echo '<td><input type="submit" value="Update dates"/></form></td>'; 
	//Form to delete a semester
	echo '<td><form action="semesters.php" method="post"><input type="hidden" name="semester" value="' . $semester[4] . '"><input type="hidden" name="type" value="delete"/>';
	echo '<input type="submit" value="Delete semester" onclick="return makesure(';
	echo "'Are you sure you want to delete this semester?  All related schedule information will also be deleted.'";
	echo ');"/></form></td></tr>';
}
echo '</table>';
echo '<br/><br/>';
echo '<table width=100%><tr class="header"><td>Add new semester*</td></tr>';
//Form to add a new semester
echo '<table width=100%><tr class="b"><td><form action="semesters.php" method="post"><select name="season">';
foreach ($semnames as $name){
	echo '<option value="' . $name[1] . '">' . $name[0] . '</option>';
	}
echo '</select></td>';
echo '<td>Year: <input name="year" size="10" maxlength="4" Value="' . date('Y') . '"/></td>';
echo '<td>Start Date: <input name="start" size="10" maxlength="10" id="newstart" /></td>';
echo '<td>End Date: <input name="end" size="10" maxlength="10" id="newend" /></td>';
echo '<td><input type="submit" value="Add semester"/><input type="hidden" name="type" value="new"/></form></td></tr></table>';
//Form to add a category
echo '<table width=100%><tr class="header"><td>Add a new category (eg. Spring Break)</td><td></td></tr>';
echo '<tr class="b"><td><form action="semesters.php" method="post"><input type="hidden" name="type" value="addseason"/><input name="season" type="text" size="30" maxlength="30"/></td><td><input type="submit" value="Add category"/></td></tr></form></table>';
//Form to delete a category
echo '<table width=100%><tr class="header"><td>Delete a category</td></tr>';
echo '<table width=100%><tr class="b"><td><form action="semesters.php" method="post"><select name="season">';
foreach ($semnames as $name){
	echo '<option value="' . $name[1] . '">' . $name[0] . '</option>';
	}
echo '</select></td><td><input type="hidden" name="type" value="deleteseason"/><input type="submit" value="Delete Category" onclick="return makesure(';
echo "'Are you sure you want to delete this category? Semester dates already entered in this category will not be deleted and must be removed separately.'";
echo ');"/></form></td></tr></table>';
?>
<p><a href="hoursmenu.php">Return to Main Menu</a></p>
<p>* The hours utility will determine which semester a given date belongs to based on the start date of the semester.  For example, if the Spring Semester starts on 1/17/2012 and ends on 5/07/2012, but the First Summer Intersession starts on 5/05/2012, 5/06/2012 will be counted as part of the First Summer Intersession.


