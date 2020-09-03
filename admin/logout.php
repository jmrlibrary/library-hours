<?php
	unset($_SERVER['PHP_AUTH_USER']);
   //header('WWW-Authenticate:Basic AuthBasicProvider="OpenID" AuthOpenIDSingleIdP="http://culib.wrlc.org/login/drupal"');
   //header('HTTP/1.0 401 Unauthorized');
	setcookie("open_id_session_id",'123','0',"/hours/admin");
  //  echo $_COOKIE['open_id_session_id'];
 // print_r($_COOKIE);
?>
Logout successfully..... <a href="/hours/hoursdisplay.php">Continue</a>