<?php
$data="123456789";
$str_final="";
$arr= str_split($data) ;
$total=count($arr);
for ($i=0; $i<$total ; $i++)
 { 
    if(($i!=0)&&($i%2==0))
    {
        $str_final.=":";
    }
    if($i==$total)
    {
        $str_final.=strval($arr[$i]);
    }
    elseif($i<$total)
    {
        $str_final.=strval($arr[$i]);
       
    }   
   
    
}
echo $str_final;

?>