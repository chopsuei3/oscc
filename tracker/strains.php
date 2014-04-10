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

<html>
<head>
<title>the chronicler | strains</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">


<style type="text/css">
.content .span4 {
    margin-left: 0;
    padding-left: 19px;
    border-left: 1px solid #eee;
}
</style>


</head>
<body>
    <div class="container">
<h1>strains list</h1>  
<table class="table">
<tr>
<th>list of strains</th>
</tr>
<?php
$i=0;
while ($i < mysql_num_rows($result)) {

$strain_name=mysql_result($result,$i,"strain_name");
?>
<tr>
<td><? echo $strain_name; ?></td>
</tr>
<?php
$i++;
}
echo "</table><br />";
?>

<div class="row-fluid">
    <div class="span4">
<h2>search strains</h2>
<form class="form-search" action="search.php" method="post">
    <input type="text" class="input-medium" placeholder="enter strain name" name="term">
    <button class="btn btn-small btn-primary" type="submit">Search</button>
</form>
    </div>
    <div class="span4">
<h2>add strain</h2>
<form class="form-inline" action="strain-add.php?op=add" method="post">
     <input class="input-medium" type="text" placeholder="enter strain name" name="strain_name" maxlength="255">
     <button class="btn btn-small btn-primary" type="submit">Add</button>
</form>
    </div>
    <div class="span4">
<h2>delete strain</h2>
<form class="form-inline" action="strain-delete.php" method="post" >
    <?php dropdown(strain_id, strain_name, strains, strain_name, delstrain); ?>
    <button class="btn btn-small btn-primary" type="submit">Delete</button>
</form>
    </div>
</div>

<div class="row-fluid">
    <div class="span8 offset1">
<h2>edit strain name</h2>
<form class="form-horizontal" action="strain-edit.php" method="post">
    <?php dropdown(strain_id, strain_name, strains, strain_name, updstrain); ?> 
    <input class="input-medium" type="text" placeholder="enter new strain name" name="upd_strain_name" maxlength="255">
    <button class="btn btn-small btn-primary" type="submit">Edit</button>
</form>


<?php
mysql_close();
?>
<div class="span4 offset4">
<h3><a href="profile.php">profile</a><br /></h3>
<h3><a href="transactions.php">transactions</a><br /></h3>
<h3><a href="logout.php">logout</a></h3>
</div>
</div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>