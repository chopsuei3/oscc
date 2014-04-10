<html>
<head>

<script language="JavaScript" src="/wtracker/CalendarPopup.js"></script>
	<script language="JavaScript">
	var cal = new CalendarPopup();
	</script>
    
<title>untitled project | edit transaction</title>
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

require_once("dropdowna.php");
require_once("dropdown.php");
include ("dbConfig.php");

mysql_connect($host,$user,$pass);
@mysql_select_db($db) or die( "unable to select database");

// Create query
$uid = "select transactions.transaction_id, transactions.transaction_date, strains.strain_name, transactions.transaction_amount, transactions.transaction_weight
from transactions, strains
where (transactions.strain_id = strains.strain_id) and id = '".$_SESSION["valid_id"]."' ";

$result=mysql_query($uid);

if (!$result) {
    echo "could not successfully run query ($sql) from database " . mysql_error();
    exit;
}

if (mysql_num_rows($result) == 0) {
    echo "no transactions found";
    echo "<br />";
}
?>
</head>
<body>
<div id="int-site-container">
<h1>transactions</h1>

<h2>transactions</h2>
<table border="1">
<tr>
<th>Transaction ID</th>
<th>Transaction Date</font></th>
<th>Strain Name</th>
<th>Transaction Weight (grams)</th>
<th>Transaction Amount ($)</th>

</tr>

<?php
$i=0;
while ($i < mysql_num_rows($result)) {

$transaction_id=mysql_result($result,$i,"transaction_id");
$transaction_date=mysql_result($result,$i,"transaction_date");
$strain_name=mysql_result($result,$i,"strain_name");
$transaction_weight=mysql_result($result,$i,"transaction_weight");
$transaction_amount=mysql_result($result,$i,"transaction_amount");
?>

<br />
<tr>
<td><? echo $transaction_id; ?></td>
<td><? echo $transaction_date; ?></td>
<td><? echo $strain_name; ?></td>
<td><? echo $transaction_weight; ?></td>
<td><? echo $transaction_amount; ?></td>
</tr>

<?php
$i++;
}
echo "</table><br />";
?>
<h2>add transaction</h2>
<form action="addtrans.php" method="post" name="addtrans">
Date: <input type="date" name="transdate" />
<A HREF="#"
   onClick="cal.select(document.forms['addtrans'].transdate,'anchor1','yyyy/MM/dd'); return false;"
   NAME="anchor1" ID="anchor1">select</A>
Strain name: <?php dropdown(strain_id, strain_name, strains, strain_name, transstrain); ?>
Weight (grams): <input type="text" name="transweight" />
Price ($): <input type="text" name="transprice" />
<input type="submit" value="add transaction" />
</form>

<h2>quick-add strain</h2>
<p>if the strain name is not listed, you can add the strain below</p>
<form action="addstrain.php?op=add" method="post">
	strain name: <input type="text" name="strain_name" maxlength="255">
	<input type="submit" value="add strain">
</form>

<h2>edit transaction</h2>
<form action="edittrans.php" method="post" name="edittransaction">
select transaction to edit: <?php dropdowna(transaction_id, transaction_id, transactions, transaction_id, updtrans, $_SESSION["valid_id"]);?>
<br />
date: <input type="date" name="updtransdate" />
<A HREF="#"
   onClick="cal.select(document.forms['edittransaction'].updtransdate,'anchor1','yyyy/MM/dd'); return false;"
   NAME="anchor1" ID="anchor1">select</A>
strain name: <?php dropdown(strain_id, strain_name, strains, strain_name, updtransstrain); ?>
weight (grams): <input type="text" name="updtransweight" />
price ($): <input type="text" name="updtransprice" />
<input type="submit" value="edit transaction" />
</form>

<h2>delete transaction</h2>
<form action="deletetrans.php" method="post" name="deltrans">
select transaction to delete: <?php dropdowna(transaction_id, transaction_id, transactions, transaction_id, deltrans, $_SESSION["valid_id"]);?>
<input type="submit" value="delete transaction" />
</form>

<?php
mysql_close();
?>

</body>
</html>