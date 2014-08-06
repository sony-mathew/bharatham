<?php

include_once('./db_common.php');

$link = connect();

$result = mysql_query('SELECT *FROM poll where id=(select max(id) from poll)');
check($result) ;

$row = mysql_fetch_row($result);
$log = '';
$large = max($row[2],$row[3],$row[4],$row[5],$row[6]);

for( $i = 2 ; $i < 7;++$i )
    {
    	if($row[$i] > 0 && $large > 0 )
    	{
    	   $row[$i] = (int)(($row[$i]*100)/$large);
    	 }  
        $log = $log.';'.$row[$i];
     }   
 echo $row[1].$log;         

?>