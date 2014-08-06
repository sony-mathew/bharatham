<?php


include_once('./db_common.php');

$link = connect();
$result = mysql_query('SELECT msg FROM center_message WHERE id = ( SELECT MAX( id ) FROM center_message )');
check($result) ;

$row = mysql_fetch_row($result) ;

echo ucwords($row[0]);
   

?>
