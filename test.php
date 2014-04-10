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
echo $games['home_team_name'] . " vs " . $games['away_team_name'] . "\n";
echo $games['away_probable_pitcher']['first_name'] . " " . $games['away_probable_pitcher']['last_name'] . " vs " . $games['home_probable_pitcher']['first_name'] . " " . $games['home_probable_pitcher']['last_name'] . "\n";
$gametime = $games['time_date'] . " " . $games['ampm'];

echo $gametime . "\n";
$gametimeepoch = strtotime($gametime);

$address = $games['venue'];
$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
$output= json_decode($geocode);
$lat = $output->results[0]->geometry->location->lat;
$long = $output->results[0]->geometry->location->lng;
echo $address . "\n" . $lat . " " . $long . "\n";

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
$rainProb = $dsResponse['currently']['precipProbability'];
$temperature = $dsResponse['currently']['temperature'];
$weathersummary = $dsResponse['currently']['summary'];

echo $temperature . " degrees F\n";
echo $rainRate . " inches per hour\n";
echo $weathersummary . " with a " . $rainProb . "% chance of rain\n";
//echo $dsurl . "\n\n";
}
/*
$home_team = $data['data']['games']['game']['1']['home_team_name'];
$away_team = $data['data']['games']['game']['1']['away_team_name'];
$home_city = $data['data']['games']['game']['1']['home_team_city'];
$away_last_name = $data['data']['games']['game']['1']['away_probable_pitcher']['last_name'];
$away_first_name = $data['data']['games']['game']['1']['away_probable_pitcher']['first_name'];
$home_last_name = $data['data']['games']['game']['1']['home_probable_pitcher']['last_name'];
$home_first_name = $data['data']['games']['game']['1']['home_probable_pitcher']['first_name'];

echo $home_first_name . " " . $home_last_name . " pitching for " . $home_team . " and " . $away_first_name . " " . $away_last_name . " pitching for " . $away_team . " playing in " . $home_city . "\n";

$games = $data['data']['games']['game'];

var_dump($games);

var_dump($last_name);
echo "\n";
var_dump($first_name);
*/
/*
$wbObservationTime = $data1['otls'];
$wbStation = $data1['si'];
$wbhumidity = $data1['h'];
$wbrainRate = $data1['rr'];
$wbtemperature = $data1['t'];
$wbrealTemp = $data1['fl'];


if (!is_null($wbObservationTime)) 
{
echo '<table border="1">';
echo '<tr>';
echo  '<th>Attribute</th>';
echo  '<th>Weatherbug</th>';
echo '<th>Accuweather</th>';
echo '<th>DarkSky</th>';
echo '</tr>';
echo '<tr>';
echo  '<td>Observation Time</td>';
echo  '<td>' . $wbObservationTime . '</td>';
echo  '<td>' . $awobservationTime . '</td>';
echo  '<td>' . $dsObservationTime . '</td>';
echo '</tr>';
echo '<tr>';
echo  '<td>Station ID</td>';
echo  '<td>' . $wbStation . '</td>';
echo  '<td>' . $awStation . '</td>';
echo  '<td></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Temperature (degrees F)</td>';
echo '<td>' . $wbtemperature . '</td>';
echo '<td>' . $awtemperature . '</td>';
echo '<td>' . $dstemperature . '</td>';
echo '</tr>';
echo '<tr>';
echo '<td>Feels Like Temperature (degrees F)</td>';
echo '<td>' . $wbrealTemp . '</td>';
echo '<td>' . $awrealTemp . '</td>';
echo '<td>' . $dsrealTemp . '</td>';
echo '</tr>';
echo '<tr>';
echo '<td>Humidity (%)</td>';
echo '<td>' . $wbhumidity . '</td>';
echo '<td>' . $awhumidity . '</td>';
echo '<td>' . $dshumidity . '</td>';
echo '</tr>';
echo '<tr>';
echo '<td>1 Hour Precipitation</td>';
echo '<td>' . $wbrainRate . '</td>';
echo '<td>' . $awrainHour . '</td>';
echo '<td>' . $dsrainRate . '</td>';
echo '</tr>';
echo '</table>';
}
*/

?>
