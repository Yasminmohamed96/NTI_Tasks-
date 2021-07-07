<?php
function CleanInput($input)
{
    $input=trim($input);
    $input=stripcslashes($input);
    $input=htmlspecialchars($input);
    return $input;
}
function sanitize_string($input)
{
    $input=filter_var($input,FILTER_SANITIZE_STRING);
    return $input;
}

function validate_sanitize_email($input)
{
    if(filter_var($input,FILTER_VALIDATE_EMAIL))
        {
            echo $input;
            return $input;   
        }
    else
        {
            
            $input=filter_var($input,FILTER_SANITIZE_EMAIL);
            echo  $input.'SANITIZE';
            if (filter_var($input,FILTER_VALIDATE_EMAIL))
                {
                    echo $input;
                    return $input;
                }
            else
                {
                    $input="error";
                    return $input;
                }    

            
        }    
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if((!empty($_POST['name']))&&(strlen($_POST['name'])>3))
    {
        $name=$_POST['name'];
        $name=CleanInput($name);
        $name=sanitize_string($name);
        echo"correct name value :".$name.'<br>';
    }
    else {
             echo"wrong name value ".'<br>';
         }



    if(!empty($_POST['email']))
    {
        $email=$_POST['email'];
        $email=CleanInput($email);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            echo "$email  is a valid email address".'<br>';
        }
         else
         {
             $san_email=filter_var($email, FILTER_SANITIZE_EMAIL);
            echo "$email is not a valid email address"."<br>";
            echo"note sanitized mail is ". $san_email.'<br>';
         }
        
    }           

    if(!empty($_POST['linkedin_url']))
    { 
        $linkedin_url=$_POST['linkedin_url'];
        echo"correct linkedin_url value ".$linkedin_url.'<br>';
    }
    else {
        echo"wrong linkedin_url value ".'<br>';
         }
         if(!empty($_POST['linkedin_url']))
         {
             $linkedin_url=$_POST['linkedin_url'];
             $linkedin_url=CleanInput($linkedin_url);
             if (filter_var($linkedin_url, FILTER_VALIDATE_URL)) 
             {
                 echo "$linkedin_url is a valid linkedin_url address".'<br>';
             }
              else
              {
                echo "$linkedin_url is a NOT valid linkedin_url address".'<br>';
              }
         }

         
    if(!empty($_FILES['CV']['name']) && isset($_FILES['CV']['name']) ){
        // CODE ... 
      $tmp_path = $_FILES['CV']['tmp_name'];
      $name     = $_FILES['CV']['name'];
      $size     = $_FILES['CV']['size'];
      $type     = $_FILES['CV']['type'];
        
 
      $nameArray = explode('.',$name);
      $FileExtension = strtolower($nameArray[1]);
 
      $FinalName = rand().time().'.'.$FileExtension;
 
       $allowedExtension = ['pdf'];    
 
        if(in_array($FileExtension,$allowedExtension)){
         // code ....
       
         $disFolder = './uploads/';
         
         $disPath  = $disFolder.$FinalName;
 
          if(move_uploaded_file($tmp_path,$disPath))
            {
               echo 'File Uploaded'.'<br>';
 
            }else{
                echo 'Error In upload try again'.'<br>';
            }
 
        }else{
 
         echo '* extension not allowed'.'<br>';
        }
     }else{
 
         echo '*  please  Upload CV'.'<br>';
     } 

}
?>

<html>
<!TYPEDOC html>
<head>

<title>form</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  enctype="multipart/form-data" >
    <label >name:</label><br>
    <input type="text"  name="name"><br>


    <label >Email:</label><br>
    <input type="text" name="email"><br>

    <label >linkedIn url:</label><br>
    <input type="URL"  name="linkedin_url"><br>

    <label >CV:</label><br>
    <input type="file"  name="CV"><br>

    <input type="submit" value="Submit">
    


    </form>

</body>

</html>
