<?php
  
include_once('./db_common.php');

$link = connect();

$house = array('Mughals','Vikings','Aryans','Spartans', 'Rajputs');
$points = array() ;

$result = mysql_query('select *from negetive');
check($result) ;
$neg = mysql_fetch_row($result);

$neg_order = array($neg[0],$neg[2],$neg[3],$neg[4],$neg[1]);

for( $i = 0 ; $i < 5 ; ++$i )
   {  
   	  $result = mysql_query('select sum(point) from score where grp=\''.$house[$i].'\'');
      check($result);
      $row =   mysql_fetch_row($result);
      $points[$i] =  $row[0] - $neg_order[$i] ;
   }

echo implode(';', $points);          
 

?>
