<?php


function review()
        {
             $link = connect() ;

             if ( isset($_POST['check']) &&  $_POST['check'] == 'review' )
                {
                   $result =  mysql_query('UPDATE current_sms_status SET review=\''.$_POST['review'].'\'');
                   check($result);
                } 
             
             $result = mysql_query('SELECT review FROM current_sms_status');
             check($result);                                 
             $myrow = mysql_fetch_row($result) ;

             $body ='<form method="post" action="index.php?go=sms&sq=review">
                          <div class="message" style="background:black;"> Review Event Name </div>

                              <div id="line"><div class="linel">Current : </div> <div class="liner">'.$myrow[0].'</div></div>
                              <div id="line"><div class="linel">New Event  : </div> <div class="liner"><input type="text" name="review" />  </div></div>
                              <input type="hidden" name="check" value="review" />
                              <div id="line"> <div class="linel">&nbsp;</div><div class="liner"> <input type="submit" value="Update" style="width:100px;height:35px;"/>  </div></div> 
                        
                     </form> ';

             return $body ;  
                
        } 

?>
