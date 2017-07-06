<?php
if(isset($_GET['cod'])){
		$id = $_GET['cod'];
		
			$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("importinox.db.com", $con);

mysql_query("UPDATE contacto SET respondido='ok' WHERE id_contacto='$id'");

mysql_close($con);

if(isset($_GET['mes'])){
		$mes = $_GET['mes'];
		$ano = $_GET['ano']; }

	
header("Location: admin.php?ano=$ano&mes=$mes");
}
	else
		echo"ERRRO var cod não declarada!";
		


