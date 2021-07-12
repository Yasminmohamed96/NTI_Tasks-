<?php require "dbconnection.php";

# Clean input ...
function CleanInputs($input){

 $input = trim($input);
 $input = stripcslashes($input);
 $input = htmlspecialchars($input);

 return $input;
}

 $errorMessages = array();
 if($_SERVER['REQUEST_METHOD'] == "POST" ){

    $title  = CleanInputs($_POST['title']);
    $content = CleanInputs($_POST['content']);

 

    

     // Name Validation ...
     if(!empty($title)){
       // code ... 
        if(strlen($title) < 3){
           $errorMessages['title'] = "title Length must be > 2 "; 
          }
     }else{
       $errorMessages['name'] = "Required";
     }

     
    

      
     // Name Validation ...
     if(!empty($content))
     {
        // code ... 
         if(strlen($title) < 3)
        {
            $errorMessages['content'] = "content Length must be > 2 "; 
        }
      }
      else
      {
        $errorMessages['content'] = "Required";
      }
 
 
      
    
       /////////////////////////////////////////////////////////////////////////////////////////////
       if(!empty($_FILES['post_image']['name']) && isset($_FILES['post_image']['name']) ){
        // CODE ... 
      $tmp_path = $_FILES['post_image']['tmp_name'];
      $name     = $_FILES['post_image']['name'];
      $size     = $_FILES['post_image']['size'];
      $type     = $_FILES['post_image']['type'];
        
 
      $nameArray = explode('.',$name);
      $FileExtension = strtolower($nameArray[1]);
 
      $FinalName = rand().time().'.'.$FileExtension;
 
       $allowedExtension = ['png','jpg','jpeg'];    
 
        if(in_array($FileExtension,$allowedExtension)){
         // code ....
       
         $disFolder = './uploads/';
         
         $disPath  = $disFolder.$FinalName;
 
          if(!move_uploaded_file($tmp_path,$disPath))
            {
                $errorMessages['post_image'] = "Error In upload try again  "; 
            }
 
        }
        else
        {
 
            $errorMessages['post_image'] = "file extension not allowed  "; 
        }
     }
     else
     {
 
        $errorMessages['post_image'] = "required "; 
     } 

      ////////////////////////////////////////////////////////////////////////////////////////
 
  if(count($errorMessages) == 0)
  {
     
     $sql="insert into posts (post_title,post_content,post_image_destination) values ('$title','$content','$disPath')";
     $op=mysqli_query($con,$sql);
     if($op)
     {   
         echo" INSERTION done";
     }
     else
      {
         echo"insertion error ";
      }
    
  }else{

  // print error messages 
  foreach($errorMessages as $key => $value){
  }
     echo '* '.$key.' : '.$value.'<br>';
 {

  }

 }
 }




?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>CREATE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<h2>NEW POST </h2>
<form  method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"  enctype ="multipart/form-data">

<div class="form-group">
 <label for="exampleInputEmail1">title</label>
 <input type="text"  name="title" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
</div>

<div class="form-group">
 <label for="exampleInputEmail1">content</label>
 <input type="text"  name="content" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
</div>

<div class="form-group">
 <label for="exampleInputEmail1">post image</label>
 <input type="file"  name="post_image" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<a href='view.php' class='btn btn-danger m-r-1em'>view all posts data </a>
</body>
</html>






