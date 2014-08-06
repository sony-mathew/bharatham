<?php

function sms()
   {

    if( isset( $_GET['sq'] ) )
    {  
      
      if($_GET['sq']=='feed')      
          {         
                    include_once('./library/sms_lib/feed.php');
                    $page = feed(); 
          }  

      elseif($_GET['sq']=='review')  
          {         
                    include_once('./library/sms_lib/review.php');
                    $page = review();                     
          }

      elseif($_GET['sq']=='poll' )  
          {                            
                    include_once('./library/sms_lib/poll.php');
                    $page = poll(); 
          }

      elseif($_GET['sq']=='bid' )  
          {                            
                    include_once('./library/sms_lib/bid.php');
                    $page = bid(); 
          }

      elseif($_GET['sq']=='approve' )  
          {                            
                    include_once('./library/sms_lib/approve.php');
                    $page = approve(); 
          }
      else  
          {
               $page = file_get_contents('./library/pages/sms_home.html'); 
          }
    }
    else
          {
               $page = file_get_contents('./library/pages/sms_home.html');
          }         
    return $page;      
  }


?>