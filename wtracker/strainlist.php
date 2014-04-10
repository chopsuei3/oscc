<html>
<head>
<title>untitled project | strain list</title>
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

require_once("dropdown.php");
include ("dbConfig.php");

mysql_connect($host,$user,$pass);
@mysql_select_db($db) or die( "unable to select database");

// Create query
$strainlist = "select strain_name from strains";
$result=mysql_query($strainlist);
if (!$result) {
    echo "could not successfully run query ($strainlist) from database: " . mysql_error();
    exit;
}

if (mysql_num_rows($result) == 0) {
    echo "no transactions found";
}
?>
</head>
<body>  
<div id="int-site-container">
<h1>strains list</h1>  
<table border="1">
<tr>
<th>list of strains</th>
</tr>
<?php
$i=0;
while ($i < mysql_num_rows($result)) {

$strain_name=mysql_result($result,$i,"strain_name");
?>
<br />
<tr>
<td><? echo $strain_name; ?></td>
</tr>
<?php
$i++;
}
echo "</table><br />";
?>

<h2>search strains</h2>
<p>enter strain name to search for</p>
<form action="search.php" method="post">
     strain name:<input type="text" name="term" />
    <input type="submit" value="search"/>
    </form>
<br />
<h2>add strain</h2>
<p>enter strain name to add</p>
<form action="addstrain.php?op=add" method="post">
	strain name: <input type="text" name="strain_name" maxlength="255">
	<input type="submit" value="add">
</form>
<br />
<h2>edit strain</h2>
<p>select strain to edit and enter the new name</p>
<form action="editstrain.php" method="post">
strain name: <?php dropdown(strain_id, strain_name, strains, strain_name, updstrain); ?>
updated strain name: <input type="text" name="upd_strain_name" maxlength="255">
<input type="submit" value="edit">
</form>
<br />
<h2>delete strain</h2>
<p>select strain to delete</p>
<form action="deletestrain.php" method="post" >
strain name: <?php dropdown(strain_id, strain_name, strains, strain_name, delstrain); ?>
<input type="submit" value="delete"/>
</form>

<?php
mysql_close();
?>

</body>
</html>