<?php

include_once('./db_common.php');

  array_walk_recursive($_POST, 'sanitizeVariables'); 
  array_walk_recursive($_GET, 'sanitizeVariables'); 



if     ( $_POST['login'] == 1)
	  {
         if( $_POST['user'] == 'bharatham' && $_POST['pass'] = 'ynos' )
           { 
              setcookie('bharatham' , 'pilla ennum pilla thanne' , time() + 3600 ) ;
              echo 'You have been succesfully logged in.';
            }                               
                             
	  }

elseif ( $_POST['logout'] == 1 )
	  {
              setcookie('bharatham' , 'pilla ennum pilla thanne' , time() - 3600 ) ;
              unset($_COOKIE['bharatham']);
              echo 'You have been succesfully logged out.';
	  } 

elseif ( validate() == 1 )
      {
          $page = file_get_contents('./index.html') ;    
              if($_POST['check'] == 1 )
              	 {
                    $con = connect();
                    $query = 'insert into std (name,mobile,year,branch) values (\''.$_POST['name'].'\',\''.$_POST['phone'].'\',\''.$_POST['year'].'\',\''.$_POST['branch'].'\') ' ;
                    if(mysql_query($query))  { echo str_replace('{msg}', 'Thank you. Your submission was succesfull.', $page) ; }
                    else                            { echo str_replace('{msg}', 'Sorry, there was some problem with your submission.', $page) ; }
              	 }
              elseif($_GET['show'] == 'database')
                 {
                    $con = connect() ;
                    $body = '<html> <head> <link rel="stylesheet" type="text/css" href="style.css" media="screen" /> </head> 
                                     <body> 
                                         <table>
                                            <tr> 
                                               <th>Sl. No.</th>
                                               <th>Name</th>
                                               <th>Mobile</th>
                                               <th>Year</th>
                                               <th>Branch</th>
                                            </tr>   ';
                    $i = 0;                        
                    $query = 'select *from std order by id desc';
                    $result = mysql_query($query);
                    if($result)
                           {
                           	  while( $row = mysql_fetch_row($result) )
                           	  	 {
                                     $body = $body.'<tr><td>'.++$i.'</td>
                                                        <td>'.$row[1].'</td>
                                                        <td>'.$row[2].'</td>
                                                        <td>'.$row[3].'</td>
                                                        <td>'.$row[4].'</td>
                                                    </tr>  ';
                           	  	 }
                           	  echo $body . '</table> </body> </html>';

                           }   
                    else
                           { echo 'Nothing in the database.' ; }        
                 }	
              else
                 {
                    echo str_replace('{msg}', '', $page) ;   
                 }    
      }	
else
	  {
	  	       echo str_replace('{date}', date('d:m:Y h:m:s'), file_get_contents('./login.html') ) ;
	  }


function validate()
       {
       	  if( $_COOKIE['bharatham'] == 'pilla ennum pilla thanne')   return 1 ;
       	  else                                                       return 0 ; 
       }
?>