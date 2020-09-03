<?php
// Checks whether one (or all) JMRL libraries are closed or have special hours
// today or tomorrow (or on a given day and next da) and outputs 
// this information in JSON.  Also includes the status message for the day

//Possible URL parameters: &lib=[number] (1 = Central, 2 = Crozet, 3 = Gordon, 4 = Greene, 5 = Louisa, 6 = Nelson, 7 = Northside, 8 = Scottsville, 9 = Bookmobile)  No number returns all libraries.

//&testdate=[date]  This is using PHP strtotime, so it can interpret 1/30/2019 and January 30, 2019 equally well.  It will assume 5-1-2019 1/5/2019 are both January 5.

//NOT IMPLEMENTED YET: &json=[0 or 1]  1 outputs JSON.  0 outputs HTML in case there's a situation where it's easier to embed an iframe.
include('admin/config.php');
date_default_timezone_set('America/New_York');

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
function formattime($sqltime) {
	return date("g:i a", strtotime(stripslashes($sqltime)));
}
function sqldate($Udate) {
	return date("Y-m-d", $Udate);
}
function outputdate($date) {
	return date("m/d/y", strtotime($date));
}
//Connect to database:
$con = mysqli_connect(databasehost, databaseuser, databasepassword, databasename);
if (!$con) {
	die('Could not connect: ' . mysqli_error());}
//Get dates for today and tomorrow (or selected day and the day after) and put them in an array.
$daycount = 2;
if ($_GET['testdate'] == NULL) {
	$Utoday = date("U");
}
else {
	$Utoday = strtotime($_GET['testdate']);
}
for($i=0; $i <$daycount; $i++){
	$thisweek[] = sqldate(strtotime('+' . $i . ' day', $Utoday));}
//Get selected library and put it in an array.  Get all libraries if no selection made.
if (($_GET["lib"] == NULL) OR ($_GET["lib"] == 'all')) {
	$libraries = array(1,2,3,4,5,6,7,8,9);
}
else{
	$libraries = array($_GET["lib"]);}
//For each library...
foreach ($libraries as $library) {
	//Get the name (because this makes life easier to have)
		$libquery = "select Libname  from Libraries where LibID = " . $library;
		$libresult = mysqli_query($con,$libquery);
		$libname = mysqli_fetch_row($libresult)[0];
	//Clear old values
		$holnames = array();
		$holdates = array();
		$opentimes = array();
		$closetimes = array();
		$closings = array();
		$byapps = array();
		$twentyfours = array();
	//Get all the holidays:
		$holquery = "select * from Special where LibID = " . $library;
		$holresult = mysqli_query($con,$holquery);
		while ($row = mysqli_fetch_array($holresult)) {
			$holnames[] = $row['HolName'];
			$holdates[] = $row['SpecialDate'];
			$opentimes[] = $row['OpenTime'];
			$closetimes[] = $row['CloseTime'];
			$closings[] = $row['Closed'];
			$byapps[] = $row['Appointment'];
			$twentyfours[] = $row['Open24'];
		}
		//Loop through dates.  For each date:
			$counter = "today";
			foreach ($thisweek as $date) {
				//Reset old values
					$opentime = NULL;
					$closetime = NULL;
					$closed = NULL;
					$byapp = NULL;
					$twentyfour = NULL;
					$holname = NULL;
					$daystatus = NULL;
					$jsonnotes = 0;
				//Check if it's a holiday
					if (in_array($date, $holdates)) {
						$key = array_search($date, $holdates);
						$holname = $holnames[$key];
						if ($closings[$key] == 1) {
							$closed = 1;
							$daystatus = array("name"=>$holname,"date"=>outputdate($date),"hours"=>"closed");
							$closedlist[$counter][] = $libname;
						}
						elseif ($byapps[$key] == 1) {
							$byapp = 1;
							$daystatus = array("name"=>$holname,"date"=>outputdate($date),"hours"=>"by appointment");
						}
						else {
							$opentime = formattime($opentimes[$key]);
							$closetime = formattime($closetimes[$key]);
							$daystatus = array("name"=>$holname,"date"=>outputdate($date),"hours"=>" open from " . $opentime . " to " . $closetime);
							if ($twentyfours[$key] == 1) {
								$twentyfour = 1;
							}
							$openlist[$counter][] = $libname;
						}
					}
					else {
						$daystatus = array("name"=>"None","date"=>outputdate($date),"hours"=>"Regular Hours");
					}
					$days[$counter] = $daystatus;
					$counter = "tomorrow";
			}
			$jsonstring[$libname] = $days;
}
if (count($openlist) > 0) {
	$jsonstring["openspecial"] = $openlist;
}
if (count($closedlist) > 0) {
	$jsonstring["closed"] = $closedlist;
}
echo $_GET['callback'] . '('.json_encode($jsonstring).')';
?>