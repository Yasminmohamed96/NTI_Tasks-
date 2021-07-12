<?php

$server="localhost";
$dbName="nti_task1";
$dbUser="root";
$dbPassword="";

$con=mysqli_connect($server,$dbUser,$dbPassword,$dbName);

if ($con)
{
    //echo"connection is done ";
}
else 
{
    die('ErrorMessage'.mysqli_connect_error());
}

?>

<?php 

