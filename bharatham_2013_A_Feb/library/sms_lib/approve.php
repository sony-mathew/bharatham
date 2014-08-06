<?php
  
  
function approve()
     {
       $link = connect() ;
             
             $body = file_get_contents('./library/pages/approve.html');

             $result = mysql_query("SELECT number,msg,id FROM feeds_temp where id=(select max(id) from feeds_temp)");
             check($result);                                 
             $row1 = mysql_fetch_row($result) ;

             $result = mysql_query("SELECT number,msg,id FROM review_temp where id=(select max(id) from review_temp)");
             check($result);                                 
             $row2 = mysql_fetch_row($result) ;

             is_null($row1[0]) ? $feed = '<meta http-equiv="refresh" content="10;">No more requests.' : $feed ='<meta http-equiv="refresh" content="10;"><div class="box" style="width:80%;">
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


             is_null($row2[0]) ? $review = '<meta http-equiv="refresh" content="10;">No more requests.' : $review ='<meta http-equiv="refresh" content="10;"><div class="box" style="width:80%;">
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

             $body = str_replace('{content-feed-replace}', $feed, $body);
             $body = str_replace('{content-review-replace}', $review, $body); 

             echo $body ;
             exit;                  
       
     }
 

?>
