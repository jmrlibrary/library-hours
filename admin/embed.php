<head>
<title>JMRL Hours Tool--Generate Code</title>
<link type="text/css" href="css/hoursadmin.css" rel="stylesheet" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.20.custom.min.js"></script>
 <script type="text/javascript" src="js/farbtastic.js"></script>
 <link rel="stylesheet" href="css/farbtastic.css" type="text/css" />
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#demo').hide();
    var f = $.farbtastic('#picker');
    var p = $('#picker').css('opacity', 0.25);
    var selected;
    $('.colorwell')
      .each(function () { f.linkTo(this); $(this).css('opacity', 0.75); })
      .focus(function() {
        if (selected) {
          $(selected).css('opacity', 0.75).removeClass('colorwell-selected');
        }
        f.linkTo(this);
        p.css('opacity', 1);
        $(selected = this).css('opacity', 1).addClass('colorwell-selected');
      });
  });
</script>
</head>
<body>
<?php
//Get style info from $_POST if it exists
if ($_POST["library"] == NULL){
	$library = "1";}
else{
	$library = $_POST["library"];}
if ($_POST["daycount"] == NULL){
	$daycount = "7";}
else{
	$daycount = $_POST["daycount"];}
if ($_POST["name"] == NULL){
	$name = "0";}
else{
	$name = "1";}
if ($_POST["fontsize"] == NULL){
	$fontsize = "";}
else{
	$fontsize = $_POST["fontsize"];}
if ($_POST["font"] == NULL){
	$font = "";}
else{
	$font = $_POST["font"];}
if ($_POST["odd"] == NULL){
	$odd = "ffffff";}
else{
	$odd = explode('#', $_POST["odd"]);
	$odd = $odd[1];}
if ($_POST["even"] == NULL){
	$even = "eeeeee";}
else{
	$even = explode('#', $_POST["even"]);
	$even = $even[1];}
if ($_POST["headcolor"] == NULL){
	$headcolor = "eeeddb";}
else{
	$headcolor = explode('#', $_POST["headcolor"]);
	$headcolor = $headcolor[1];}
if ($_POST["padding"] == NULL){
	$padding = "";}
else{
	$padding = $_POST["padding"];}
if ($_POST["height"] == NULL){
	$height = "";}
else{
	$height = $_POST["height"];}
if ($_POST["width"] == NULL){
	$width = "";}
else{
	$width = $_POST["width"];}
if ($_POST["background"] == NULL){
	$background = "ffffff";}
else{
	$background = explode('#', $_POST["background"]);
	$background = $background[1];}
$parameters = '?lib=' . $library . '&name=' . $name . '&daycount=' . $daycount . '&fontsize=' . $fontsize . '&font=' . $font . '&odd=' . $odd . '&even=' . $even . '&headcolor=' . $headcolor . '&padding=' . $padding . '&height=' . $height . '&width=' . $width . '&background=' . $background;
?>
<br/>
<div style="background-color:white; margin-left:8%; margin-right:10%;height:1000px;">
<h2><a href="hoursmenu.php">JMRL Hours Tool</a></h2>
<div class="col1" style="padding:5px;background-color:white;width:43%;height:100%;border:4px solid white;">
<H3>Copy the following code to embed hours in your website:</H3>
<?php
//Get URL for output display
if ($_POST[URL] != NULL) {
	$URL = $_POST[URL];
	}
else {
	$URL = "../hoursdisplay.php" . $parameters;
	}
//Start of form
echo '<form action="embed.php" method="post">';
//It would be better if the iframe src could generate the parent directory
echo '<textarea rows=4 cols=45><iframe src="http://www.lib.cua.edu/hours/' . $URL . '" /></textarea>';
//It would be nice if the output could be updated by changing the embed code, not just by changing the options.
echo '<H3>Output</H3>';
echo '<p><iframe src="' . $URL . '" style="width:80%;height:600px;"></iframe></p>';
?>
</div>
<div class="col2" style="padding:5px;background-color:white;width:53%;text-align:left;height:100%;border:6px solid white;">
<H3>Options</H3>
<input name="regularorholiday" type="radio" value="regular" id="regular" checked/><label for="regular">Regular Hours</label><input name="regularorholiday" type="radio" value="holiday" id="holiday" disabled /><label for="holiday" disabled >Holiday Hours</label>
<H3>Libraries</H3>
<?php
echo '<p><input name="library" type="radio" value="1" id="1"';
if ($library == 1) {
echo ' checked ';
}
echo '/><label for="1">Mullen</label>&nbsp;<input name="library" type="radio" value="7" id="7"';
if ($library == 7) {
echo ' checked ';
}
echo '/><label for="7">Engineering/Architecture</label>&nbsp;<input name="library" type="radio" value="6" id="6"';
if ($library == 6) {
echo ' checked ';
}
echo '/><label for="6">Music</label>&nbsp;<input name="library" type="radio" value="3" id="3"';
if ($library == 3) {
echo ' checked ';
}
echo '/><label for="3">Oliveira Lima</label>&nbsp;<input name="library" type="radio" value="10" id="10"';
if ($library == 10) {
echo ' checked ';
}
echo '/><label for="10">Physics</label><br/>
<input name="library" type="radio" value="4" id="4"';
if ($library == 4) {
echo ' checked ';
}
echo '/><label for="4">Rare Books</label>&nbsp;<input name="library" type="radio" value="2" id="2"';
if ($library == 2) {
echo ' checked ';
}
echo '/><label for="2">Religious Studies</label>&nbsp;<input name="library" type="radio" value="5" id="5"';
if ($library == 5) {
echo ' checked ';
}
echo '/><label for="5">Semitics/ICOR</label>&nbsp;<input name="library" type="radio" value="9" id="9"';
if ($library == 9) {
echo ' checked ';
}
echo '/><label for="9">Archives</label><br/>
<input name="library" type="radio" value="all" id="all" ';
if ($library == 'all') {
echo ' checked ';
}
echo '/><label for="all">All Libraries</label>';
echo '<H3>Day Count</H3>';
echo 'Number of days to display: <input name="daycount" type="text" value="' . $daycount . '" size="2"/><br/>
<H3>Format</H3>
<input name="name" type="checkbox" id="name" ';
if ($name == '1') {
echo "checked ";
}
echo '/> <label for="name"> Show library name in header. </label><br/>
Font size: <input name="fontsize" type="text" size="2" value="' . $fontsize . '"/><br/>
Font: <select name="font">
<option value="Helvetica" ';
if ($font == 'Helvetica') {
echo 'selected="selected" ';
}
echo '>Helvetica</option>
<option value="Times+New+Roman" ';
if ($font == 'Times+New+Roman') {
echo 'selected="selected" ';
}
echo '>Times New Roman</option>
<option value="Arial" ';
if ($font == 'Arial') {
echo 'selected="selected" ';
}
echo '>Arial</option>
<option value="Courier" ';
if ($font == 'Courier') {
echo 'selected="selected" ';
}
echo '>Courier</option>
<option value="Comic Sans MS" ';
if ($font == 'Comic Sans MS') {
echo 'selected="selected" ';
}
echo '>Comic Sans</option>
<option value="Verdana" ';
if ($font == 'Verdana') {
echo 'selected="selected" ';
}
echo '>Verdana</option>
</select><br/>'; ?>
<p>
<div id="picker" style="float: right;"></div>
<br/>
<br/>
<?php
 echo '<div class="form-item"><label for="headcolor">Header color:</label><input type="text" id="headcolor" name="headcolor" class="colorwell" value="#' . $headcolor . '" /></div>
  <div class="form-item"><label for="odd">Color for odd rows:</label><input type="text" id="odd" name="odd" class="colorwell" value="#' . $odd . '" /></div>
  <div class="form-item"><label for="even">Color for even rows:</label><input type="text" id="even" name="even" class="colorwell" value="#' . $even . '" /></div>
  <div class="form-item"><label for="background">Background color:</label><input type="text" id="background" name="background" class="colorwell" value="#' . $background . '" /></div>'; ?>
  </p> 
<br/>
<?php
echo 'Cell padding: <input name="padding" type="text" size="2" value="' . $padding . '" /> px<br/>
Table height: <input name="height" type="text" size="2" value="' . $height . '" /> px<br/>
Table width: <input name="width" type="text" size="2" value="' . $width . '" /> px<br/>';?>
<br/>
<p><input type="submit" value="Update"/></p>
<p><a href="hoursmenu.php">Return to Main Menu</a></p>
</form>
</div>
</div>
