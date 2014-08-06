<?php

 if (isset($_GET['message']) && isset($_GET['from']))
      {
            $dt = date("Y-m-d h:i:s");
            $log= $_GET['from'].'{seperator}'.$_GET['message'].'{seperator}'.$dt.'{line-delimiter}';
            $fa=fopen('./polls.txt','ab');  
            fwrite($fa,$log); 
            fclose($fa);
            echo 'Thank You for polling.';
      }
 elseif (isset($_GET['dump'])) 
      {
            echo file_get_contents('./polls.txt');
            $fa=fopen('./polls.txt','w');  
            fclose($fa);
      } 

?>