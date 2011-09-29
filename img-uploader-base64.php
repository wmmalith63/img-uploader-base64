<html>
           <head>
              
			  <title>Image Uploader</title>
          
		  <link rel="stylesheet" type="text/css" href="style.css">
		  </head>
               <body>
			   
                 <form action="img-uploader-base64.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <table class="main">
                   <label class="form">Add Photos </label>
                    <p class="upload">
                    <input name="photo" type="file" /> <br />
					</p>
					<p class="submit">
                    <input type="submit" name="Submit" value="Upload image" /> <br />
                    </p>
               </table>
                 </form>
                
               </body>
</html>

<?php

error_reporting(0);
if(isset($_POST['Submit'])!= NULL)
  {
    $file_name = $_FILES['photo']['name'];
    $file_type = $_FILES['photo']['type'];
    $file_size = $_FILES['photo']['size'];
    $file_tname = $_FILES['photo']['tmp_name'];
    $file_error = $_FILES['photo']['error'];
    $image_folder = "images/";

// check file ext. gif, jpeg, pjpeg, png

        if(($file_type== "image/gif")||($file_type== "image/jpeg")||($file_type=="image/pjpeg")||($file_type=="image/png")&& ($file_size < 20000))
               {

                 if ($file_error > 0)

                {

                  echo "Return Code: " .$file_error. "<br />";

                }
                else
                {
                 // $imgfile = file_get_contents($file_tname);
                  $base64 = chunk_split(base64_encode(file_get_contents($file_tname)));
                  echo '<table><tr><td><img src="data:image/gif;base64,'. $base64 .'" width="200" height="200"/></td><tr>';
               
			      echo "
                  
                  <tr>
                  <td>Image Name</td>
				  
                  <td>".$file_name."</td>
                  </tr>";

                  echo"
                  <tr>
                  <td>Image Size </td>
                  <td>".($file_size/1000)."KB</td>
                  </tr>";

                  echo "
                  <tr>
                  <td>Image Base64 Encode</td>
                  <td><textarea cols='40'>".$base64."</textarea></td>
                 </tr></tr></table>
                 ";

//check if image exists in the folder

                               if(file_exists($image_folder.$file_name))
                               {
                                 echo "Image already exists in image folder";
                               }
                               else
                               {
//if all is ok upload image in image folder
                                   $success = move_uploaded_file($file_tname,$image_folder.$file_name);

                                    if($success)
                                      {
                                        echo 'the file was uploaded successfully is '.$file;
                                        header("location:index.php");

                                      } 
                                    else
                                      {
                                         echo'there was a problem moving the uploaded file';
                                      }
                                }
                }
                }
                  else
                   {
                     echo "file is not Supported";
                   }
				  
    }



?> 