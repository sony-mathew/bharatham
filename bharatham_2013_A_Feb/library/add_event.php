<?php

function add_event()
          {
            if( isset($_POST['check']) && $_POST['check'] == 'add_event' )
                  {
                       $link = connect();
                       $result = mysql_query('insert into events (event , type , first , second , third)  values  ( \''.$_POST['event'].'\' , 
                        \''.$_POST['event_type'].'\' , \''.$_POST['point_first'].'\',\''.$_POST['point_second'].'\', \''.$_POST['point_third'].'\' )' );
                        check($result);
                       return '<div class="message" style="background:deepskyblue;"> Succesfully added the event.</div>';                            
                  }
            else
                  {
                       return file_get_contents("./library/pages/add_event.html");
                  }  
          }


?>