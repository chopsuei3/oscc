<?php
/**
 * This is just an Demo API Key. It will only get you Country name from the IP address. 
 * This API KEY fetches only 90 calls in a day. For an unlimited account, just sign up for FREE account at: http://geoip.dmwtechnologies.com/register.php
 *
 * @see Version 2 has two new information from the IP
 *
 * Local Time 
 * and
 * Current Temperature
 */ 

//This is a Demo API KEY, exclusively for www.phpclasses.org only
define("API_KEY","dmwd8cd98f99b204e9800998ecf8427eda0c5ab4fa2b60b93876b470bfafc7e44a8a66a2a35fdaec18cb1af7e6540f09"); 

$ip=$_SERVER['REMOTE_ADDR'];
//$ip="125.17.146.135";

require_once("GeoIpApiConnector.inc.php");
$GeoIpApiConnector=new GeoIpApiConnector(API_KEY);
//$infoArray=$GeoIpApiConnector->getInformationArray($ip);

echo "<br />IP Address: ".$ip;
echo "<br />Country Name: ".$GeoIpApiConnector->getCountryName($ip);
echo "<br />Capital Name: ".$GeoIpApiConnector->getCapitalName($ip);
echo "<br />Country Code: ".$GeoIpApiConnector->getCountryCode($ip);
echo "<br />Region Name: ".$GeoIpApiConnector->getRegionName($ip);
echo "<br />City Name: ".$GeoIpApiConnector->getCityName($ip);
echo "<br />Latitude: ".$GeoIpApiConnector->getLatitude($ip);
echo "<br />Longitude: ".$GeoIpApiConnector->getLongitude($ip);
echo "<br />Pin Code: ".$GeoIpApiConnector->getPinCode($ip);
echo "<br />DMA Code: ".$GeoIpApiConnector->getDmaCode($ip);
echo "<br />Area Code: ".$GeoIpApiConnector->getAreaCode($ip);
echo "<br />Currency: ".$GeoIpApiConnector->getCurrencyName($ip);
echo "<br />Current Conversion Rate: ".$GeoIpApiConnector->getCurrentConversionRate($ip);
echo "<br />Calling Code: ".$GeoIpApiConnector->getCallingCode($ip);
echo "<br />Local Time: ".$GeoIpApiConnector->getLocalTime($ip);
echo "<br />Current Temperature: ".$GeoIpApiConnector->getCurrentTemperature($ip);
echo "<br />Account Type: ".$GeoIpApiConnector->getAccountType($ip);
echo "<br />Total Requests Made: ".$GeoIpApiConnector->getTotalRequestsMade($ip);
echo "<br />Remaining Requests: ".$GeoIpApiConnector->getRemainingRequests($ip);
?>