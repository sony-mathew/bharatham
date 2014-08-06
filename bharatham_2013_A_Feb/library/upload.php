<?php



function upload()

{

   if(isset($_FILES['files']))         {   $i = count($_FILES['files']['name']) ;   }
   else                                {   $i = 0 ; }
   $body = '<div class="message" style="background:{bgcolor};color:white;">';
   if( $i > 0 )
         {  

            //validating extensions ,type and size of all files   
            $allowedExts = array("jpg", "jpeg", "gif", "png","psd","cld");
            $extension = array(0);
            $ext = 1 ;       $type = 1 ;         $eflag = 0 ;
            for($j = 0 ; $j < $i ; ++$j)
               {   
                   $tempp = explode(".", $_FILES["files"]["name"][$j] ) ;
                   $extension[$j] = strtolower(  end( $tempp) ); 
                   $ext = $ext && in_array($extension[$j], $allowedExts) ;
                   
                   $type = $type && (($_FILES["files"]["type"][$j] == "image/gif")|| ($_FILES["files"]["type"][$j] == "image/jpeg")|| 
                                              ($_FILES["files"]["type"][$j] == "image/png")|| ($_FILES["files"]["type"][$j] == "image/pjpeg"))
                                               && ($_FILES["files"]["size"][$j] < 20000000) ;  
                                     
                   if ($_FILES["files"]["error"][$j] > 0)   
                      { $error = $error . "Return Code: " . $_FILES["files"]["error"][$j] . "<br />"; $eflag = 1 ; }                          
               }

            if ($type && $ext )
              {
                          $link = connect();
                          $result = mysql_query('select images from track');

                          if($result) 
                              {  $row = mysql_fetch_row($result);  }
                          else
                              { $row =array();  $row[0] = 0 ; }

                          for( $j = 0 ; $j < $i ; ++$j )
                             {
                                  $extn = explode('/',$_FILES["files"]["type"][$j]);       
                                  $new_name = ( ++$row[0] ) .'.'.$extn[1] ;
                                  $files[$j] = $new_name;
                                  move_uploaded_file($_FILES["files"]["tmp_name"][$j], "./images/" .$new_name);
                             }
                          $result = mysql_query('update track set images=\''.$row[0].'\'');
                          check($result);

                          $body = str_replace('{bgcolor}', 'deepskyblue', $body); 
                          $body = $body.'Succesfully uploaded '.$i.' images.<br/></div>';     
              }
            else
              {
                     $body = str_replace('{bgcolor}', 'red', $body);
                     $body = $body."Invalid file. Only files of type jpg,jpeg,png or gif with size less than 20 Mb can be uploaded.</div>";
              }
       }
   else
       {
         $body = str_replace('{bgcolor}', 'black', $body);
         $body = $body . 'Upload files </div>';
         $body = $body .'
                        <form method="post" action="index.php?go=upload" enctype="multipart/form-data">
                        <div id="line"><div class="linel">Upload your files :   </div> 
                                       <div class="liner"><input type="file" name="files[]" id="file" multiple="multiple"> 
                        </div></div>
                        <input type="hidden" name="check" value="upload" />
                        <div id="line"> <div class="linel">&nbsp;</div><div class="liner"> <input type="submit" value="Submit" style="width:100px;height:35px;"/>  </div></div> 
                        </form>';
       }       

return $body;

}

?>