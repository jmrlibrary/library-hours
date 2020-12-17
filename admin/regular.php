<head>
<?php include('config.php');?>
<title><?=librarysystemname?> Hours Tool--Regular Hours</title>
<link type="text/css" href="css/hoursadmin.css" rel="stylesheet" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
	window.onload = function(){
	var startfields = document.getElementsByClassName("start");
	var endfields = document.getElementsByClassName("end");
	for (var i = 0; i < startfields.length; i++)
	{
		var startfield = startfields[i].id;
		$( "#" + startfield ).timepicker({
			ampm: true,
			stepMinute: 10,
			timeFormat: 'h:mm tt',
			showOn: "button",
			buttonImage: "css/smoothness/images/clock.gif",
			buttonImageOnly: true
		});
	};
	for (var i = 0; i < startfields.length; i++)
	{
		var endfield = endfields[i].id;
		$( "#" + endfield ).timepicker({
			ampm: true,
			stepMinute: 10,
			timeFormat: 'h:mm tt',
			showOn: "button",
			buttonImage: "css/smoothness/images/clock.gif",
			buttonImageOnly: true
		});
	}
	};
</script>
<!--To keep people from selecting more than one checkbox.  Borrowed code from here: http://blog.schuager.com/2008/09/mutually-exclusive-checkboxes-with.html-->
      <script type="text/javascript" language="javascript">
          function mutuallyexclusive($classname) {
              $('.mutuallyexclusive' + $classname).click(function () {
                  checkedState = $(this).attr('checked');
                  $('.mutuallyexclusive' + $classname + ':checked').each(function () {
                      $(this).attr('checked', false);
                  });
                  $(this).attr('checked', checkedState);
              });
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
function formattime($sqltime) {
	return date("g:i a", strtotime(stripslashes($sqltime)));
	}
function sqltime($time) {
	return date("H:i:s", strtotime($time));
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
function newchecktime($data) {
    if (date('g:i a', strtotime($data)) == $data or date('g:i A', strtotime($data)) == $data or date('h:i a', strtotime($data)) == $data or date('h:i A', strtotime($data)) == $data) {
        return true;
    }
	elseif (date('G:i', strtotime($data)) == $data or date('H:i', strtotime($data)) == $data or date('G', strtotime($data)) == $data or date('H', strtotime($data)) == $data or date('g', strtotime($data)) == $data or date('h', strtotime($data)) == $data){
        return true;
    }	
	else {
        return false;
    }
}
//If user didn't come from hoursmenu.php, make them choose a semester to edit
if  ($_POST == NULL) {
	echo '<b>Please choose a semester to edit</b>';
	//Get semesters
	$semesterquery = "select SemID, SemYear, SeasonID from Semesters order by SemYear, SeasonID";
	$semesterresult = mysqli_query($con,$semesterquery);
	//Get semester names
	while ($row = mysqli_fetch_array($semesterresult)) {
		$semnamequery = "select SeasonName, SeasonID from Season where SeasonID = " . $row['SeasonID'];
		$semnameresult = mysqli_query($con,$semnamequery);
		$seasonrow = mysqli_fetch_row($semnameresult);
		$semesters[] = array($row['SemID'], $row['SemYear'], $seasonrow[0]);}
	//Count number of semnames and then loop through each for the dropdown menu.
	$num_semesterresults = mysqli_num_rows($semesterresult);
	echo '<ul style="list-style:square;"><li><form action="regular.php" method=post>Set regular hours for &nbsp;<select name="season">';
	for ($i = 0; $i < $num_semesterresults; $i++){
		echo '<option value="' . $semesters[$i][0] . "+" . $semesters[$i][1] . "+" . $semesters[$i][2] . '">' . $semesters[$i][2] . " " . $semesters[$i][1] . '</option>';}
	echo '</select><input type=submit value="Go!"></input></form></li></ul>';
	}
else {
	//Get semester information from POST
	$semester = explode('+', $_POST['season']);
	$daynames = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	//Update database if schedule has been changed
	if ($_POST['library'] != NULL) {
		$libquery = "select Libname from Libraries where LibID = " . $_POST['library'];
		$libresult = mysqli_query($con,$libquery);
		$libname = mysqli_fetch_row($libresult);
		$success = NULL;
		$failure = NULL;
		for ($i=0; $i < 7; $i++) {
			//Validate content
			echo '<p style="color:red;">';
			if (newchecktime($_POST['start:' . $i]) != True) {
				echo "Please enter a valid opening time for " . $daynames[$i] . " for " . $libname[0] . ".</p>";
				$failure = 1;
			}
			elseif (newchecktime($_POST['end:' . $i]) != True) {
				echo "Please enter a valid closing time for " . $daynames[$i] . " for " . $libname[0] . ".</p>";
				$failure = 1;
			}
			elseif ((strtotime($_POST['start:' . $i])) > (strtotime($_POST['end:' . $i]))){
				echo "Please enter an opening time that is earlier than the closing time for " . $daynames[$i] . " for " . $libname[0] . ".</p>";
				$failure = 1;
			}
			//If validation passed: process form
			else{
				if ($_POST['status:' . $i] == "Closed") {$closed = ", Closed = 1";}
				else {$closed = ", Closed = 0";}
				if ($_POST['status:' . $i] == "Appointment") {$app = ", Appointment = 1";}
				else {$app = ", Appointment = 0";}
				if ($_POST['status:' . $i] == "Open24") {$open24 = ", Open24 = 1";}
				else {$open24 = ", Open24 = 0";}
				if ($_POST['notes:' . $i]) {
					$strippednotes = strip_tags(urldecode($_POST['notes:' . $i]),"<br><i><a><b>");
					$notes = ", Notes = '" . mysqli_real_escape_string($con, $strippednotes) . "'";
				} else {
					$notes = ", Notes = NULL";
				}
				$status = $closed . $app . $open24 . $notes;
				$schedupdatequery = 'update Schedule set OpenTime = "' . sqltime($_POST['start:' . $i]) . '", CloseTime = "' . sqltime($_POST['end:' . $i]) . '"' . $status . ' where SemID = ' . $semester[0] . ' and Day = ' . $i . ' and LibID = ' . $_POST['library'];
				$schedupdateresult = mysqli_query($con,$schedupdatequery);
				if ($schedupdateresult) {
					if ($failure != 1) {
						$success = 1;}}
				else {$failure = 1;}
			}
		}
		if ($success == 1 and failure != 1) {
			echo '<p style="color:#00CC00;">Semester schedule has been updated for ' . $libname[0] . '.</p>';}
		else {echo '<p style="color:red;">Schedule update could not complete.  Not all changes have been saved.</p>';}
	}
	$libraries = locationsarray;
	$days = array(0,1,2,3,4,5,6);
	//For each library
	$class = "a";
	foreach ($libraries as $library) {
		//Print semester and library names
		$libquery = "select Libname  from Libraries where LibID = " . $library;
		$libresult = mysqli_query($con,$libquery);
		$libname = mysqli_fetch_row($libresult);
		echo '<table width=100%><tr class="header"><td>' . $libname[0] . "--" . $semester[2] . " " . $semester[1] . ' Hours</td></tr></table><table width=100%>';
		//Get schedule information
		echo '<form name="weekschedule" method="post" action="regular.php">';
		foreach ($days as $day) {
			//Flip table class
			if ($class == 'a'){$class = 'b';}
			else {$class = 'a';}
			$schedquery = "select Day, OpenTime, CloseTime, Closed, Appointment, Open24, LibID, Day, SemID, Notes from Schedule where LibID = " . $library . " and Day = " . $day . " and SemID = " . $semester[0];
			//echo "<script>console.log('" . $schedquery . "');</script>";
			$schedresult = mysqli_query($con,$schedquery);
			$schedule = mysqli_fetch_array($schedresult);
			echo "<tr class=" . $class . "><td><i><b>" . $daynames[$day] . '</b></i></td>';
			echo '<td><input class="start" name="start:' . $day . '" id="start' . $library . $day . '" type="text" size="10" value="' . formattime($schedule['OpenTime']) . '"></td>';
			echo '<td><input class="end" name="end:' . $day . '" id="end' . $library . $day . '" type="text" size="10" value="' . formattime($schedule['CloseTime']) . '"></td>';
			if ($schedule['Closed'] == 1) {$checked = 'checked';}
			else {$checked = NULL;}
			echo '<td><input name="status:' . $day . '" onclick="mutuallyexclusive(\'' . $day . $library . '\')" class="mutuallyexclusive' . $day . $library . '" id="closed' . $library . $day . '" type="checkbox" value="Closed" ' . $checked . '>Closed</td>';
			if ($schedule['Appointment'] == 1) {$checked = 'checked';}
			else {$checked = NULL;}
			echo '<td><input name="status:' . $day . '" onclick="mutuallyexclusive(\'' . $day . $library . '\')" class="mutuallyexclusive' . $day . $library . '" id="appointment' . $library . $day . '" type="checkbox" value="Appointment" ' . $checked . '>By appointment</td>';
			if ($schedule['Open24'] == 1) {$checked = 'checked';}
			else {$checked = NULL;}
			echo '<td><input name="status:' . $day . '" onclick="mutuallyexclusive(\'' . $day . $library . '\')" class="mutuallyexclusive' . $day . $library . '" id="open24' . $library . $day . '" type="checkbox" value="Open24" ' . $checked . '>Open 24 hours</td>';
			echo '<td>Notes: <input name="notes:' . $day . '" id="notes' . $library . $day . '" type="text" maxlength="50" size="30" value="' . $schedule['Notes'] . '"></td></tr>';
		}
		echo '<tr><td></td><td></td><td></td><td></td><td></td><td><input type="hidden" name="library" value="' . $library . '"><input type="hidden" name="season" value ="' . $_POST['season'] . '"><input type="submit" value="Go!"></form></td></tr>';
		echo '</table>';
	}
}
?>
<p><a href="hoursmenu.php">Return to Main Menu</a></p>