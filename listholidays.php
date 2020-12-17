<?php include('admin/config.php');
//Connect to database
$con = mysqli_connect(databasehost, databaseuser, databasepassword, databasename);
if (!$con) {
	die('Could not connect: ' . mysqli_error());}
//
$totallocations = totallocations; //How many libraries have regular hours set
function returnjson($json) {
			if(array_key_exists('callback', $_GET)){
				header('Content-Type: text/javascript; charset=utf8');
				$http_origin = $_SERVER['HTTP_ORIGIN'];
				if ($http_origin == "https://jmrl.org" || $http_origin == "https://www.jmrl.org" || $http_origin == "http://10.0.8.54" || $http_origin == "http://69.16.201.28" || $http_origin == "https://69.16.201.28" || $http_origin == "https://10.0.8.54" || $http_origin == "http://hestia.jmrl.org" || $http_origin == "https://hestia.jmrl.org")
				{  
					header("Access-Control-Allow-Origin: $http_origin");
				}
				header('Access-Control-Allow-Methods: GET, POST');
				$callback = $_GET['callback'];
				echo $callback.'('.$json.');';

			} else{
				// normal JSON string
				header('Content-Type: application/json; charset=utf8');
				$http_origin = $_SERVER['HTTP_ORIGIN'];
				if ($http_origin == "https://jmrl.org" || $http_origin == "https://www.jmrl.org" || $http_origin == "http://10.0.8.54" || $http_origin == "http://69.16.201.28" || $http_origin == "https://69.16.201.28" || $http_origin == "https://10.0.8.54" || $http_origin == "http://hestia.jmrl.org" || $http_origin == "https://hestia.jmrl.org")
				{  
					header("Access-Control-Allow-Origin: $http_origin");
				}
				header('Access-Control-Allow-Methods: GET, POST');
				echo $json;
			}
}
if (array_key_exists('limit', $_GET)) {
	$conditions = "AND `SpecialDate` < (CURDATE() + INTERVAL " . $_GET['limit'] . " DAY)";
}
if (array_key_exists('lib', $_GET)) {
	$conditions .= " AND `LibID` = " . $_GET['lib'];
}
$holidayinfoquery = "SELECT GROUP_CONCAT(`LibID` ORDER BY `LibID`), `HolName`, `SpecialDate`, GROUP_CONCAT(DISTINCT `Closed` ORDER BY `Closed`), `Notes`, `OpenTime`, `CloseTime` FROM `Special` WHERE `SpecialDate` >= CURDATE() " . $conditions . " GROUP BY `HolName`,`SpecialDate` ORDER BY `SpecialDate`;";
$holidayinforesult = mysqli_query($con, $holidayinfoquery);
$branchnames = shortnames; //Get short branch names from Config
if (array_key_exists('json', $_GET)) {
	$json = json_encode(mysqli_fetch_all($holidayinforesult));
	returnjson($json);
} else {
	header('Content-Type: text/javascript; charset=utf8');
	$html = "<ul class='holidaylist'>";
	while ($row = mysqli_fetch_row($holidayinforesult)) {
		$html .= "<li><b>" . htmlentities($row[1], ENT_QUOTES, 'UTF-8') . "</b> (" . date("F j, Y", strtotime($row[2])) . ")";
		$branches = explode(",", $row[0]);
		if (($row[3] == 0 || $row[3] == "0,1") && $row[4] == "") {
			$html .= " <i>- Special hours";
			if (array_key_exists('lib', $_GET)) {
				$html .= " " . date("g:i a", strtotime($row[5])) . " - " . date("g:i a", strtotime($row[6]));
			} else if (count($branches) < $totallocations) {
				$html .= " at ";
				$counter = 1;
				foreach($branches as $branch) {
					if ($counter > 1 && $counter < count($branches)) {
						$html .= ", ";
					} else if ($counter > 1 && $counter == count($branches)) {
						$html .= ",  and ";
					}
					$html .= $branchnames[($branch - 1)];
					$counter ++;
				}
			}
			$html .= "</i>";
		}
		else if ($row[3] == 0) {
			$html .= " <i>- " . htmlentities($row[4], ENT_QUOTES, 'UTF-8') . "</i>";
		}
		else if (!array_key_exists('lib', $_GET) && $row[3] == 1 && count($branches) < $totallocations && $row[4] == "") {
			$html .= " <i>- ";
			$counter = 1;
			foreach($branches as $branch) {
				if ($counter > 1 && $counter < count($branches)) {
					$html .= ", ";
				} else if ($counter > 1 && $counter == count($branches)) {
					$html .= ",  and ";
				}
				$html .= $branchnames[($branch - 1)];
				$counter ++;
			}
			$html .= " closed</i>";
		}
		else {
			if ($row[4] == "") {
				$html .= " <i>- Closed</i>";
			}
			else {
				$html .= "<i>- " . htmlentities($row[4], ENT_QUOTES, 'UTF-8') . "</i>";
			}
		}
		$html .= "</li>";
	}
	$html .= "</ul>";
	if (array_key_exists('divid', $_GET)) {
		$divid = preg_replace("/[^a-zA-Z0-9]/", "", $_GET['divid']);
	} else {
		$divid = "holidaylistdiv";
	}
	echo "jQuery('#$divid').html(\"$html\");";
}


	?>