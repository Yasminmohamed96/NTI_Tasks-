<?php
for ($i=0; $i <8; $i++) 
{
  for ($j=0; $j <8 ; $j=$j+2)
   { 
    if($i%2==1)
    {
      echo'
      <div style="background-color: #000000; width: 30px; height: 30px;border: 1px solid black; display: table-cell;float: left;"></div>
      <div style="background-color: ##fffff; width: 30px; height: 30px;border: 1px solid black; display: table-cell;float: left;"></div>
      ';
    }
    else{
          echo'
          <div style="background-color: ##fffff; width: 30px; height: 30px;border: 1px solid black; display: table-cell;float: left;"></div>
          <div style="background-color: #000000; width: 30px; height: 30px;border: 1px solid black; display: table-cell;float: left;"></div>
          ';
        }
   }
   echo'<br>';

}

?>