<?php

include_once('./db_common.php');

function count_cheers($num)
       {
       	  $num = substr($num, 2);
          
          $link = connect();

       	  $query = 'select house from std where mobile = \''.$num.'\'';
       	  $result = mysql_query($query) ;
          check($result) ;

          $row = mysql_fetch_row($result);
          if( strlen($row[0]) > 2 )
          	   {
          	   	  if($row[0] == 'Mughals')
          	   	  	  { $query = 'update cheers set mughals = mughals+1' ; }

          	   	  elseif($row[0] == 'Rajputs')
          	   	  	  { $query = 'update cheers set rajputs = rajputs+1' ; }
          	   	  
          	   	  elseif($row[0] == 'Aryans')
          	   	  	  { $query = 'update cheers set aryans = aryans+1' ; }

          	   	  elseif($row[0] == 'Spartans')
          	   	  	  { $query = 'update cheers set spartans=spartans+1' ; }
          	   	  
          	   	  elseif($row[0] == 'Vikings')
          	   	  	  { $query = 'update cheers set vikings=vikings+1' ; }	  	

          	   	  $result = mysql_query($query) ;
          	   	  check($result);	    	  	
          	   }

       }

?>