


<html xmlns="http://www.w3.org/1999/xhtml">

<?


// Replace the variable values below
// with your specific database information.
$host = "finder.onsitecomputerconsulting.net";
$user = "chopsuei3";
$pass = "jTRV9k";
$db   = "finder_oscc";

// This part sets up the connection to the 
// database (so you don't need to reopen the connection
// again on the same page).
$ms = mysql_pconnect($host, $user, $pass);
if ( !$ms )
        {
        echo "error connecting to database.\n";
        }

// Then you need to make sure the database you want
// is selected.
mysql_select_db($db);

$user_ip = ip2long(getenv(REMOTE_ADDR));

echo $user_ip;

$visitor_insert = "INSERT INTO visitors (visitor_ip) values ('$user_ip')";

$run = mysql_query($visitor_insert);

?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>on-site computer consulting | oscc.biz</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background-color: #FFF;
}
</style>
</head>

<body>

<div class="container">
  <div class="content">
    <h1><img src="logo.jpg" width="530" height="100" align="middle" /></h1>
    <h1>Home and Small Office Technical Support</h1>
    <p>We provide on-site computer repair services to homes and businesses.  We specialize in PC virus removal, system optimization, and technical problem solving and troubleshooting for complex issues faced in today's technical world.  <strong>We can solve almost any problem you've been told is unfixable or is too expensive, from spyware and viruses to hard drive data recovery.</strong></p>
	<p>Services include:
    <ul><li>hardware upgrades and repairs</li>
    <li>spyware and antivirus removal and protection</li>
    <li>hardware troubleshooting (printers, cameras, scanners, etc.)</li>
    <li>software troubleshooting (installation or performance issues, updates, upgrades, etc.)</li>
    <li>router/internet troubleshooting or setup</li>
    <li>wireless internet problems and other general performance issues</li></ul></p>
	<p></p>
    <h2>Contact Information</h2>
<p>Information, quotes, and appointments available via e-mail or phone<br/>Kyle P. Schien | <a href="mailto:kyleps@onsitecomputerconsulting.net">kyleps@onsitecomputerconsulting.net</a> | 415.608.7615<br/>
149 Clark Street, San Rafael, CA  94901</p>
    <a href="http://www.linkedin.com/pub/kyle-schien/5/997/868">
    <img src="http://www.linkedin.com/img/webpromo/btn_viewmy_160x33.png" width="160" height="33" border="0" alt="View Kyle Schien's profile on LinkedIn">        
    </a>
    <a href="http://www.dreamhost.com/r.cgi?658910">
    <img src="dreamhost.gif" width="125" height"31" alt="DreamHost Hosting" />
    </a><br /> 
  <!-- end .content --></div>
  <!-- end .container --></div>
</body>
</html>
