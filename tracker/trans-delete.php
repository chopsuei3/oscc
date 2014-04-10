<title>untitled project | delete transaction</title>
<?php
// dbConfig.php is a file that contains your
// database connection information. This
// tutorial assumes a connection is made from
// this existing file.
// session_start();

//if (!$_SESSION["valid_user"])
//{

// User not logged in, redirect to login page
//Header("Location: login.php");
//}

include ("dbConfig.php");

$con = mysql_connect($host,$user,$pass);
@mysql_select_db($db,$con) or die( "unable to select database");

$deltranssql="DELETE FROM transactions WHERE transaction_id='$_POST[deltrans]'";

if (!mysql_query($deltranssql,$con))
  {
  die('error: ' . mysql_error());
  }
mysql_close($con);

echo "1 transaction deleted";
// header('Refresh: 3; URL=/wtracker/transactions.php');
echo "<br />go back to continue editing your <a href=\"transactions.php\">transactions</a>";
?>

