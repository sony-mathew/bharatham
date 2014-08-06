<?php
  
  
function negetive()

      {              
             $link = connect() ;           
             if ( isset($_POST['check']) &&  $_POST['check'] == 'negetive_marks' )
                {
                   $result =  mysql_query('UPDATE negetive SET mughals=\''.$_POST['mughals'].'\',rajputs=\''.$_POST['rajputs'].'\',vikings=\''.$_POST['vikings'].'\'
                                                               ,aryans=\''.$_POST['aryans'].'\',spartans=\''.$_POST['spartans'].'\'');
                   check($result);
                } 
             
             $result = mysql_query('SELECT * FROM negetive');
             check($result);                                 
             $myrow = mysql_fetch_row($result) ;

             $body =' 
                     <form method="post" action="index.php?go=negetive_marks">
                          <div class="message" style="background:black;"> Negetive marks </div>

                              <div id="line"><div class="linel">Mughals : </div> <div class="liner"><input type="text" name="mughals" value="'.$myrow[0].'" /></div></div>
                              <div id="line"><div class="linel">Rajputs  :   </div> <div class="liner"><input type="text" name="rajputs" value="'.$myrow[1].'" />  </div></div>
                              <div id="line"><div class="linel">Aryans  :   </div> <div class="liner"><input type="text" name="aryans" value="'.$myrow[3].'" />   </div></div>
                              <div id="line"><div class="linel">Vikings  :   </div> <div class="liner"><input type="text" name="vikings" value="'.$myrow[2].'" /></div></div>
                              <div id="line"><div class="linel">Spartans  :   </div> <div class="liner"><input type="text" name="spartans" value="'.$myrow[4].'" />   </div></div>
                              <input type="hidden" name="check" value="negetive_marks" />
                              <div id="line"> <div class="linel">&nbsp;</div><div class="liner"> <input type="submit" value="Update" style="width:100px;height:35px;"/>  </div></div> 
                        
                     </form> ';

             return $body ;                
      }  

 

?>
