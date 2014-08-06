<?php

function feed()
          {
             $link = connect() ;

             if ( isset($_POST['check']) &&  $_POST['check'] == 'feeds' )
                {
                   $result =  mysql_query('UPDATE current_sms_status SET feed=\''.$_POST['feed'].'\'');
                   check($result);
                } 
             
             $result = mysql_query('SELECT feed FROM current_sms_status');
             check($result);                                 
             $myrow = mysql_fetch_row($result) ;

             $body ='<form method="post" action="index.php?go=sms&sq=feed">
                          <div class="message" style="background:black;"> Feeds Question </div>

                              <div id="line"><div class="linel">Current : </div> <div class="liner">'.$myrow[0].'</div></div>
                              <div id="line"><div class="linel">New Question  : </div> <div class="liner"><input type="text" name="feed" />  </div></div>
                              <input type="hidden" name="check" value="feeds" />
                              <div id="line"> <div class="linel">&nbsp;</div><div class="liner"> <input type="submit" value="Update" style="width:100px;height:35px;"/>  </div></div> 
                        
                     </form> ';

             return $body ; 
          }


?>