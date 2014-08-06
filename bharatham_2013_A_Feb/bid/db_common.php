<?php



function connect( )

    {

     $db_user = 'root' ;
     $db_pass = 'cool' ;
     $db_domain = 'localhost' ; 
     $db_db = 'bharatham' ;
     
     $link = mysql_connect( $db_domain , $db_user, $db_pass);
     if (!$link)
             {     die('Could not connect to the database: ' . mysql_error());        }
     
     else
             {
                   mysql_select_db( $db_db , $link ) ;     
                   return $link ;
              }
     }


function check($result)
     {

      if(!$result)
         {
             print '<b><br/><br/> Sorry , We are facing some problem with the database connectivity. Please return after some time.<br/> Thank You. </b><br/>'.mysql_error();
             exit ;
         }
     }   







// sanitization 
function sanitizeVariables(&$item, $key) 
{ 
    if (!is_array($item)) 
    { 
        // undoing 'magic_quotes_gpc = On' directive 
        if (get_magic_quotes_gpc()) 
            $item = stripcslashes($item); 
        
        $item = sanitizeText($item); 
    } 
} 

// does the actual 'html' and 'sql' sanitization. customize if you want. 
function sanitizeText($text) 
{ 
    $vlaid_html_tags = '<p> <a> <b> <br> <i> <li> <ul> <h1> <h2> <h3> <h4> <div> <code> <style> <font> <sub> <sup>' ;

    $text = strip_tags( $text , $vlaid_html_tags ) ;    
  

    $text = str_replace("<", "&lt;", $text); 
    $text = str_replace(">", "&gt;", $text); 
    $text = str_replace("\"", "&quot;", $text); 
    $text = str_replace("'", "&#039;", $text); 

    $text = str_replace('  ', '&nbsp;&nbsp;', $text) ;
    
    // it is recommended to replace 'addslashes' with 'mysql_real_escape_string' or whatever db specific fucntion used for escaping. However 'mysql_real_escape_string' is slower because it has to connect to mysql. 
    $text = addslashes($text); 
    
    return $text; 
}




?>
