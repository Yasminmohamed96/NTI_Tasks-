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
            echo "$email is a valid email address";
        }
         else
         {
             $san_email=filter_var($email, FILTER_SANITIZE_EMAIL);
            echo "$email is not a valid email address"."<br>";
            echo"note sanitized mail is ". $san_email.'<br>';
         }
        
    }           

    if((!empty($_POST['password']))&&(strlen($_POST['password'])>8))
    { 
        $password=$_POST['password'];
        echo"correct password value ".$password.'<br>';
    }
    else {
        echo"wrong password value ".'<br>';
         }

}
?>

<html>
<!TYPEDOC html>
<head>

<title>form</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
    <label >name:</label><br>
    <input type="text"  name="name"><br>


    <label >Email:</label><br>
    <input type="text" name="email"><br>

    <label >Password:</label><br>
    <input type="password"  name="password"><br>

    <input type="submit" value="Submit">
    


    </form>

</body>

</html>
