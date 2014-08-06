<?php

include_once('./db_common.php');

$link = connect();
$result = mysql_query('SELECT feed FROM current_sms_status');
check($result) ;
$row = mysql_fetch_row($result);
// $i  = strlen($row[0]);
// $log = substr($row[0], 0 , (int)($i/2) ).'<br />'.substr($row[0], (int)(($i+1)/2));
echo $row[0];

?>