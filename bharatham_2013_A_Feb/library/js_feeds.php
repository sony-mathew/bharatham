<?php

include_once('./db_common.php');
include_once('./names.php');

$link = connect();
$result = mysql_query('SELECT number,msg FROM feeds where (qstn = (SELECT feed FROM current_sms_status)) order by id desc limit 5');
check($result) ;
$log = '';
while($row = mysql_fetch_row($result))
    {
        $log = $log.'<b>'.name($row[0]).'</b> says : <br/>'.$row[1].'*###*'; 
    }

echo $log;


?>