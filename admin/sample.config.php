<?php
define('databasename', 'hours'); // Name of the hours database
define('databaseuser', 'hours'); // Username for database
define('databasepassword', 'hours'); // Password for database
define('databasehost', 'localhost'); // Normally should be localhost unless your database is on another server

//Setting this to match the data in sample_data.sql
define('librarysystemname', 'UMW Libraries');

//The following are things that I apologize for hardcoding.  You will need to set them to match your library system
//You will also still need to set library names in the JavaScript files - see Readme
define('totallocations', 4); // How many libraries/locations that have hours
define('locationsarray', array(1,2,3,4)); // Same thing, different format
define('addressarray', array (	"Simpson Library" => '1801 College Ave <br>Fredericksburg, VA 22401 (<a href="https://goo.gl/maps/nKSqqgHSURifGKXeA">map</a>)<br><a href="tel:5406541125">(540)654-1125</a>',
	"Special Collections" => '2nd Floor, Simpson Library',
	"ThinkLab" => '2nd Floor, Simpson Library',
	"HCC Desk" => 'HCC Bridge'
)); //Change to match the number of libraries you have/their addresses/any non-address stuff you want to display
define('alllibs', $alllibs = array(array(1, 'Simpson Library'),array(2, 'Special Collections'), array(3, 'ThinkLab'), array(4, 'HCC'))); //Because for some reason Holidays can't just get the name from the database
define('shortnames', array("Central", "Crozet", "Gordon", "Greene", "Louisa", "Nelson", "Northside", "Scottsville", "Bookmobile")); //Used by List Holidays
?>