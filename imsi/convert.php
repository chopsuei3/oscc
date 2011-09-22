<html>
<title>ICCID to IMSI Converter</title>
<body>

<?php
$ICCID = $_POST['ICCID'];
$MCC = "310";											#Mobile Country Code for USA is 310
$MNC = "640";											#Mobile Network Code for Airadigm is 640
$MSIN = substr($ICCID, 12, 6);							#Mobile Subscriber Identification Number within Numerex
$IMSI = $MCC.$MNC."101".$MSIN;						#Internation Mobile Subscriber Identity

echo "<strong>ICC-ID: </strong></br>".$ICCID."</br>";	#output user-inputted ICC-ID
echo "<strong>IMSI: </strong></br>".$IMSI;				#output calculated IMSI
?>

</br></br>
<form>
<input type="button" value="New SIM" onClick="window.location.href='index.html'">
</form>

</body></html>