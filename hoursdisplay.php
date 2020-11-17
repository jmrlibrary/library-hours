<?php
//Jefferson-Madison Regional Hours
//Table CSS: Font, font size, even row color, odd row color, table heading color, table cell padding, and table height and width can all be set from the URL.
//Append the following to the URL to change settings: ?lib=&name=&daycount=&fontsize=&font=&odd=&even=&headcolor=&padding=&height=&width=&
//To test a date, use the parameter: &testdate=[date]  This is using PHP strtotime, so it can interpret 1/30/2019 and January 30, 2019 equally well.  
//It will assume 5-1-2019 1/5/2019 are both January 5.

include('admin/config.php');
$cssfile = '';
if ($_GET["cssfile"] == 1) {
	$cssfile = "hoursdisplay.css";
	}
if ($_GET["fontsize"] == NULL){
	$fontsize = "16px;";}
else{
	$fontsize = $_GET["fontsize"] . 'px;';}
if ($_GET["font"] == NULL){
	$font = "helvetica;";}
else{
	$font = $_GET["font"] . ';';}
if ($_GET["odd"] == NULL){
	$odd = "unset;";}
else{
	$odd = '#' . $_GET["odd"] . ';';}
if ($_GET["even"] == NULL){
	$even = "#eeeeee;";}
else{
	$even = '#' . $_GET["even"] . ';';}
if ($_GET["headcolor"] == NULL){
	$headcolor = "#eeeddb;";}
else{
	$headcolor = '#' . $_GET["headcolor"] . ';';}
if ($_GET["padding"] == NULL){
	$padding = "px;";}
else{
	$padding = $_GET["padding"] . 'px;';}
if ($_GET["height"] == NULL){
	$height = "px;";}
else{
	$height = $_GET["height"] . 'px;';}
if ($_GET["width"] == NULL){
	$width = "px;";}
else{
	$width = $_GET["width"] . 'px;';}
if ($_GET["background"] == NULL){
	$background = "unset;";}
else{
	$background = '#' . $_GET["background"] . ';';}
$jsonoutput = array();
if ($_GET["json"] == 1) {
	$json = 1;
	}
else {
	$json = NULL;
}
$htmlstring = '<head><meta name="viewport" content="width=device-width, initial-scale=1"><style type="text/css">
		body {background-color: ' . $background . '; margin-top:0; padding-top:0;}
		table {font-size: ' . $fontsize . ' font-family: ' . $font . 'width: ' . $width . ' height: ' . $height . '}
		td {padding: ' . $padding . '}
		tr.header {background-color: ' . $headcolor . ' font-weight: bold;}
		tr.header td {color: #000000;}
		td.address {background-color: ' . $headcolor . ';}
		tr.a  {vertical-align: top; background-color: ' . $odd .'}
		tr.b  {vertical-align: top;
		background-color: ' . $even .'}</style><link rel="stylesheet" type="text/css" href="' . $cssfile . '"></head>';
$addresses = addressarray;
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
//Connect to database:
$con = mysqli_connect(databasehost, databaseuser, databasepassword, databasename);
if (!$con) {
	die('Could not connect: ' . mysqli_error());}
//Get day count, then get dates selected number of days and put them in an array.
$daycount = $_GET['daycount'];
if ($daycount == NULL){
	$daycount = 7;}
if ($_GET['testdate'] == NULL) {
	$Utoday = date("U");
}
else {
	$Utoday = strtotime($_GET['testdate']);
}
for($i=0; $i <$daycount; $i++){
	$thisweek[] = sqldate(strtotime('+' . $i . ' day', $Utoday));}
//Make an array with semester dates, so that each entry is an array with a start and end date.
$semquery = "select SemID, DayStart, DayEnd from Semesters order by DayStart";
$semresult = mysqli_query($con, $semquery);
while ($row = mysqli_fetch_array($semresult)) {
	$semdates[] = array($row['SemID'], $row['DayStart'], $row['DayEnd']);}
//Get selected library and put it in an array.  Get all libraries if no selection made.
if (($_GET["lib"] == NULL) OR ($_GET["lib"] == 'all')) {
	$libraries = locationsarray;
}
else{
	$libraries = array();
	foreach(explode(",", urldecode($_GET["lib"])) as $library) {
		$libraries[] = $library;
	}
}
$jsonsched = array();
//For each library...
foreach ($libraries as $library) {
	$htmlstring .= '<body><table width="100%" cellspacing ="0" border="0"><tbody>';
	$jsoncounter = 0;
	//Print library name
	if ($_GET["name"] == 1){
		$libquery = "select Libname  from Libraries where LibID = " . $library;
		$libresult = mysqli_query($con, $libquery);
		$libname = mysqli_fetch_row($libresult);
		$htmlstring .= '<tr class="header"><td colspan="2">' . $libname[0] . '</td></tr>';
		$jsonoutput[$library]['libraryname'] = $libname[0];
		if ($_GET["address"] == 1) {
			$htmlstring .= '<tr><td class="address">' . $addresses[$libname[0]] . '</td></tr>';
		}
	}
	//Clear old values
	$holnames = array();
	$holdates = array();
	$opentimes = array();
	$closetimes = array();
	$closings = array();
	$byapps = array();
	$twentyfours = array();
	$tsfmsg = 0;	
	//Get all the holidays:
	$holquery = "select * from Special where LibID = " . $library;
	$holresult = mysqli_query($con, $holquery);
	while ($row = mysqli_fetch_array($holresult)) {
		$holnames[] = $row['HolName'];
		$holdates[] = $row['SpecialDate'];
		$opentimes[] = $row['OpenTime'];
		$closetimes[] = $row['CloseTime'];
		$closings[] = $row['Closed'];
		$byapps[] = $row['Appointment'];
		$twentyfours[] = $row['Open24'];
		}
	//Set table row class
	$class = "b";
	//Loop through dates.  For each date:
	foreach ($thisweek as $date) {
		//Reset old values
		$semid = NULL;
		$opentime = NULL;
		$closetime = NULL;
		$closed = NULL;
		$byapp = NULL;
		$twentyfour = NULL;
		$holname = NULL;
		$jsonstatus = NULL;
		$notes = NULL;
		//Check if it's a holiday.  If so, get special hours.
		$success = 1;
		$jsonoutput[$library][$jsoncounter]['day'] = date('l', strtotime($date));
		$jsonoutput[$library][$jsoncounter]['date'] = date('F jS, Y', strtotime($date));
		if (in_array($date, $holdates)) {
			$key = array_search($date, $holdates);
			$holname = $holnames[$key];
			if ($closings[$key] == 1) {
				$closed = 1;}
			elseif ($byapps[$key] == 1) {
				$byapp = 1;}
			else {
				$opentime = formattime($opentimes[$key]);
				$closetime = formattime($closetimes[$key]);
				if ($twentyfours[$key] == 1) {
					$twentyfour = 1;}
				}}
		else {
			//Check semester against semarray.   
			foreach ($semdates as $range) {
				if($date >= $range[1] && $date <= $range[2]) {
					$semid = $range[0];}}
			//Grab hours for that semester.
			$dayofweek = date('w', strtotime($date));
			$schedarray = array(); //Resetting schedarray
			$schedquery = "select * from Schedule where LibID = " . $library . " and SemID = " . $semid;
			$schedresult = mysqli_query($con, $schedquery);
			if (mysqli_num_rows($schedresult)!=0){
				$schedarray = mysqli_fetch_rowsarr($schedresult);
				if ($schedarray[$dayofweek]['Closed'] == 1) {
					$closed = 1;}
				elseif ($schedarray[$dayofweek]['Appointment'] == 1) {
					$byapp = 1;}
				else {
					$opentime = formattime($schedarray[$dayofweek]['OpenTime']);
					$closetime = formattime($schedarray[$dayofweek]['CloseTime']);
					if ($schedarray[$dayofweek]['Open24'] == 1) {
						$twentyfour = 1;}
					}
				if ($schedarray[$dayofweek]['Notes'] != NULL) {
					$notes = $schedarray[$dayofweek]['Notes'];
				}
			}
			else {
				$success = 0;}
			}
			//Flip table class
			if ($class == 'a'){$class = 'b';}
			else {$class = 'a';}
			//Date, converted to day of the week
			$htmlstring .= '<tr class="' . $class . '"><td>' . date('l', strtotime($date)) . ': ';
			if ($success == 1) {
				if ($holname != NULL){
					$jsonoutput[$library][$jsoncounter]['holidayname'] = $holname;
				}
				else {
					$jsonoutput[$library][$jsoncounter]['holidayname'] = 'Regular Hours';
					$jsonoutput[$library][$jsoncounter]['notes'] = $notes;
				}
				if ($closed == 1) {
					$htmlstring .=  "Closed";
					$jsonoutput[$library][$jsoncounter]['hours'] = "Closed";
						if ($holname != NULL){
							$htmlstring .= " for " . $holname;
						} else if ($notes != NULL) {
							$htmlstring .= " <span class='notes'>$notes</span>";
						}
					}
				elseif ($byapp == 1) {
					$htmlstring .= "Hours by appointment";
					$jsonoutput[$library][$jsoncounter]['hours'] = "Hours by appointment";
					}
				else {
						$htmlstring .=  $opentime . " - " . $closetime;
						$jsonoutput[$library][$jsoncounter]['hours'] = $opentime . " - " . $closetime;
						if ($holname != NULL){
							$htmlstring .= " for " . $holname;
						} else if ($notes != NULL) {
							$htmlstring .= " <span class='notes'>$notes</span>";
						}
						$htmlstring .= '</td></tr>';
					}
				}
			else {
				$htmlstring .= "No hours recorded in database for this library.</td></tr>";
				$jsonoutput[$library][$jsoncounter]['hours'] = "No hours recorded in database for this library";
				}
			//$jsonsched[$jsoncounter] = array ($jsonstatus, $jsonnotes);
			$jsoncounter = $jsoncounter + 1;
			//Go to next date or next library. 
			} //Closing foreach date in thisweek
			$htmlstring .=  '</tbody></table></body>';
	}//Closing foreach library in libraries
	//json output
	if ($json == 1){
		echo $_GET['callback'] . '('.json_encode($jsonoutput).')';
		}
	else {
		echo $htmlstring;
	}
?> 