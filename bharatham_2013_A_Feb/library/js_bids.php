<?php

include_once('./db_common.php');
include_once('./names.php');

$link = connect();

$result = mysql_query('SELECT bid FROM current_sms_status');
check($result) ;
$mrow = mysql_fetch_row($result);


$result = mysql_query('SELECT mob FROM bid where (status=1 and title=\''.$mrow[0].'\') order by number limit 20');
check($result) ;

$log = $mrow[0].';';
while($row = mysql_fetch_row($result))
    {
        $log = $log.name($row[0]).';'; 
    }

echo $log;


?>