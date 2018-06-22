<?php
/*
$result = null;
$client = file_get_contents("https://www.papaki.com/ajax/json.aspx?f=get_afm_info&afm=69997");

$result = json_decode($client,true);
echo '<pre>';
if ($result && strlen($result['data']['ERRORCODE']) != 0) {
 var_dump($result);
}
else {
	var_dump($result);
}
echo '</pre>';
*/







$today_time = new DateTime(str_replace('/','-','30/11/2017'));
$expire_time = new DateTime(str_replace('/','-','25/01/2019'));
$diff = $today_time->diff($expire_time);
echo $diff->format('%R%a');

?>
