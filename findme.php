<html>
<body>

<form action="findme.php" method="post">
     <input type="text" placeholder="Enter your location" name="location" maxlength="255">
     <button type="submit">Find me</button>
	 <input type="reset" value="Clear">
</form>

<?php
$wbapifile = 'weatherbug_api_key.txt';
$wbapikey = file_get_contents($wbapifile);

// Replace the variable values below
// with your specific database information.
$host = "finder.onsitecomputerconsulting.net";
$user = "chopsuei3";
$pass = "jTRV9k";
$db   = "finder_oscc";

// This part sets up the connection to the 
// database (so you don't need to reopen the connection
// again on the same page).
$ms = mysql_pconnect($host, $user, $pass);
if ( !$ms )
        {
        echo "error connecting to database.\n";
        }

// Then you need to make sure the database you want
// is selected.
mysql_select_db($db);

$address = $_POST['location'];

$current_ip = getenv(REMOTE_ADDR);

$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

$output= json_decode($geocode);

$lat = $output->results[0]->geometry->location->lat;
$long = $output->results[0]->geometry->location->lng;

if (!is_null($address))
{
echo "<h3>Your location</h3>";
echo "<p>".$address."</p>";
echo "<h3>Latitude / Longitude</h3>";
echo "<p>".$lat." / ".$long."</p>";
echo "<h3>Your current IP address</h3>";
echo "<p>".$current_ip."</p>";
}
?>

</body>
</html>