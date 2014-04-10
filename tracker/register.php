<?php

// dbConfig.php is a file that contains your
// database connection information. This
// tutorial assumes a connection is made from
// this existing file.

include ("dbConfig.php");

//Input vaildation and the dbase code
if ( $_GET["op"] == "reg" )
{
$bInputFlag = false;
foreach ( $_POST as $field )
{
if ($field == "")
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
die( "Problem with your registration info. "
."Please go back and try again.");
}

// Fields are clear, add user to database
//  Setup query
$q = "INSERT INTO `dbusers` (`username`,`password`,`email`) "
."VALUES ('".$_POST["username"]."', "
."md5('".$_POST["password"]."'), "
."'".$_POST["email"]."')";

//  Run query
$r = mysql_query($q);

// Make sure query inserted user successfully
if ( !mysql_insert_id() )
{
die("Error: User not added to database.");
}
else
{

// Redirect to thank you page.
Header("Location: register.php?op=thanks");
}
} // end if

//The thank you page
elseif ( $_GET["op"] == "thanks" )
{
echo "<h2>thanks for registering!</h2>";
}

//The web form for input ability
//else
//{
//echo "<form action=\"?op=reg\"
//method=\"POST\">\n";
//echo "Username: <input name=\"username\"
//MAXLENGTH=\"16\"><br />\n";
//echo "Password: <input type=\"password\"
//name=\"password\" MAXLENGTH=\"16\"><br />\n";
//echo "Email Address: <input name=\"email\"
//MAXLENGTH=\"25\"><br />\n";
//echo "<input type=\"submit\">\n";
//echo "</form>\n";
//}

?>

<html>
<head>
<title>the chronicler | registration</title>
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
    
<!--<form action=?op=reg method="POST">    
Username: <input name="username" MAXLENGTH="16"><br />    
Password: <input type="password"name="password" MAXLENGTH="16"><br />
Email Address: <input name="email"MAXLENGTH="30"><br />
<input type="submit">
</form>-->
    
<div class="container">
<div class="row-fluid">
<div class="span4 offset4">
<form class="form-signin" action=?op=reg method="POST">        
<h2 class="form-signin-heading">please register</h2>
<input type="text" class="input-block-level" placeholder="username" name="username" maxlength="16">
<input type="password" class="input-block-level" placeholder="password" name="password" maxlength="16">
<input type="text" class="input-block-level" placeholder="email address" name="email" maxlength="30">
<button class="btn btn-large btn-primary" type="submit">register</button>
</form>
<h3><a href="index.html">home</a><br /></h3>
<h3><a href="login.php">login</a></h3>
</div>
</div>
</div>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>