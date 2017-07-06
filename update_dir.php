<?php
/*
 * update_dir.php
 * 
 * Copyright 2014 João Polónia <joao@joao-W35xSTQ-370ST>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
 
 /*
  * Atualiza diretorios das imagens dos produtos apos a importacao da
  * tabela produtos 
  * 	-	So e necessario utiliza-lo quando houver um acrescimo de 
  * 		gamas ou grupos face as tabelas antigas
  * 
  * 	-	Para evitar perdas de imagens, O PROGRAMA NAO APAGA 
  * 		DIRETORIOS ANTIGOS. (Devem ser apagados manualmente)
  * 
  * 	-	Por default na criacao de novos diretorios são acrescentados
  * 		5 imagens por familia de produto - no_pic.jpg
  * 
  * 	-	Devem depois ser atualizadas manualmente 
  */
  
	/* Ligação à base de dados */
	include("db_connect/ligacao.php");
	
	/* Apontadores para colunas em SQL */
	$c_gama = "column2";
	$c_grupo = "column4";
	$c_artigo = "column5";
	$c_familia = "column6";
	$c_material = "column7";
	$c_acabamento = "column8";
	$c_codigo = "column9";
	$c_descricao = "column10";
	$c_equivalente = "column11";
	$c_stock = "column12";
	$id_gama = "column1";
	$id_grupo = "column3";

	/* Imagem DEFAULT*/
	$no_pic = 'no_pic.jpg';
	$directory = 'imagens';

	/* Selecionar todas as gamas */
	$sql ="SELECT DISTINCT " .$id_gama. " FROM produto";
	$query = mysql_query($sql);
	//$nr_ocor = mysql_num_rows($query);
	//echo "Num de ocorrencias de " . $sql .": " .$nr_ocor;
	for ($i=0;$row = mysql_fetch_array($query);$i++)
		$gama_all[$i]= $row[$id_gama];
	
	for ($i = 1; isset($gama_all[$i]); $i++) { //$gama_all[0] = "Gama"
		
		echo $gama_all[$i];
		echo "<br />\n";
		
		/* Criar diretorios para todas as gamas */
		if (!file_exists($directory."/".$gama_all[$i]))
			mkdir($directory."/".$gama_all[$i],0755,true);
		
		
		/* Selecionar todos os grupos de cada gama */
		$sql ="SELECT DISTINCT " .$id_grupo. " FROM produto WHERE " .$id_gama. " = '$gama_all[$i]'";
		$query = mysql_query($sql);
		//$nr_ocor = mysql_num_rows($query);
		//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
		for ($j=0;$row = mysql_fetch_array($query);$j++)
			$grupo_all[$j]= $row[$id_grupo];

		
		/* Criar diretorios para todos os grupos de cada gama*/
		for ($j = 0; isset($grupo_all[$j]); $j++) {
			
			echo "\t &nbsp &nbsp &nbsp &nbsp";
			echo $grupo_all[$j];
			echo "<br />\n";
			
			if(!file_exists($directory."/".$gama_all[$i]."/".$grupo_all[$j]))
				mkdir($directory."/".$gama_all[$i]."/".$grupo_all[$j],0755,true);
			
			/* Selecionar todos os artigos de cada grupo */
			$sql ="SELECT DISTINCT " .$c_artigo. " FROM produto WHERE " .$id_gama. " = '$gama_all[$i]' AND " .$id_grupo. " =  '$grupo_all[$j]'";
			$query = mysql_query($sql);
			//$nr_ocor = mysql_num_rows($query);
			//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
			for ($k=0;$row = mysql_fetch_array($query);$k++){
				$artigo_all[$k]= $row[$c_artigo];
				//echo $artigo_all[$k] ."    --------  ";
				
				/* Criar 5 imagens DEFAULT para cada artigo */
				for ($y=1;$y<6;$y++){
					$new_pic = $directory."/".$gama_all[$i]."/".$grupo_all[$j]."/".$artigo_all[$k]."_".$y.".jpg";
					echo "\t\t &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp";
					echo $new_pic;
					echo "<br />\n";
					if(!file_exists($new_pic)){
						if(!copy($no_pic,$new_pic))
							echo "Failed to copy image";
					}
				}
			}

		}
	}
	
	echo "--->Diretorios e Imagens carregadas!";
		
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>untitled</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.22" />
</head>

<body>
	
</body>

</html>
