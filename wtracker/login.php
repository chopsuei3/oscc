<html>
<head>
<title>untitled project | login</title>
<link href="header.css" rel="stylesheet" type="text/css">

</head>
<body>
<div id="logo"></div>
<div id="navbar-container">
<div id="navbar">
<a href="index.html">home</a>
<!--<a href="register.php">register</a>-->
<a href="login.php">login</a>
</div>
</div>

<?php
session_start();

// dBase file
include "dbConfig.php";
if ($_GET["op"] == "login")
{
if (empty($_POST["username"]) || empty($_POST["password"]) )
{
die("you need to provide a username and password");
}
  
// Create query
 $q = "SELECT * FROM `dbusers` "
."WHERE `username`='".$_POST["username"]."' "
."AND `password`=md5('".$_POST["password"]."')
"
."LIMIT 1";

// Run query
$r = mysql_query($q);
if ( $obj = @mysql_fetch_object($r) )
{

// Login good, create session variables
$_SESSION["valid_id"] = $obj->id;
$_SESSION["valid_user"] = $_POST["username"];
$_SESSION["valid_time"] = time();

// Redirect to member page
Header("Location: profile.php");
}
else
{

// Login not successful
die("sorry, could not log you in. wrong login information.");
}
}
else
{

//If all went right the Web form appears and users can log in
echo "<form action=\"?op=login\"
method=\"POST\">";
echo "Username: <input name=\"username\"
size=\"15\"><br />";
echo "Password: <input type=\"password\"
name=\"password\" size=\"8\"><br />";
echo "<input type=\"submit\" value=\"Login\">";
echo "</form>";
}

?>

</div>

</body>
</html>
