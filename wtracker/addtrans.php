<title>untitled project | add transaction</title>
<?php
// dbConfig.php is a file that contains your
// database connection information. This
// tutorial assumes a connection is made from
// this existing file.
session_start();

if (!$_SESSION["valid_user"])
{

// User not logged in, redirect to login page
Header("Location: login.php");
}

include ("dbConfig.php");

$con = mysql_connect($host,$user,$pass);
@mysql_select_db($db,$con) or die( "unable to select database");


$sql="INSERT INTO transactions (transaction_date, id, strain_id, transaction_amount, transaction_weight)
VALUES
('$_POST[transdate]','$_SESSION[valid_id]','$_POST[transstrain]','$_POST[transprice]','$_POST[transweight]')";

if (!mysql_query($sql,$con))
  {
  die('error: ' . mysql_error());
  }
mysql_close($con);

echo "1 transaction added";
header('Refresh: 1; URL=/wtracker/transactions.php');
echo "<br />you're being redirected back to continue editing your <a href=\"transactions.php\">transactions</a>";
?>

