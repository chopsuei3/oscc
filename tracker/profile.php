<?php
session_start();

if (!$_SESSION["valid_user"])
{
Header("Location: login.php");
}

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



?>

<html>
<head>
<title>the chronicler | user profile</title>
<link href="css/bootstrap.css" rel="stylesheet" media="screen">

</head>
<body>
    <div class="container">
       
<h1>user profile</h1>
<h4>user id: <?php echo $_SESSION[valid_user];?> | user id number: <?php echo $_SESSION[valid_id];?></h4>

<table class="table">
<tr>
<th>Transaction Date</th>
<th>Strain Name</th>
<th>Transaction Weight (grams)</th>
<th>Transaction Amount ($)</th>
</tr>

<?php
$i=0;
while ($i < mysql_num_rows($result)) {

$transaction_date=mysql_result($result,$i,"transaction_date");
$strain_name=mysql_result($result,$i,"strain_name");
$transaction_weight=mysql_result($result,$i,"transaction_weight");
$transaction_amount=mysql_result($result,$i,"transaction_amount");
?>

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
<div class="span4 offset4">
<h3><a href="profile.php">profile</a></h3>
<h3><a href="strains.php">strains</a></h3>
<h3><a href="transactions.php">transactions</a></h3>
<h3><a href="logout.php">logout</a></h3>
</div>
</div>
    
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>