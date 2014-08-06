<?php

include_once('../db_common.php');

if(isset($_GET['q']))
   {
     $link = connect();

     if($_GET['amp;sq'] == 'feed')
           {
              if($_GET['q'] == 'accept')
              {
                 $query = 'insert into feeds (qstn,number,msg,adate) select qstn,number,msg,adate from feeds_temp where id=\''.$_GET['amp;id'].'\';' ;
                 $result = mysql_query($query);
                 check($result);
                 $query = 'delete from feeds_temp where id=\''.$_GET['amp;id'].'\'' ;
                 $result = mysql_query($query);
                 check($result); 
                 echo getnext(); 

              }
              elseif($_GET['q'] == 'decline')
               {
                 $query = 'delete from feeds_temp where id=\''.$_GET['amp;id'].'\'' ;
                 $result = mysql_query($query);
                 check($result);
                 echo getnext(); 
               } 
              else
               {   echo 'Invalid request.(q)(sq)(feed)' ;} 

           }
     elseif ($_GET['amp;sq'] == 'review') 
           {
              
              if($_GET['q'] == 'accept')
              {
                 $query = 'insert into review (qstn,number,msg,adate) select qstn,number,msg,adate from review_temp where id=\''.$_GET['amp;id'].'\';' ;
                 $result = mysql_query($query);
                 check($result);
                 $query = 'delete from review_temp where id=\''.$_GET['amp;id'].'\'' ;
                 $result = mysql_query($query);
                 check($result); 
                 echo getnext(); 

              }
              elseif($_GET['q'] == 'decline')
               {
                 $query = 'delete from review_temp where id=\''.$_GET['amp;id'].'\'' ;
                 $result = mysql_query($query);
                 check($result);
                 echo getnext(); 
               } 
              else
               {   echo 'Invalid request.(q)(sq)(feed)' ;} 
           } 
     else
           {
              echo 'Invalid request.(q)' ; 
           }

   }

else
  { echo 'Invalid request.' ; }


function getnext()
   {

   if( $_GET['amp;sq'] == 'feed' )
        {
             $result = mysql_query("SELECT number,msg,id FROM feeds_temp where id=(select max(id) from feeds_temp)");
             check($result);                                 
             $row1 = mysql_fetch_row($result) ;

             is_null($row1[0]) ? $feed = 'No more requests.' : $feed ='<div class="box" style="width:80%;">
                        <div class="line" style="margin:8px;"><b>From : '.$row1[0].' </b></div>
                        <div class="line"> </div> 
                        <div class="line" style="margin:8px;"><b>'.$row1[1].' </b></div>
                        <div class="line"> </div>
                        <div class="url1" style="display:none;">./library/sms_lib/accept.php?q=accept&sq=feed&id='.$row1[2].'</div>
                        <div class="url2" style="display:none;">./library/sms_lib/accept.php?q=decline&sq=feed&id='.$row1[2].'</div>
                        <div class="line">
                              <div class="order-button" id="bttn1">Accept </div></a>
                              <div class="order-button" id="bttn2">Decline</div></a>
                        </div>
                    </div>  ';
             return $feed;       
        }  

   elseif( $_GET['amp;sq'] == 'review')
        { 
             $result = mysql_query("SELECT number,msg,id FROM review_temp where id=(select max(id) from review_temp)");
             check($result);                                 
             $row2 = mysql_fetch_row($result) ;


             is_null($row2[0]) ? $review = 'No more requests.' : $review ='<div class="box" style="width:80%;">
                        <div class="line" style="margin:8px;"><b>From : '.$row2[0].' </b></div>
                        <div class="line"> </div> 
                        <div class="line" style="margin:8px;"><b>'.$row2[1].' </b></div>
                        <div class="line"> </div>
                        <div class="url1" style="display:none;">./library/sms_lib/accept.php?q=accept&sq=review&id='.$row2[2].'</div>
                        <div class="url2" style="display:none;">./library/sms_lib/accept.php?q=decline&sq=review&id='.$row2[2].'</div>
                        <div class="line">
                              <div class="order-button" id="bttn3">Accept </div></a>
                              <div class="order-button" id="bttn4">Decline</div></a>
                        </div>
                    </div>  ';
             return $review;       
        }            
   }

?>