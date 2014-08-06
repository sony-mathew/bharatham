<?php

function bidss($r)
{
//processing bids
include_once('./db_common.php');
$link = connect();

         if( strlen($r) > 2 )   
             { 
  
               $r = strtolower($r);
               $r = str_replace('bha bid','', $r);
               $fe = explode('{line-delimiter}', $r ) ;   
            
               for( $i = 0 ; isset($fe[$i]) ; ++$i )
                  {

                  if( strlen($fe[$i]) > 2 )
                    {  
  
                      $fee = explode('{seperator}', $fe[$i]) ;
                      $fee[1] = str_replace(' ', '', $fee[1]) ;
                      $fee[1] = trim($fee[1]);

                      $query = 'select bid from current_sms_status ';
                      $result = mysql_query($query) ;
                      check($result);
                      $myrow = mysql_fetch_row($result);
                      $title = $myrow[0];

                               
                      if( is_numeric($fee[1]) && $fee[1]< 201 && $fee[1] > 0 )
                          {  

                             
                              $query = 'select id,mob from bid where (mob=\''.$fee[0].'\' and status = 1 and title=\''.$title.'\')';
                              $result = mysql_query($query) ;
                              check($result);
                              $row = mysql_fetch_row($result);
                            

                              if(strlen($row[1]) > 2 )
                                   {
                                               $query = 'update bid set number=\''.$fee[1].'\' where (id=\''.$row[0].'\' and title = \''.$title.'\' and status =1)';
                                               $result = mysql_query($query) ;
                                               check($result);                                           
                                               $query = 'update bid set status=0  where (number=\''.$fee[1].'\' and title = \''.$title.'\')';
                                               $result = mysql_query($query) ;
                                               check($result);
                                   }
                              else
                                  {  
                                     $query = 'select id,mob from bid where number=\''.$fee[1].'\' and status=1 and title = \''.$title.'\'';
                                     $result = mysql_query($query) ;
                                     check($result);
                                     $kool = mysql_fetch_row($result);
                               
                             
                                     if(strlen($kool[1]) > 0)
                                          {
                                               $query = 'update bid set status=0  where (number=\''.$fee[1].'\' and title = \''.$title.'\')';
                                               $result = mysql_query($query) ;
                                               check($result);       
                                          }
                                     else
                                           {
                                               $query = 'insert into bid (title,mob,number,status) values (\''.$title.'\',\''.$fee[0].'\',\''.$fee[1].'\' ,1)';
                                               $result = mysql_query($query) ;
                                               check($result); 
                                           }
                                  }
                   }}}}               
 }
?>