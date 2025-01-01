<?php 
function RandomPass($numchar){  
   $letras = "A,B,C,D,E,F,G,H,I,J,K,1,2,3,4,5,6,7,8,9,0";  
   $array = explode(",", $letras);  
   shuffle($array);  
   $senha = implode($array, "");  
   return substr($senha, 0, $numchar);  
} 

$senha = RandomPass(4);
echo "A senha gerada é: " . $senha;
$img= $senha;
?> 
