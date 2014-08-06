<?php


include_once('./db_common.php');
include_once('./cheers.php');
include_once('./test.php');

$link = connect();

$f = sanitizeText(file_get_contents('http://fastbits.in/sms/feeds.php?dump=chumma')) ;

$r = sanitizeText(file_get_contents('http://fastbits.in/sms/reviews.php?dump=chumma')) ;

$p = sanitizeText(file_get_contents('http://fastbits.in/sms/polls.php?dump=chumma')) ;

$b = sanitizeText(file_get_contents('http://fastbits.in/sms/bids.php?dump=chumma')) ;

//logging all sms contents            
            $log = $f.$r.$p;
            $fa=fopen('./sms_log.txt','ab');  
            fwrite($fa,$log); 
            fclose($fa);

            $fa=fopen('./sms_feed.txt','ab');  
            fwrite($fa,$f); 
            fclose($fa);

            $fa=fopen('./sms_review.txt','ab');  
            fwrite($fa,$r); 
            fclose($fa);

            $fa=fopen('./sms_poll.txt','ab');  
            fwrite($fa,$p); 
            fclose($fa);

            $fa=fopen('./sms_bid.txt','ab');  
            fwrite($fa,$b); 
            fclose($fa);

//processing feeds
         if( strlen($f) > 2 )   
             {
               $f = strtolower($f);
               $f = str_replace('bha feed','', $f);
               $fe = explode('{line-delimiter}', $f ) ;   
            
               for( $i = 0 ; isset($fe[$i]) ; ++$i )
                  { 
                    if( strlen($fe[$i]) > 2 )
                    { 
                      $fee = explode('{seperator}', $fe[$i]) ;
                      count_cheers($fee[0]);
                      $query = 'insert into feeds_temp (qstn,number,msg,adate) values ( \''.qstn(0).'\',\''.$fee[0].'\',\''.$fee[1].'\' ,\''.$fee[2].'\' )';
                      $result = mysql_query($query) ;
                      check($result);
                     } 
                  }
              }
//processing reviews
         if( strlen($r) > 2 )   
             { 

               $r = strtolower($r);
               $r = str_replace('bha review','', $r);
               $fe = explode('{line-delimiter}', $r ) ;   
               
               for( $i = 0 ; isset($fe[$i]) ; ++$i )
                  {
                    if( strlen($fe[$i]) > 2 )
                     {  
                      $fee = explode('{seperator}', $fe[$i]) ;
                      count_cheers($fee[0]);
                      $query = 'insert into review_temp (qstn,number,msg,adate) values ( \''.qstn(1).'\',\''.$fee[0].'\',\''.$fee[1].'\' ,\''.$fee[2].'\' )';
                      $result = mysql_query($query) ;
                      check($result);
                      } 
                  }
              }

//processing polls
         if( strlen($p) > 2 )   
             
             { 
               
               $p = strtolower($p);
               $p = str_replace('bha poll','', $p);
               $fe = explode('{line-delimiter}', $p ) ;   
               
               for( $i = 0 ; isset($fe[$i]) ; ++$i )
                  {
                    if( strlen($fe[$i]) > 2 )
                    {
                      $fee = explode('{seperator}', $fe[$i]) ;
                      count_cheers($fee[0]);
                      $query = 'select max(id) from poll';
                      $result = mysql_query($query);
                      check($result);
                      $id = mysql_fetch_row($result);
                      $fee[1] = str_replace(' ', '', $fee[1]);                      

                      if($fee[1] == 'M' || $fee[1] == 'm' )
                                { $query = 'update poll set mughals=mughals+1 where id =\''.$id[0].'\'' ; }
                      if($fee[1] == 'R' || $fee[1] == 'r' )
                                { $query = 'update poll set rajputs=rajputs+1 where id =\''.$id[0].'\'' ; }
                      if($fee[1] == 'A' || $fee[1] == 'a' )
                                { $query = 'update poll set aryans=aryans+1 where id =\''.$id[0].'\'' ; }
                      if($fee[1] == 'S' || $fee[1] == 's' )
                                { $query = 'update poll set spartans=spartans+1 where id =\''.$id[0].'\'' ; }
                      if($fee[1] == 'V' || $fee[1] == 'v' )
                                { $query = 'update poll set vikings=vikings+1 where id =\''.$id[0].'\'' ; }                  
                      if( strlen($query) > 2 )
                           {
                             $result = mysql_query($query) ;
                             check($result);
                           } 
                    }       
                  }
              }

//processing bids
$g = bidss($b);             
//$g = '';
//refreshing page echo
echo '<title>Refresh Page </title><meta http-equiv="refresh" content="10;"> 
            <br/><br/> <b> FEEDS </b><br/> '.$f.' 
            <br/><br/><b> REVIEWS </b> <br/>'.$r.'
            <br/><br/><b> POLLS </b><br/> '.$p.'
            <br/><br/><b> BIDS </b> <br/>'.$b ;


function qstn($i)
           {
              $which = array('feed','review' ,'bid' ) ;

              $query = 'select '.$which[$i].' from current_sms_status';
              $result = mysql_query($query) ;
              check($result);
              $row = mysql_fetch_row($result) ;
              return $row[0];
           }


            
?>