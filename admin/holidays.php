<head>
<?php include('config.php');?>
<title><?=librarysystemname?> Hours Tool--Holidays and Special Hours</title>
<link type="text/css" href="css/hoursadmin.css" rel="stylesheet" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
	window.onload = function(){
	if (typeof document.getElementsByClassName == 'function') {
	var datefields = document.getElementsByClassName("date");
	for (var i = 0; i < datefields.length; i++)
	{
		var datefield = datefields[i].id;
		$( "#" + datefield ).datepicker({
			showOn: "button",
			buttonImage: "css/smoothness/images/calendar.jpg",
			buttonImageOnly: true
		});
	};
	var timefields = document.getElementsByClassName("time");
	for (var i = 0; i < timefields.length; i++)
	{
		var timefield = timefields[i].id;
		$( "#" + timefield ).timepicker({
			ampm: true,
			stepMinute: 1,
			timeFormat: 'h:mm tt',
			showOn: "button",
			buttonImage: "css/smoothness/images/clock.gif",
			buttonImageOnly: true
		});
	};
	}else {
	alert("You are using a browser that is minimally supported.  Please update to IE9 or higher or use Firefox or Chrome.");
	}
	}
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
<!--If 'All libraries are closed' is checked, do not show individual libraries-->
<script type="text/javascript" language="javascript">
	function hidelibraries($key) {
		for (var i = 1; i < 11; i++) {
			document.getElementById('inconstant' + $key + i).style.display = 'none';
		}
	}
	function showlibraries($key) {
		for (var i = 1; i < 11; i++) {
			document.getElementById('inconstant' + $key + i).style.display = 'table-row';
		}
	}
	function pickdiv($holiday) {
	/*getElementsByClassName for IE8 borrowed from http://www.webdeveloper.com/forum/showthread.php?t=197541 */
		if (typeof document.getElementsByClassName != 'function') {
		document.getElementsByClassName = function() {
			var elms = document.getElementsByTagName('*');
			var ei = new Array();
			for (i=0;i<elms.length;i++) {
				if (elms[i].getAttribute('class')) {
					if (typeof elms[i].getAttribute('class')=='string') {
						ecl = elms[i].getAttribute('class').split(' ');
						for (j=0;j<ecl.length;j++) {
							if (ecl[j].toLowerCase() == arguments[0].toLowerCase()) {
								ei.push(elms[i]);
							}
						}
					}
				} else if (elms[i].className) {
					if (typeof elms[i].className=='string') {
						ecl = elms[i].className.split(' ');
						for (j=0;j<ecl.length;j++) {
							if (ecl[j].toLowerCase() == arguments[0].toLowerCase()) {
								ei.push(elms[i]);
							}
						}
					}
				}
			}
			return ei;
		}
		}
		var holdivs = document.getElementsByClassName('holdiv');
		for (var i = 0; i < holdivs.length; i++)
		{
			var holdiv = holdivs[i].id;
			document.getElementById(holdiv).style.display = 'none';
		}
		document.getElementById('div:' + $holiday).style.display = 'block';
	}
</script>
<!--If 'Regular hours' is checked, do not opening and closing times-->
<script type="text/javascript" language="javascript">
	function hidehours($key) {
		for (var i = 1; i < 3; i++) {
			document.getElementById('special' + i + $key).style.display = 'none';
		}
	}
	function showhours($key) {
		for (var i = 1; i < 3; i++) {
			document.getElementById('special' + i + $key).style.display = 'table-cell';
		}
	}
</script>
<!-- Javascript "Are you sure?" script for deleting things -->
<script type="text/javascript" language="javascript">
 function makesure($message) {
  if (confirm($message)) {
    return true;
  }
  else {
    return false;
  }
 }
</script>
</head>
<body>
<br/>
<div style="background-color:white; margin-left:5%; margin-right:5%;height:100%">
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
	if ($sqltime != NULL) {
		return date("g:i a", strtotime(stripslashes($sqltime)));
	}
	else {
		return NULL;
		}
	}
function sqltime($time) {
	if ($time != NULL) {
		return '"' . date("H:i:s", strtotime($time)) . '"';
	}
	else {
		return "NULL";
	}
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
//Put all Library IDs and names into an array.
$alllibs = alllibs;
//Process input
//New holiday:
if ($_POST['oldholdate'] == 'new') {
	$holidayname = stripslashes($_POST['newname']);
	$holidaydate = $_POST['newdate'];
	$failure = 0;
	//Validate data
	echo '<p style="color:red;">';
	//Get regular vs special status for each library.  If all are regular, don't allow holiday to be added.
	$speciallibs = NULL;
	foreach ($alllibs as $library) {
		if ($_POST['closedorset:new'] == 'closed') {
			$speciallibs = 1;
			}
		if ($_POST['regularorspecial:new:' . $library[0]] == 'special') {
			$speciallibs = 1;
		}
	}
	//Verify information for each library
	$badtime = NULL;
	if ($_POST['closedorset:new'] == 'sethours') {
		foreach ($alllibs as $library) {
			if (($_POST['regularorspecial:new:' . $library[0]] == 'special') and ($_POST['closedor24:new:' . $library[0]] == NULL)) {
				if (newchecktime($_POST['starttime:new:' . $library[0]]) != True) {
					echo "Please enter a valid opening time for " . $library[1] . ". ";
					$badtime = 1;
				}
				elseif (newchecktime($_POST['endtime:new:' . $library[0]]) != True) {
					echo "Please enter a valid closing time " . $library[1] . ". ";
					$badtime = 1;
				}
				elseif ((strtotime($_POST['starttime:new:' . $library[0]])) > (strtotime($_POST['endtime:new:' . $library[0]]))){
					echo '<span style="color:#FBB917;">You have entered a closing time that is earlier than the opening time for ' . $library[1] . '. Please check to make sure that this was not a mistake.</span>';
				}
			}
		}
	}
	if ($speciallibs != 1) {
		echo "Please set special hours for at least one library or the holiday cannot be added.";
		}
	elseif ($_POST['newdate'] == NULL) {
		echo 'Please enter a date for the new holiday.';
		}
	elseif ($badtime == 1) {
		echo '  Press the back button and check that all entered times are valid before resubmitting.';
	}
	else {
	if ($_POST['closedorset:new'] == 'closed') {
		foreach ($alllibs as $library) {
			$addallclosedquery = 'INSERT INTO Special (SpecialID, HolName, LibID, SpecialDate, OpenTime, CloseTime, Closed, Appointment, Open24) VALUES (NULL, "' . addslashes($holidayname) . '", ' . $library[0] . ', "' . sqldate($holidaydate) . '", NULL, NULL, 1, 0, 0)';
			$addallclosedresult = mysqli_query($con, $addallclosedquery);
			if ($addallclosedresult) {
				$successes[] = $library[1];
			}
			else {
				echo '<p style="color:red;"> ' . $holidayname . ' could not be added for ' . $library[1] . '. ';
				$failure = 1;
			}
		}	
		if ($failure != 1) {
			echo '<p style="color:#00CC00;"> ' . $holidayname . ' successfully added for ';
			foreach ($successes as $success) {
				echo $success . ', ';
			}
		}
	}
	else {
		//Check and see if it's already in the database:
		$checkholquery = 'Select SpecialID from Special where SpecialDate = "' . sqldate($holidaydate) . '"';
		$checkholresult = mysqli_query($con, $checkholquery);
		if (mysqli_fetch_row($checkholresult) != NULL) {
			echo '<p style="color:red;"> A holiday on this date already exists.  Please select it from the menu to the right to edit it.';
			}
		else {
			foreach ($alllibs as $library) {
				$closed = 0;
				$app = 0;
				$open24 = 0;
				$holidayexists = 0;
				if ($_POST['regularorspecial:new:' . $library[0]] == special) {
					//Check and see if the library's closed/by appointment/open 24
					if ($_POST['closedor24:new:' . $library[0]] == 'Closed') {
						$closed = 1;
						}
					elseif ($_POST['closedor24:new:' . $library[0]] == 'Appointment') {
						$app = 1;
						}
					elseif ($_POST['closedor24:new:' . $library[0]] == 'Open24') {
						$open24 = 1;
						}
					//Don't add it if it already exists in any libraries.
					$addholquery = 'INSERT INTO Special (SpecialID, HolName, LibID, SpecialDate, OpenTime, CloseTime, Closed, Appointment, Open24) VALUES (NULL, "' . addslashes($holidayname) . '", ' . $library[0] . ', "' . sqldate($holidaydate) . '", ' . sqltime($_POST['starttime:new:' . $library[0]]) . ', ' . sqltime($_POST['endtime:new:' . $library[0]]) . ', ' . $closed . ', ' . $app . ', ' . $open24 . ')';
					$addholresult = mysqli_query($con, $addholquery);
					if ($addholresult) {
						$successes[] = $library[1];
					}
					else {
						echo '<p style="color:red;"> ' . $holidayname . ' could not be added for ' . $library[1] . '. ';
						$failure = 1;
					}
		}
		}
		if ($failure != 1) {
			echo '<p style="color:#00CC00;"> ' . $holidayname . ' successfully added for ';
			foreach ($successes as $success) {
				echo $success . ', ';
			}
		}
		}
	}
	}
}
//Update database for changes to existing holidays
elseif ($_POST['oldholdate'] != NULL) {
	$holidayname = stripslashes($_POST['oldholname']);
	$olddate = $_POST['oldholdate'];
	$newdate = $_POST['holdate:' . $olddate];
	//Validate data
	echo '<p style="color:red;">';
	//Get regular vs special status for each library.  If all are regular, don't allow holiday to be added.
	$speciallibs = NULL;
	foreach ($alllibs as $library) {
		if ($_POST['closedorset:' . $olddate . ':' . $library[0]] == 'closed') {
			$speciallibs = 1;
			}
		if ($_POST['regularorspecial:' . $olddate . ':' . $library[0]] == 'special') {
			$speciallibs = 1;
		}
	}
	//Verify information for each library
	$badtime = NULL;
	if ($_POST['closedorset:' . $olddate] == 'sethours') {
		foreach ($alllibs as $library) {
			if (($_POST['regularorspecial:' . $olddate . ':' . $library[0]] == 'special') and ($_POST['closedor24:' . $olddate . ':' . $library[0]] == NULL)) {
				if (newchecktime($_POST['starttime:' . $olddate . ':' . $library[0]]) != True) {
					echo " Please enter a valid opening time for " . $library[1] . ". ";
					$badtime = 1;
				}
				elseif (newchecktime($_POST['endtime:' . $olddate . ':' . $library[0]]) != True) {
					echo " Please enter a valid closing time " . $library[1] . ". ";
					$badtime = 1;
				}
				elseif ((strtotime($_POST['starttime:' . $olddate . ':' . $library[0]])) > (strtotime($_POST['endtime:' . $olddate . ':' . $library[0]]))){
					echo '<span style="color:#FBB917;">You have entered a closing time that is earlier than the opening time for ' . $library[1] . '. Please check to make sure that this was not a mistake.</span>';
				}
			}
		}
	}
	if ($speciallibs != 1) {
		echo "Please set special hours for at least one library.  If you are trying to remove this holiday, please click on the 'Delete holiday' button.";
		}
	elseif ($newdate == NULL) {
		echo 'Please enter a date for the holiday.';
		}
	elseif ($badtime == 1) {
		echo '  Press the back button and check that all entered times are valid before resubmitting.';
	}
	else {
	if ($_POST['closedorset:' . $olddate] == 'closed') {
		$failed = 0;
		$succeeded = 0;
		//Need to check if each library has record for this date.
		$successes = NULL;
		$failures = NULL;
		foreach ($alllibs as $library) {
			//Check and see if it's already in the database:
			$checkholquery = 'Select SpecialID from Special where SpecialDate = "' . sqldate($olddate) . '" and LibID = ' . $library[0];
			$checkholresult = mysqli_query($con, $checkholquery);	
			$specialID = mysqli_fetch_row($checkholresult);
			if ($specialID[0] != NULL) {
			$updateallclosedquery = 'UPDATE Special SET SpecialDate = "' . sqldate($newdate) . '", OpenTime = NULL, CloseTime = NULL, Closed = 1, Appointment = 0, Open24 = 0 where SpecialID = ' . $specialID[0];
			}
			else {
			$updateallclosedquery = 'Insert into Special (LibID, HolName, SpecialDate, Closed, Appointment, Open24, OpenTime, CloseTime) values (' . $library[0] . ', "' . addslashes($holidayname) . '", "' . sqldate($newdate) . '", 1, 0, 0, NULL, NULL)';
			}
			$updateallclosedresult = mysqli_query($con, $updateallclosedquery);
			if ($updateallclosedresult) {
				$successes[] = $library[1];
				$succeeded = 1;				
			}
			else {
				$failures[] = $library[1];
				$failed = 1;
			}
		}	
		if ($succeeded == 1) {
			echo '<p style="color:#00CC00;"> ' . $holidayname . ' successfully modified for ';
			foreach ($successes as $success) {
				echo $success . ', ';
			}
		}
		if ($failed == 1) {
			echo '<p style="color:red;"> ' . $holidayname . ' update failed for ';
			foreach ($failures as $failure) {
				echo $failure . ', ';
			}
		}
	}
	else {
		$successes = NULL;
		$failures = NULL;
		$nochange = NULL;
		$failed = 0;
		$succeeded = 0;
		foreach ($alllibs as $library) {
			$closed = 0;
			$app = 0;
			$open24 = 0;
			if ($_POST['regularorspecial:' . $olddate . ':' . $library[0]] == special) {
				//Check and see if it's already in the database:
				$checkholquery = 'Select SpecialID from Special where SpecialDate = "' . sqldate($olddate) . '" and LibID = ' . $library[0];
				$checkholresult = mysqli_query($con, $checkholquery);	
				$specialID = mysqli_fetch_row($checkholresult);
				//Check and see if the library's closed/by appointment/open 24
				if ($_POST['closedor24:' . sqldate($olddate) . ':' . $library[0]] == 'Closed') {
					$closed = 1;
					}
				elseif ($_POST['closedor24:' . sqldate($olddate) . ':' . $library[0]] == 'Appointment') {
					$app = 1;
					}
				elseif ($_POST['closedor24:' . sqldate($olddate) . ':' . $library[0]] == 'Open24') {
					$open24 = 1;
					}
				//Update the record if the holiday's already in the database for this library
				echo '<p style="color:#00CC00">';
				if ($specialID[0] != NULL) {	
					$updateholquery = 'Update Special set SpecialDate = "' . sqldate($newdate) . '", OpenTime = ' . sqltime($_POST['starttime:' . $olddate . ':' . $library[0]]) . ', CloseTime = ' . sqltime($_POST['endtime:' . $olddate . ':' . $library[0]]) . ', Closed = ' . $closed . ', Appointment = ' . $app . ', Open24 = ' . $open24 . ' where SpecialID = ' . $specialID[0];
					$updateholresult = mysqli_query($con, $updateholquery);
					if ($updateholresult) {
						$successes[] = $library[1];
						$succeeded = 1;	
					}
				}
				//Else add it
				else {
					$addholquery = 'Insert into Special (LibID, HolName, SpecialDate, OpenTime, CloseTime, Closed, Appointment, Open24) values (' . $library[0] . ', "' . addslashes($holidayname) . '", "' . sqldate($newdate) . '", ' . sqltime($_POST['starttime:' . $olddate . ':' . $library[0]]) . ', ' . sqltime($_POST['endtime:' . $olddate . ':' . $library[0]]) . ', ' . $closed . ', ' . $app . ', ' . $open24 . ')';
					$addholresult = mysqli_query($con, $addholquery);
					if ($addholresult) {
						$successes[] = $library[1];
						$succeeded = 1;	
					}
				}
			}
			else {
				//Check and see if special hours exist for this library on this day and delete the record if they do.
				$checkholquery = 'Select SpecialID from Special where SpecialDate = "' . sqldate($olddate) . '" and LibID = ' . $library[0];
				$checkholresult = mysqli_query($con, $checkholquery);		
				$specialID = mysqli_fetch_row($checkholresult);
				if ($specialID != NULL) {
					$deleteholquery = 'Delete from Special where SpecialID = ' . $specialID[0];
					$deleteholresult = mysqli_query($con, $deleteholquery);
					if ($deleteholresult) {
						$successes[] = $library[1];
						$succeeded = 1;	
					}
					else {
						$failures[] = $library[1];
						$failed = 1;
						}
				}
				else {
					$successes[] = $library[1];
					$succeeded = 1;	
					}
			}
		}
		if ($succeeded == 1) {
			echo '<p style="color:#00CC00;"> ' . $holidayname . ' successfully modified for ';
			foreach ($successes as $success) {
				echo $success . ', ';
			}
		}
		if ($failure == 1) {
			echo '<p style="color:red;"> ' . $holidayname . ' update failed for ';
			foreach ($failures as $failure) {
				echo $failure . ', ';
			}
		}
	}
}
}
//Process holiday deletion
elseif ($_POST['deleteholiday'] != NULL) {
	$deletedate = $_POST['deleteholiday'];
	$deletequery = 'Delete from Special where SpecialDate = "' . sqldate($deletedate) . '"';
	$deleteresult = mysqli_query($con, $deletequery);
	if ($deleteresult) {
		echo '<p style="color:#00CC00;">Holiday successfully deleted for all libraries.</p>';
	}
	else {
		echo '<p style="color:red;">The holiday could not be deleted.</p>';
	}
}
//Get Holidays
$holidaynamequery = "select distinct HolName, SpecialDate from Special order by SpecialDate";
$holidaynameresult = mysqli_query($con, $holidaynamequery);
while ($row = mysqli_fetch_array($holidaynameresult)) {
	$holidays[] = array(stripslashes($row['HolName']), $row['SpecialDate']);}
//Right side menu bar
echo '<br/><div class="col2" style="padding:5px;background-color: #f9f9f9;width:23%;border:1px solid grey;">';
echo '<a onclick="javascript:;pickdiv(\'new\');"><b>Add a New Holiday</b></a>';
echo '<br/><br/>Existing holidays:<ul>';
foreach ($holidays as $holiday) {
	echo '<li><a  onclick="javascript:;pickdiv(\'' . $holiday[1] . '\');" ><b>' . $holiday[0] . '</b> - ' . usdate($holiday[1]) . '</a></li>';
	}
echo '</ul>';
echo '</div>';
echo '<div class="col1" style="padding:5px;background-color:#ffffff;width:73%">';
//Div for adding a new holiday
echo '<div class="holdiv" id="div:new" style="display:block;">';
echo '<H3>Add a new Holiday</H3>';
echo '<table style="width:100%;"><tr style="background-color:#f9f9f9;"><form name="newholiday" method="post" action="holidays.php"><td style="padding:10px;width:25%;"><input type="hidden" name="oldholdate" value="new">Name: <input type="text" name="newname" size="20"/></td><td>Date: <input type="text" name="newdate" class="date" id="newdateid"/></td>';
echo '<td><input class="closedorset" type="radio" id="newallclosed" name="closedorset:new" value="closed" onclick="javascript:;hidelibraries(\'new\');" checked/>';
echo '<label for="newallclosed">All libraries are closed</label><br/><input class="closedorset" id="newset" type="radio" name="closedorset:new" value="sethours" onclick="javascript:;showlibraries(\'new\');"';
echo '/><label for="newset">Set hours for each library</label><br/></td><td></td></tr>';
//Only display if "Set hours" is checked:
	$class = 'a';
	foreach ($alllibs as $library) {
		//Flip table class
		if ($class == 'a'){$class = 'b';}
		else {$class = 'a';}
		echo '<tr class="' . $class . '" id="inconstantnew' . $library[0] .'" style="display:none;"><td><i><b>' . $library[1] . '</b></i></td>';
		echo '<td><input type="radio" id="newregular' . $library[0] . '" onclick="javascript:;hidehours(\'new' . $library[0] . '\');" name="regularorspecial:new:' . $library[0] . '" value="regular" checked/><label for="newregular' . $library[0] . '">Regular hours</label><br/>';
		echo '<input type="radio" id="newspecial' . $library[0] . '" onclick="javascript:;showhours(\'new' . $library[0] . '\');" name="regularorspecial:new:' . $library[0] . '" value="special"/><label for="newspecial' . $library[0] . '">Set special hours</label></td>';
		//Only display if Set hours for each library is checked
		echo '<td style="display:none;" id="special1new' . $library[0] . '">Library opens at:<input type="text" name="starttime:new:' . $library[0] . '" class="time" id="opennew' . $library[0] . '" /><br/>';
		echo 'Library closes at:<input type="text" name="endtime:new:' . $library[0] . '" class="time" id="closenew' . $library[0] . '" /></td>';
		echo '<td style="display:none;" id="special2new' . $library[0] . '"><input type="checkbox" name="closedor24:new:' . $library[0] . '" id="closednew' . $library[0] . '" onclick="mutuallyexclusive(\'new' . $library[0] . '\')" class="mutuallyexclusivenew' . $library[0] . '" value="Closed"';
		echo '/><label for="closednew' . $library[0] . '">Closed</label><br/>';
		echo '<input type="checkbox" name="closedor24:new:' . $library[0] . '" id="appnew' . $library[0] . '" onclick="mutuallyexclusive(\'new' . $library[0] . '\')" class="mutuallyexclusivenew' . $library[0] . '" value="Appointment"';
		echo '/><label for="appnew' . $library[0] . '">By appointment</label><br/>';
		echo '<input type="checkbox" name="closedor24:new:' . $library[0] . '" id="twentyfournew' . $library[0] . '" onclick="mutuallyexclusive(\'new' . $library[0] . '\')" class="mutuallyexclusivenew' . $library[0] . '" value="Open24"'; 
		echo '/><label for="twentyfournew' . $library[0] . '">Open 24 hours</label></td></tr>';
	}
echo '<tr><td></td><td></td><td></td><td align="center"><input type="submit" value="Add new holiday" /></td></form></tr></table>';
echo '</div>';
foreach ($holidays as $holiday) {
echo '<div class="holdiv" id="div:' . $holiday[1] . '" style="display:none;">';
	echo '<h3>Edit existing holiday</h3>';
	echo '<table style="width:100%;"><form name="holiday:' . $holiday[1] . '" method="post" action="holidays.php" ><input type="hidden" name="oldholdate" value="'. $holiday[1] . '"><input type="hidden" name="oldholname" value="'. addslashes($holiday[0]) . '">';
	$libraries = NULL;
	$closed = NULL;
	$opentime = NULL;
	$closetime = NULL;
	$appointment = NULL;
	$open24 = NULL;
	echo '<tr style="background-color:#EEEDDB;"><td style="width:10%"><b>' . $holiday[0] . '</b></td>';
	$holidayquery = 'select HolName, LibID, SpecialDate, OpenTime, CloseTime, Closed, Appointment, Open24 from Special where SpecialDate = "' . $holiday[1] . '" order by SpecialDate';
	$holidayresult = mysqli_query($con, $holidayquery);
	while ($row = mysqli_fetch_array($holidayresult)) {
		$libraries[] = $row['LibID'];
		$closed[] = $row['Closed'];
		$opentime[] = $row['OpenTime']; 
		$closetime[] = $row['CloseTime']; 
		$appointment[] = $row['Appointment'];
		$open24[] = $row['Open24'];
		}
	echo '<td style="width:20%;">Date: <input type="text" name="holdate:' . $holiday[1] . '" class="date" id="date' . $holiday[1] . '" value="' . usdate($holiday[1]) . '" /></td>';
	//Check whether all libraries are closed
	echo '<td><input class="closedorset" type="radio" id="allclosed' . $holiday[1] . '" name="closedorset:' . $holiday[1] . '" value="closed" onclick="javascript:;hidelibraries(\'' . $holiday[1] . '\');"';
	if ((in_array(0,$closed) == FALSE) && (count($closed) == 10)) {
		$allclosed = "none";
		echo ' checked';
		}
	echo '/><label for="allclosed' . $holiday[1] . '">All libraries are closed</label><br/><input class="closedorset" id="set' . $holiday[1] . '" type="radio" name="closedorset:' . $holiday[1] . '" value="sethours" onclick="javascript:;showlibraries(\'' . $holiday[1] . '\');"';
	if ((in_array(0,$closed) == TRUE) or (count($closed) != 10)) {
		$allclosed = "table-row";
		echo ' checked';
	}
	echo '/><label for="set' . $holiday[1] . '">Set hours for each library</label><br/></td><td></td><td></tr></tr>';
	//Only display if "Set hours" is checked:
	$class = 'a';
	foreach ($alllibs as $library) {
		//Flip table class
		if ($class == 'a'){$class = 'b';}
		else {$class = 'a';}
		echo '<tr class="' . $class . '" id="inconstant' . $holiday[1] . $library[0] .'" style="display:' . $allclosed . ';"><td style="background-color:white;"></td><td><i><b>' . $library[1] . '</b></i></td>';
		if (in_array($library[0], $libraries)) {
			$key = array_search($library[0], $libraries);
			echo '<td><input type="radio" id="regular' . $holiday[1] . $library[0] . '" onclick="javascript:;hidehours(\'' . $holiday[1] . $library[0] . '\');" name="regularorspecial:' . $holiday[1] . ':' . $library[0] . '" value="regular"/><label for="regular' . $holiday[1] . $library[0] . '">Regular hours</label><br/>';
			echo '<input type="radio" id="special' . $holiday[1] . $library[0] . '"onclick="javascript:;showhours(\'' . $holiday[1] . $library[0] . '\');" name="regularorspecial:' . $holiday[1] . ':' . $library[0] . '" value="special" checked /><label for="special' . $holiday[1] . $library[0] . '">Set special hours</label></td>';
			echo '<td style="display:table-cell;" id="special1' . $holiday[1] . $library[0] . '">Library opens at:<input type="text" name="starttime:' . $holiday[1] . ':' . $library[0] . '" class="time" id="open' . $holiday[1] . $library[0] . '" value="' . formattime($opentime[$key]) . '"/><br/>';
			echo 'Library closes at:<input type="text" name="endtime:' . $holiday[1] . ':' . $library[0] . '" class="time" id="close' . $holiday[1] . $library[0] . '" value="' . formattime($closetime[$key]) . '"/></td>';
			echo '<td style="display:table-cell;" id="special2' . $holiday[1] . $library[0] . '"><input type="checkbox" name="closedor24:' . $holiday[1] . ':' . $library[0] . '" id="closed' . $holiday[1] . $library[0] . '" onclick="mutuallyexclusive(\'' . $holiday[1] . $library[0] . '\')" class="mutuallyexclusive' . $holiday[1] . $library[0] . '" value="Closed"';
			if ($closed[$key] == 1) {echo ' checked ';}
			echo '/><label for="closed' . $holiday[1] . $library[0] . '">Closed</label><br/>';
			echo '<input type="checkbox" name="closedor24:' . $holiday[1] . ':' . $library[0] . '" id="app' . $holiday[1] . $library[0] . '" onclick="mutuallyexclusive(\'' . $holiday[1] . $library[0] . '\')" class="mutuallyexclusive' . $holiday[1] . $library[0] . '" value="Appointment"';
			if ($appointment[$key] == 1) {echo ' checked ';}
			echo '/><label for="app' . $holiday[1] . $library[0] . '">By appointment</label><br/>';
			echo '<input type="checkbox" name="closedor24:' . $holiday[1] . ':' . $library[0] . '" id="twentyfour' . $holiday[1] . $library[0] . '" onclick="mutuallyexclusive(\'' . $holiday[1] . $library[0] . '\')" class="mutuallyexclusive' . $holiday[1] . $library[0] . '" value="Open24"'; 
			if ($open24[$key] == 1) {echo ' checked ';}
			echo '/><label for="twentyfour' . $holiday[1] . $library[0] . '">Open 24 hours</label></td></tr>';
		}
		else {
			echo '<td><input type="radio" id="regular' . $holiday[1] . $library[0] . '" onclick="javascript:;hidehours(\'' . $holiday[1] . $library[0] . '\');" name="regularorspecial:' . $holiday[1] . ':' . $library[0] . '" value="regular" checked /><label for="regular' . $holiday[1] . $library[0] . '">Regular hours</label><br/>';
			echo '<input type="radio" id="special' . $holiday[1] . $library[0] . '" onclick="javascript:;showhours(\'' . $holiday[1] . $library[0] . '\');" name="regularorspecial:' . $holiday[1] . ':' . $library[0] . '" value="special"/><label for="special' . $holiday[1] . $library[0] . '">Set special hours</label></td>';
			echo '<td style="display:none" id="special1' . $holiday[1] . $library[0] . '">';
			echo 'Library opens at:<input type="text" name="starttime:' . $holiday[1] . ':' . $library[0] . '" class="time" id="open' . $holiday[1] . $library[0] . '" value=""/><br/>';
			echo 'Library closes at:<input type="text" name="endtime:' . $holiday[1] . ':' . $library[0] . '" class="time" id="close' . $holiday[1] . $library[0] . '" value=""/></td>';
			echo '<td style="display:none" id="special2' . $holiday[1] . $library[0] . '"><input type="checkbox" name="closedor24:' . $holiday[1] . ':' . $library[0] . '" id="closed' . $holiday[1] . $library[0] . '" onclick="mutuallyexclusive(\'' . $holiday[1] . $library[0] . '\')" class="mutuallyexclusive' . $holiday[1] . $library[0] . '" value="Closed"/><label for="closed' . $holiday[1] . $library[0] . '">Closed</label><br/>';
			echo '<input type="checkbox" name="closedor24:' . $holiday[1] . ':' . $library[0] . '" id="app' . $holiday[1] . $library[0] . '" onclick="mutuallyexclusive(\'' . $holiday[1] . $library[0] . '\')" class="mutuallyexclusive' . $holiday[1] . $library[0] . '" value="Appointment"/><label for="app' . $holiday[1] . $library[0] . '">By appointment</label><br/>';
			echo '<input type="checkbox" name="closedor24:' . $holiday[1] . ':' . $library[0] . '" id="twentyfour' . $holiday[1] . $library[0] . '" onclick="mutuallyexclusive(\'' . $holiday[1] . $library[0] . '\')" class="mutuallyexclusive' . $holiday[1] . $library[0] . '" value="Open24"/><label for="twentyfour' . $holiday[1] . $library[0] . '">Open 24 hours</label></td></tr>';
			}

	}

	


echo '</tr><tr><td></td><td></td><td></td><td><td align="center" style="width:15%"><input type="submit" value="Set hours"/></td></form></tr>';
echo '</tr><tr><td></td><td></td><td></td><td></td><form name="delete" method="POST" action="holidays.php"><td align="center" style="width:15%"><input type="hidden" name="deleteholiday" value="' . $holiday[1] . '"/><input type="submit" value="Delete holiday" onclick="return makesure(\'Are you sure you want to delete this holiday?\')"/></td></form></table>';
echo '<p></p></div>';
}
echo '<p><a href="hoursmenu.php">Return to Main Menu</a></p>';
echo '</div>';	
echo '</div>';	


?>
