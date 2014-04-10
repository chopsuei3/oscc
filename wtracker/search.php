<html>
<title>untitled project | search</title>

<?php

// dbConfig.php is a file that contains your
// database connection information. This
// tutorial assumes a connection is made from
// this existing file.

include ("dbConfig.php");

mysql_connect($host,$user,$pass);
@mysql_select_db($db) or die( "unable to select database");
 
$term = $_POST['term'];
echo "search results for "."'".$term."'";

$bInputFlag = false;
foreach ( $_POST as $term )
{
if ($term == "")
{
$bInputFlag = false;
}
else
{
$bInputFlag = true;
}
}

// If we had problems with the input, exit with error
if ($bInputFlag == false)
{
echo "<p>error: problem with search term.</p><br />";
header('Refresh: 1; URL=/wtracker/strainlist.php');
die("you're being redirected back to the <a href=\"strainlist.php\">strain list</a>");
}

// Create query
$strainsearch = "SELECT strain_name FROM strains where strain_name like '%$term%'";

$result=mysql_query($strainsearch);

if (!$result) {
    echo "could not successfully run query ($searchresult) from database: " . mysql_error();
    exit;
}

if (mysql_num_rows($result) == 0) {
echo "<p>no results found</p><br />";
header('Refresh: 1; URL=/wtracker/strainlist.php');
die ("you're being redirected back to the <a href=\"strainlist.php\">strain list</a>");
}
?>
<br />
<table border="1">
<tr>
<th>strain name</th>
</tr>

<?php
$i=0;
while ($i < mysql_num_rows($result)) {

$strainresults=mysql_result($result,$i,"strain_name");
?>

<br />
<tr>
<td><? echo $strainresults; ?></td>
</tr>

<?php
$i++;
}
echo "</table><br />";

?>

<br />
<a href="index.html">home</a><br />
<a href="profile.php">profile</a><br />
<a href="strainlist.php">strain list</a><br />
<a href="transactions.php">add, edit, or delete a transaction</a><br />
<a href="logout.php">logout</a>
</html>