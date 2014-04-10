<html>
<head>
<title>untitled project | user profile</title>
<link href="header.css" rel="stylesheet" type="text/css">

<div id="logo"></div>
<div id="navbar-container">
<div id="navbar">
<a href="index.html">home</a>
<a href="profile.php">profile</a>
<a href="strainlist.php">strains</a>
<a href="transactions.php">transactions</a>
<a href="logout.php">logout</a>
</div>
</div>

<?php
session_start();

if (!$_SESSION["valid_user"])
{
// User not logged in, redirect to login page
Header("Location: login.php");
}

// Member only content
// ...
// ...
// test content
// dbConfig.php is a file that contains your
// database connection information. This
// tutorial assumes a connection is made from
// this existing file.
include ("dbConfig.php");
mysql_connect($host,$user,$pass);
@mysql_select_db($db) or die( "Unable to select database");
// Create query
$uid = "select transactions.transaction_date, strains.strain_name, transactions.transaction_amount, transactions.transaction_weight
from transactions, strains
where (transactions.strain_id = strains.strain_id) and id = '".$_SESSION["valid_id"]."' ";
$result=mysql_query($uid);
if (!$result) {
    echo "Could not successfully run query ($sql) from database: " . mysql_error();
    exit;
}
if (mysql_num_rows($result) == 0) {
    echo "No rows found, nothing to print so am exiting";
    echo "<br />";
}
$password=$_POST['password'];
$password1=$_POST['password1'];
$password2=$_POST['password2'];
?>
</head>
<body>
<div id="int-site-container">
<h1>user profile</h1>
<h3>user id number: <?php echo $_SESSION[valid_id]; ?></h3>
<h3>user id: <?php echo $_SESSION[valid_user]; ?></h3>

<table border="1">
<tr>
<th>Transaction Date</font></th>
<th>Strain Name</th>
<th>Transaction Amount ($)</th>
<th>Transaction Weight (grams)</th>
</tr>

<?php
$i=0;
while ($i < mysql_num_rows($result)) {

$transaction_date=mysql_result($result,$i,"transaction_date");
$strain_name=mysql_result($result,$i,"strain_name");
$transaction_weight=mysql_result($result,$i,"transaction_weight");
$transaction_amount=mysql_result($result,$i,"transaction_amount");
?>

<br />
<tr>
<td><? echo $transaction_date; ?></td>
<td><? echo $strain_name; ?></td>
<td><? echo $transaction_weight; ?></td>
<td><? echo $transaction_amount; ?></td>
</tr>

<?php
$i++;
}
echo "</table><br />";
mysql_close();
?>

<h2>change user password</h2>
<form action="changepassword.php" method="post" name="changepw">
current password:<input type="text" name="password" /><br />
new password:<input type="text" name="password1" /><br />
confirm new password:<input type="text" name="password2" /><br />
<input type="submit" value="change password" />
</form>
</body>
</html>