<?php

session_start();

include_once('./db_common.php');

$handler = connect();

zack :

if(isset($_SESSION['MAX_ID']))
	{		
		    $stack = $_SESSION['STACK'];
		    if($stack == NULL)
		           
		           { 
		            unset($_SESSION['MAX_ID']); 
		            goto zack ; 
		           }
		    
		    $query = "select max(id) from latest_results";
            $result = mysql_query( $query);
            
            $max = mysql_fetch_assoc($result) ;
		    $pres_max_id = $max['max(id)'];

		    if($_SESSION['MAX_ID']!=$pres_max_id)
		     {
		  	   $prev_max_id = $_SESSION['MAX_ID'];
		  	   $_SESSION['MAX_ID'] = $pres_max_id;
		  	   $query = "select * from latest_results where id>'$prev_max_id'";
		  	   $result = mysql_query( $query , $handler);
		  	   while($list=mysql_fetch_row($result))
		  	   	  {
		  	        $res = mysql_query('select name,position,grp from score where event=\''.$list[1].'\'');
		  	        check($result);

		  	        $f = ''; $fg ='';$fm = '';
		  	        $s = ''; $sg ='';$sm = '';
		  	        $t = ''; $tg ='';$tm = '';
		  	        
		  	         while($row = mysql_fetch_row($res))
		  	         	 {
                             if($row[1]=='first')
                                 { $f = $f.ucwords($row[0]).',' ; $fg = $fg .$row[2].',' ; $fm = '';} 
                             elseif($row[1]=='second')
                                 { $s = $s.ucwords($row[0]).',' ; $sg = $sg .$row[2].',' ; $sm = '';}
                             elseif($row[1]=='third')
                                 { $t = $t.ucwords($row[0]).',' ; $tg = $tg .$row[2].',' ; $tm = '';}
		  	         	 }
		  	        $event1 = 'Congrats to '.$f.'<br /> of '.$fg.'<br /><i>First Prize For '.$list[1].'</i>;'.$fm.
		  	                   '*#*Congrats to '.$s.'<br /> of '.$sg.'<br /><i>Second Prize For '.$list[1].'</i>;'.$sm.
		  	                   '*#*Congrats to '.$t.'<br /> of '.$tg.'<br /><i>Third Prize For '.$list[1].'</i>;'.$tm;	 
		  	        array_push($stack,$event1);
		  	       } 
		     }
	 }
else
	{
	   $query = "select max(id) from latest_results";
	   $result = mysql_query( $query);
	   check($result);
	   $max = mysql_fetch_assoc($result) ;
	   $pres_max_id = $max['max(id)'];
	   $_SESSION['MAX_ID'] = $pres_max_id;
	   
	   $query = "select * from latest_results";
	   $result = mysql_query( $query , $handler);
	   check($result);

       $stack = array() ;

	   while($list=mysql_fetch_row($result))
		  	  {   
		  	  			  	        $res = mysql_query('select name,position,grp from score where event=\''.$list[1].'\'');
		  	        check($result);

		  	        $f = ''; $fg ='';$fm = '';
		  	        $s = ''; $sg ='';$sm = '';
		  	        $t = ''; $tg ='';$tm = '';
		  	        
		  	         while($row = mysql_fetch_row($res))
		  	         	 {
                             if($row[1]=='first')
                                 { $f = $f.ucwords($row[0]).',' ; $fg = $fg .$row[2].',' ; $fm = $row[2];} 
                             elseif($row[1]=='second')
                                 { $s = $s.ucwords($row[0]).',' ; $sg = $sg .$row[2].',' ; $sm = $row[2];}
                             elseif($row[1]=='third')
                                 { $t = $t.ucwords($row[0]).',' ; $tg = $tg .$row[2].',' ; $tm = $row[2];}
		  	         	 }
		  	        $event1 = 'Congrats to '.$f.'<br /> of '.$fg.'<br /><i>First Prize For '.$list[1].'</i>;'.$fm.
		  	                   '*#*Congrats to '.$s.'<br /> of '.$sg.'<br /><i>Second Prize For '.$list[1].'</i>;'.$sm.
		  	                   '*#*Congrats to '.$t.'<br /> of '.$tg.'<br /><i>Third Prize For '.$list[1].'</i>;'.$tm;	 
		  	        array_push($stack,$event1);	
		  	  }       	
	}
echo array_pop($stack);
$_SESSION['STACK']= $stack;

?>