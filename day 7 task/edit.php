<?php 

   require 'dbConnection.php';
    
   $id = $_GET['id'];
   $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
  
   $message = "";

   if(!filter_var($id,FILTER_VALIDATE_INT)){

    $_SESSION['message'] = "Invalid Id";

    header("Locattion: view.php");
   }





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
   
   
     if(count($errorMessages) == 0){

          // DB CODE... 
          $sql  = "update posts set post_title='$title' , post_content ='$content' , post_image_destination ='$disPath'  where ID =$id ";
     
          $op   =  mysqli_query($con,$sql);

          //mysqli_error($con);

       if($op){
           $_SESSION['message'] = "Record Updated";
            header("Location: view.php");
       }else{
        $errorMessages['sqlOperation'] = "Error in Your Sql Try Again";
    }



     }else{

     // print error messages 
     foreach($errorMessages as $key => $value){

        echo '* '.$key.' : '.$value.'<br>';
         }
       }
    }







   


  
    // Fetch single Row of Data .... 
     $sql = "select * from posts where ID = $id";
     $op = mysqli_query($con,$sql); 
     $data = mysqli_fetch_assoc($op);
  
    



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
<h2>EDIT POST</h2>
<form  method="post"  action="edit.php?id=<?php echo $data['ID'];?>"  enctype ="multipart/form-data">

<div class="form-group">
 <label for="exampleInputEmail1">title</label>
 <input type="text"  name="title" value="<?php echo $data['post_title'];?>" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
</div>

<div class="form-group">
 <label for="exampleInputEmail1">content</label>
 <input type="text"  name="content" value="<?php echo $data['post_content'];?>" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
</div>

<div class="form-group">
 <label for="exampleInputEmail1">post image</label>
 <img src="<?=$data['post_image_destination']; ?>"style=" width:100px; width:100px; " />
 <input type="file"  name="post_image" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
</div>
<button type="submit" class="btn btn-primary">update</button>
</form>
</div>
<a href='view.php' class='btn btn-danger m-r-1em'>view all data </a>
</body>
</html>


