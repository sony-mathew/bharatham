<?php

include_once('./db_common.php');

function name($num)
       {
          $num = substr($num, 2);
          
          $link = connect();

          $query = 'select name from std where mobile = \''.$num.'\'';
          $result = mysql_query($query) ;
          check($result) ;

          $row = mysql_fetch_row($result);
          
          if( strlen($row[0]) > 1 )
               {     return $row[0] ;  }
          else {     return $num ;     }   

       }

?>