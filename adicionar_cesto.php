<?php
$produto=$_GET['cod'];
$qnt=$_POST['cod'];
$index=$_COOKIE['index'];
$bol=0;
$i=0;
while(isset($_COOKIE['prod'][$i]) && $bol==0){
	if($produto==$_COOKIE['prod']){
		$_COOKIE['qnt'][$i]+=$qnt;
		$bol=1;
	}
	$i++;
}
if($bol==0){
	$_COOKIE['index']+=1;
	$_COOKIE['prod'][$index]=$produto;
	$_COOKIE['qnt'][$index]=$qnt;
}
header("Location: produtos.php?gam=&gru=&for=");
?>

