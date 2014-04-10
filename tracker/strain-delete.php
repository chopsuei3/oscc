<title>the chronicler | delete transaction</title>
<?php
// dbConfig.php is a file that contains your
// database connection information. This
// tutorial assumes a connection is made from
// this existing file.
// session_start();

include ("dbConfig.php");

$con = mysql_connect($host,$user,$pass);
@mysql_select_db($db,$con) or die( "unable to select database");


$delstrainsql="DELETE FROM strains WHERE strain_id='$_POST[delstrain]'";
$delstrtransql="DELETE FROM transactions where strain_id='$_POST[delstrain]'";

if (!mysql_query($delstrainsql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
if (!mysql_query($delstrtransql,$con))
  {
  die('error: ' . mysql_error());
  }
mysql_close($con);

echo "1 strain removed";
// header('Refresh: 3; URL=/tracker/strains.php');
echo "<br />go back to the <a href=\"strains.php\">strain list</a>";
?>

