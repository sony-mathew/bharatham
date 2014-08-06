<?php
  
  

  include_once('./library/db_common.php');


  array_walk_recursive($_POST, 'sanitizeVariables'); 
  array_walk_recursive($_GET, 'sanitizeVariables'); 



  if(isset($_GET['go']))
    {
      if($_GET['go']=='add_event')      
          {         
                    include_once('./library/add_event.php');
                    $page = add_event(); 
          }  

      elseif($_GET['go']=='negetive_marks')  
          {         
                    include_once('./library/negetives.php');
                    $page = negetive();                     
          }

      elseif($_GET['go']=='win_indi' || $_GET['go']=='win_grp'|| $_GET['go']=='win_dual' )  
          {                            
                    include_once('./library/add_winners.php');
                    $page = add_winners(); 
          }

      elseif($_GET['go']=='status' )  
          {                            
                    include_once('./library/status.php');
                    $page = status(); 
          }

      elseif($_GET['go']=='upload' )  
          {                            
                    include_once('./library/upload.php');
                    $page = upload(); 
          }

      elseif($_GET['go']=='sms' )  
          {                            
                    include_once('./library/sms.php');
                    $page = sms(); 
          }                                
      else
          {
               $page = file_get_contents("./library/pages/home.html"); 
          }    
        
    }           
  else
          {
               $page = file_get_contents("./library/pages/home.html");          
          }





$layout = file_get_contents("./library/pages/layout.html");
$page = str_replace('{content-text-replace}',$page,$layout);

print $page;

 

?>
