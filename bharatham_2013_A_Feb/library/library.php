<?php

include_once('db_common.php');
                  
function listz($typez)
                 
                  {
                        $link = connect();
                        $eventz = "";
                        $result = mysql_query('SELECT event FROM events where type = \''.$typez.'\''); 
                        check($result);
                        while($myrow = mysql_fetch_row($result))
                                    {
                                      $eventz = $eventz."<option>".$myrow[0]."</option>";   
                                    }  
                        return $eventz ; 
                  }                                

?>
