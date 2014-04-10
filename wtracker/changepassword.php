<title>untitled project | change password</title>
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


$sql="update dbusers set password=md5('$password') where userid='$_SESSION[valid_id]'";

    if (empty($_POST['password'])) {
        die('You forgot to enter your existing password.');
    } else { 
        $p = escape_data($_POST['password']);
    }

    // Check for a password and match against the confirmed password.
    if (!empty($_POST['password1'])) {
            if ($_POST['password1'] != $_POST['password2']) {
                die('Your new password did not match the confirmed new password.');
    } else {
        $np = escape_data($_POST['password1']);
        }

if (!mysql_query($sql,$con))
  {
  die('error: ' . mysql_error());
  }
mysql_close($con);

echo "password changed";
echo "<br />";
echo "new password:".$np;

?>

