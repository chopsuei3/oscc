<title>the chronicler | edit strain</title>
<?php
// dbConfig.php is a file that contains your
// database connection information. This
// tutorial assumes a connection is made from
// this existing file.
//session_start();

//if (!$_SESSION["valid_user"])
//{

// User not logged in, redirect to login page
//Header("Location: login.php");
//}

include ("dbConfig.php");

$con = mysql_connect($host,$user,$pass);
@mysql_select_db($db,$con) or die( "unable to select database");

$updstrainsql="UPDATE strains SET strain_name='$_POST[upd_strain_name]' WHERE strain_id='$_POST[updstrain]'";

if (!mysql_query($updstrainsql,$con))
  {
  die('Error: ' . mysql_error());
  }
mysql_close($con);

echo "1 record updated";
// header('Refresh: 3; URL=/tracker/strains.php');
echo "<br />go back to the <a href=\"strains.php\">strain list</a>";
?>

