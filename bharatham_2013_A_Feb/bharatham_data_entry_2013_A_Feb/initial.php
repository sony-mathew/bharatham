<?php

include_once('db_common.php');



$con = connect();




if (!$con)
             {     die('Could not connect: ' . mysql_error());        }
else 

             {     print "connectioon succesful....!!!! \n\n";        }






mysql_select_db( $db , $con);










//creating third table profiles

$sql = "CREATE TABLE std
(

id int NOT NULL AUTO_INCREMENT,
primary key (id),
name varchar(50),
mobile bigint UNIQUE,
year varchar(20),
branch varchar(6)
)";


if(mysql_query($sql,$con))
    {         print "profiles table created..!!";         }
else
     {    print "profiles table could not be created..!!"; }




print '<br/>' ;






mysql_close($con);
?>
