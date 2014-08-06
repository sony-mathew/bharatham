<?php
  
include_once('./db_common.php');

$link = connect();

$result = mysql_query('select *from cheers');
check($result) ;
$row = mysql_fetch_row($result); 

$cheers = $row[1].';'.$row[5].';'.$row[3].';'.$row[4].';'.$row[2];

echo $cheers;
?>
