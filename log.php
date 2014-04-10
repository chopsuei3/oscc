<html>
<body>
<?php

include('ip2locationlite.class.php');

$ipLite = new ip2location_lite;
$ipLite->setKey('<81e7ae0f1021b1eb8401cd064888d2eaa302767d2cd8f21e8ee9dc6ecf991b3f>');

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

$current_ip = getenv(REMOTE_ADDR);

$locations = $ipLite->getCity($current_ip);
$errors = $ipLite->getError();

$query = "select * from visitors";
$run = mysql_query($query);

$num=mysql_numrows($run);

?>

<table border="1" cellspacing="1" cellpadding="1">
<tr>
<td>
<h4>Visitor ID</h4>
</td>
<td>
<h4>Visitor Date Time</h4>
</td>
<td>
<h4>Visitor IP Address</h4>
</td>
<td>
<h4>Visitor Hostname</h4>
</td>

<?php

$i=0;while ($i < $num) 
{
$field1 = mysql_result($run,$i,"visitor_id");
$field2 = mysql_result($run,$i,"visitor_datetime");
$field3 = long2ip(mysql_result($run,$i,"visitor_ip"));
$field4 = gethostbyaddr($field3);
?>

<tr>
<td>
<p><?php echo $field1; ?></p>
</td>
<td>
<p><?php echo $field2; ?></p>
</td>
<td>
<p><?php echo $field3; ?></p>
</td>
<td>
<p><?php echo $field4; ?></p>
</td>

<?php
$i++;
}

?>
</table>

<?php
//Getting the result
echo "<p>\n";
echo "<strong>My current location</strong><br />\n";
if (!empty($locations) && is_array($locations)) {
  foreach ($locations as $field => $val) {
    echo $field . ' : ' . $val . "<br />\n";
  }
}
echo "</p>\n";

//Show errors
echo "<p>\n";
echo "<strong>Dump of all errors</strong><br />\n";
if (!empty($errors) && is_array($errors)) {
  foreach ($errors as $error) {
    echo var_dump($error) . "<br /><br />\n";
  }
} else {
  echo "No errors" . "<br />\n";
}
echo "</p>\n";
?>
</body>
</html>