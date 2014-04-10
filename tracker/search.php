<html>
<title>the chronicler | search</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<body>
		<div class="container">
		<div class="row-fluid">
		<div class="span8 offset2">
		<h3>search results for </h3>
<?php

// dbConfig.php is a file that contains your
// database connection information. This
// tutorial assumes a connection is made from
// this existing file.

include ("dbConfig.php");

mysql_connect($host,$user,$pass);
@mysql_select_db($db) or die( "unable to select database");
 
$term = $_POST['term'];
echo ""."'".$term."'";

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
header('Refresh: 3; URL=/tracker/strains.php');
die("you're being redirected back to the <a href=\"strains.php\">strain list</a>");
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
// header('Refresh: 3; URL=/tracker/strains.php');
// die ("you're being redirected back to the <a href=\"strains.php\">strain list</a>");
echo "<p>go back to the  </p><a href=\"strains.php\">strain list</a>";
}
else {
?>
<br />
<div class="span4 offset4">
<table class="table">
<tr>
<th>strain name</th>
</tr>

<?php
$i=0;
while ($i < mysql_num_rows($result))  {

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
}
?>
</div>
</div>
<br />

	<div class="span4 offset4">
<h3><a href="profile.php">profile</a><br /></h3>
<h3><a href="strains.php">strains</a><br /></h3>
<h3><a href="transactions.php">transactions</a><br /></h3>
<h3><a href="logout.php">logout</a></h3>

</div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>