<?php
  
  
include_once('./db_common.php');

include_once('./names.php');

$layout = file_get_contents("./layout.html");

$link = connect();
$result = mysql_query('SELECT bid FROM current_sms_status');
check($result) ;
$myrow = mysql_fetch_row($result);

$page = str_replace('{bid-item}',$myrow[0],$layout);


$result = mysql_query('SELECT mob FROM bid where (status=1 and title=\''.$myrow[0].'\') order by number limit 20');
check($result) ;

$i = 0 ; 
$logl = '';
$logr = '';
$first = '';
while($row = mysql_fetch_row($result))
    {
        ++$i ;
        if($i == 1 )
          {    $first = name($row[0]);  }
        if($i < 11 )
          {      $logl = $logl.'<h3 class="head-bar">'.$i.'. '.name($row[0]).'</h3>';  } 
        else
          {      $logr = $logr.'<h3 class="head-bar">'.$i.'. '.name($row[0]).'</h3>';   } 
    }

if(strlen($first)>0)
    {     $page = str_replace('{first}',$first,$page);            }
else
    {     $page = str_replace('{first}','',$page);            }  

if(strlen($logl)>0)
    {     $page = str_replace('{left-replace}',$logl,$page);      }
else
    {     $page = str_replace('{left-replace}','',$page);      }


if(strlen($first)>0)
    {     $page = str_replace('{right-replace}',$logr,$page);      }
else
    {     $page = str_replace('{right-replace}','',$page);      }

print $page;


?>
