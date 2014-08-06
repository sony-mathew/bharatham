<?php
  
  
function poll()
        {
             $link = connect() ;

             if ( isset($_POST['check']) &&  $_POST['check'] == 'poll' )
                {
                   $result =  mysql_query('UPDATE current_sms_status SET poll=\''.$_POST['poll'].'\'');
                   check($result);
                   $result =  mysql_query('insert into poll (event,mughals,rajputs,aryans,spartans,vikings) values (\''.$_POST['poll'].'\',0,0,0,0,0)');
                   check($result);
                } 
             
             $result = mysql_query('SELECT poll FROM current_sms_status');
             check($result);                                 
             $myrow = mysql_fetch_row($result) ;

             $body ='<form method="post" action="index.php?go=sms&sq=poll">
                          <div class="message" style="background:black;"> Polling Event </div>

                              <div id="line"><div class="linel">Current : </div> <div class="liner">'.$myrow[0].'</div></div>
                              <div id="line"><div class="linel">New Event  : </div> <div class="liner"><input type="text" name="poll" />  </div></div>
                              <input type="hidden" name="check" value="poll" />
                              <div id="line"> <div class="linel">&nbsp;</div><div class="liner"> <input type="submit" value="Update" style="width:100px;height:35px;"/>  </div></div> 
                        
                     </form> ';

             return $body ;  
                
        } 
 

?>
