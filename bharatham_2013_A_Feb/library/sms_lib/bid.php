<?php

function bid()
        {
               $link = connect() ;

             if ( isset($_POST['check']) &&  $_POST['check'] == 'bid' )
                {
                   $result =  mysql_query('UPDATE current_sms_status SET bid=\''.$_POST['bid'].'\'');
                   check($result);
                } 
             
             $result = mysql_query('SELECT bid FROM current_sms_status');
             check($result);                                 
             $myrow = mysql_fetch_row($result) ;

             $body ='<form method="post" action="index.php?go=sms&sq=bid">
                          <div class="message" style="background:black;"> Bid N Win (Item) </div>

                              <div id="line"><div class="linel">Current Item: </div> <div class="liner">'.$myrow[0].'</div></div>
                              <div id="line"><div class="linel">New Item to Bid  : </div> <div class="liner"><input type="text" name="bid" />  </div></div>
                              <input type="hidden" name="check" value="bid" />
                              <div id="line"> <div class="linel">&nbsp;</div><div class="liner"> <input type="submit" value="Update" style="width:100px;height:35px;"/>  </div></div> 
                        
                     </form> ';

             return $body ; 
          
        }
?>