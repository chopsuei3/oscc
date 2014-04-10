<?php

$visitlog = 'visit_log.txt';

$visited = file_get_contents($visitlog);

if (is_null($visited))
{ 
$visited = FALSE;
}
if ($visited = FALSE) {
echo "One time SSN display: " . "\n";
echo "xxx-xx-xxxx";
$visited = TRUE;
file_put_contents($visitlog, $visited);
}

?>