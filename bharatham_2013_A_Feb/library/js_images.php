<?php
  
include_once('./db_common.php');

$link = connect();
$result = mysql_query('select images from track');
check($result) ;

$row = mysql_fetch_row($result) ;

echo $row[0];


?>
