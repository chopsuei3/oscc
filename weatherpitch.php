<html>
<title>WeatherPitch</title>

<table border="1">
<tr>
<th>Teams</th>
<th>Probables</th>
<th>Gametime</th>
<th>Venue, Lat/Long</th>
<th>Forecast</th>
<th>Expected Temperature (F)</th>
<th>Expected Rainfall (in/hr)</th>
</tr>

<?php


$today = getdate();

$day = $today['mday'];
$day = $day + 1;

if($day<10) 
{
$day = "0" . $day;
} 
else 
{
$day = $today['mday'];
}

if($month = $today['mon']<10)
{
$month = "0" . $today['mon'];
}
else
{
$month = $today['mon'];
}

$year = $today['year'];

$url = "http://gd2.mlb.com/components/game/mlb/year_$year/month_$month/day_$day/master_scoreboard.json";

$cURL = curl_init();
curl_setopt($cURL, CURLOPT_URL, $url);
curl_setopt($cURL, CURLOPT_HTTPGET, true);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json'
));
curl_setopt($cURL, CURLOPT_FAILONERROR, false);

$result = curl_exec($cURL);
curl_close($cURL);
$data = json_decode($result, true);

foreach($data['data']['games']['game'] as $games)
{
$gametime = $games['time_date'] . " " . $games['ampm'];

$gametimeepoch = strtotime($gametime);

$address = $games['venue'];
$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
$output= json_decode($geocode);
$lat = $output->results[0]->geometry->location->lat;
$long = $output->results[0]->geometry->location->lng;

$dsurl = "https://api.forecast.io/forecast/05a58263279dde9059158665f6ac6c71/$lat,$long,$gametimeepoch";
$cURL = curl_init();
curl_setopt($cURL, CURLOPT_URL, $dsurl);
curl_setopt($cURL, CURLOPT_HTTPGET, true);
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json'
));
curl_setopt($cURL, CURLOPT_FAILONERROR, false);
$dsresult = curl_exec($cURL);
curl_close($cURL);
$dsResponse = json_decode($dsresult, true);
$rainRate = $dsResponse['currently']['precipIntensity'];
$rainProb = $dsResponse['currently']['precipProbability'] * 100;
$temperature = $dsResponse['currently']['temperature'];
$weathersummary = $dsResponse['currently']['summary'];
$home_team = $games['home_team_name'];
$away_team = $games['away_team_name'];

if ($rainProb > 50)
{
echo '<tr bgcolor="red">';
}
else
{
echo '<tr>';
}

echo  '<td>' . $home_team . ' vs ' . $away_team . '</td>';
echo  '<td>' .  $games['away_probable_pitcher']['first_name'] . ' ' . $games['away_probable_pitcher']['last_name'] . ' vs ' . $games['home_probable_pitcher']['first_name'] . ' ' . $games['home_probable_pitcher']['last_name'] . '</td>';
echo  '<td>' . $gametime . ' ' . $games['home_time_zone'] . '</td>';
echo  '<td>' . $address . ', ' . $lat . '/' . $long . '</td>';
echo '<td align="center" valign="middle">' . $weathersummary . ' with a ' . $rainProb . '% chance of rain</td>';
echo '<td align="center" valign="middle">' . $temperature . '</td>';
echo '<td align="center" valign="middle">' . $rainRate . '</td>';
echo '</tr>';
}

echo $url;
?>

</html>
