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

?>

<html>
<head>
<title>the chronicler | login</title>
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading {      
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
</style>

</head>
<body>

    <div class="container-fluid">
<div class="row-fluid">
<div class="span4 offset4">
<form class="form-signin" action=?op=login method="POST">        
<h2 class="form-signin-heading">please sign in</h2>
<input type="text" class="input-block-level" placeholder="Username" name="username" size="15" align="center" >
<input type="password" class="input-block-level" placeholder="Password" name="password" size="8" align="center" >
<button class="btn btn-large btn-primary" type="submit">Sign in</button>
</form>

<h3><a href="register.php">register</a><br /></h3>
<h3><a href="index.html">home</a></h3>
</div>
</div>


</div>
    
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
