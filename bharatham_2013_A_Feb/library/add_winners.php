<?php


function add_winners()
        {
            
           include_once('./library/library.php');
           include_once('./library/db_common.php');

            if( isset($_POST['check']) )
                 {
                    $flag = 0 ;
                    $link = connect(); 
                    $result = mysql_query('insert into latest_results (event) values (\''.$_POST['event'].'\')');
                    check($result);

                    for( $i = 1 ; $i < 7 ; ++$i )
                       {
                            if( strlen($_POST['name_'.$i]) > 1 )
                                   {           
                                      ++$flag;
                                      $r2 = strtolower($_POST['position_'.$i]);
            
                                      $result =  mysql_query('select * from events where event = \''.$_POST['event'].'\'');           
                                      check($result) ;
                                      $temp = mysql_fetch_row($result) ;

                                       if      ($r2 == "first")
                                                          { $point = $temp[3] ; }
                                       else if ( $r2 == "second" ) 
                                                          { $point = $temp[4] ; }
                                       else if  ( $r2 == "third" ) 
                                                          { $point = $temp[5] ; }             

                                      $result = mysql_query('insert into score (name , position , event , grp , point ) values  
                                                              ( \''.$_POST['name_'.$i].'\',\''.strtolower($_POST['position_'.$i]).'\',
                                                              \''.$_POST['event'].'\',\''.$_POST['group_'.$i].'\',\''.$point.'\' )' );
                                      check($result);
                                   }
                        } 
                    $page = '<div class="message" style="background:deepskyblue;"> Succesfully inserted into database. ( '.$flag.' Entries) </div>';              
                 }
            else
                 {
                    $page = file_get_contents("./library/pages/add_winners.html");
                    
                    if( $_GET['go']=='win_indi')          {  $event = listz("Individual");  $type = 'Individual' ;  $field = 'Name    : ' ; $link = 'win_indi' ; }
                    elseif($_GET['go']=='win_grp')        {  $event = listz("Group")     ;  $type = 'Group'      ;  $field = 'Captain : ' ; $link = 'win_grp' ;  }
                    elseif($_GET['go']=='win_dual')       {  $event = listz("Dual")      ;  $type = 'Dual'       ;  $field = 'Members : ' ; $link = 'win_dual' ; }
                   
                    $page = str_replace('{event_type}',$type ,$page);
                    
                    $page = str_replace('{event_list}',$event,$page);
                   
                    $page = str_replace('Name :' ,$field,$page); 

                    $page = str_replace('{link}' ,$link,$page); 
                 }     
            return $page;     
        } 

?>
