<title>the chronicler | add strain</title>

<?php

// dbConfig.php is a file that contains your
// database connection information. This
// tutorial assumes a connection is made from
// this existing file.

include ("dbConfig.php");

//Input vaildation and the dbase code
if ( $_GET["op"] == "add" )
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
echo "<p>error: problem with your strain name</p><br />";
header('Refresh: 3; URL=/tracker/strains.php');
die("you're being redirected back to the <a href=\"strains.php\">strain list</a>");
}

// Fields are clear, add user to database
//  Setup query

// Create query to add srain
$addStrain = "INSERT INTO strains (strain_name) VALUES ('$_POST[strain_name]')";

//  Run query
$r = mysql_query($addStrain);

// Make sure query inserted user successfully
if (mysql_errno() == 1062)
{
echo "<p>error: strain already in the database</p><br />";
header('Refresh: 3; URL=/tracker/strains.php');
die("you're being redirected back to the <a href=\"strains.php\">strain list</a>");
}
else if ( !mysql_insert_id() )
{
echo "<p>error: strain name not added to the database</p><br />";
header('Refresh: 3; URL=/tracker/strains.php');
die("you're being redirected back to the <a href=\"strains.php\">strain list</a>");
}
{

// Redirect to thank you page.
// header('Location: addstrain.php?op=success');

//printf("Last inserted record has id %d\n", mysql_insert_id());
echo "strain name added successfully";
// header('Refresh: 3; URL=/tracker/strains.php');
echo "<br />go back to the <a href=\"strains.php\">strain list</a>";
}
} // end if

//The thank you page
//elseif ( $_GET["op"] == "success" )
//{

//}

//The web form for input ability
//else
//{
//echo "<form action=\"?op=add\"
//method=\"POST\">\n";
//echo "Strain name: <input name=\"strain_name\"
//MAXLENGTH=\"255\"><br />\n";
//echo "<input type=\"submit\" value=\"add\">\n";
//echo "</form>\n";
//}

?>