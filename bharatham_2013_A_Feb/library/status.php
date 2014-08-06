<?php
  
  
function status()
     {
         $link = connect();
         if( isset($_POST['check'] ) )
             {
                 if($_POST['check'] == 'status')
                   {
                       $result = mysql_query('update track set center =\''.$_POST['status'].'\' where id = 1') ;
                       check($result);
                    }
                 elseif ($_POST['check'] == 'msg') 
                    {
                       $result = mysql_query('insert into center_message (msg) values (\''.$_POST['message'].'\')') ;
                       check($result);
                    }      
             }

          $result = mysql_query('select center from track where id = 1 ') ;
          check($result);
          $row1 = mysql_fetch_row($result) ;


          $result = mysql_query('select msg from center_message where id = (select max(id) from center_message)') ;
          check($result);
          $row2 = mysql_fetch_row($result) ;

          $page = '
                        <div class="message" style="background:black;"> Center Screen Control</div>
                        <form method="post" action="index.php?go=status">      
                                <div id="line"><div class="linel">Currrent : </div> <div class="liner"><b>'.$row1[0].'</b></div></div>
                                <div id="line"><div class="linel">Choose  :   </div> <div class="liner">
                                                           <select name="status">
                                                                       <option> Photos </option>
                                                                       <option> Winners </option>
                                                                       <option> Bid </option>
                                                                       <option> Poll </option>
                                                           </select> 
                                                    </div></div> 
                                <input type="hidden" name="check" value="status" />
                                <div id="line"> <div class="linel">&nbsp;</div><div class="liner"> <input type="submit" value="Submit" style="width:100px;height:35px;"/>  </div></div> 
                     
                        </form>
                        <form method="post" action="index.php?go=status">      
                                <div id="line"><div class="linel">Currrent : </div> <div class="liner"><b>'.$row2[0].'</b></div></div>
                                <div id="line"><div class="linel">New Message  :   </div> <div class="liner"> <input type="text" name="message" /> </div></div> 
                                <input type="hidden" name="check" value="msg" />
                                <div id="line"> <div class="linel">&nbsp;</div><div class="liner"> <input type="submit" value="Submit" style="width:100px;height:35px;"/>  </div></div> 
                     
                        </form>' ;   
          return $page;               
     }
 

?>
