<?php

include_once('./db_common.php');

$link = connect();
$result = mysql_query('SELECT review FROM current_sms_status');
check($result) ;
$row = mysql_fetch_row($result);
echo $row[0];

?>