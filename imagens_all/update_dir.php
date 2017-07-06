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
	$c_gama = "column1";
	$c_grupo = "column2";
	$c_artigo = "column3";
	$c_familia = "column4";
	$c_material = "column5";
	$c_acabamento = "column6";
	$c_codigo = "column7";
	$c_descricao = "column8";
	$c_equivalente = "column9";
	$c_stock = "column10";
	
	/* Imagem DEFAULT*/
	$no_pic = 'no_pic.jpg';

	/* Selecionar todas as gamas */
	$sql ="SELECT DISTINCT " .$c_gama. " FROM produto";
	$query = mysql_query($sql);
	//$nr_ocor = mysql_num_rows($query);
	//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
	for ($i=0;$row = mysql_fetch_array($query);$i++) 
		$gama_all[$i]= $row[$c_gama];
		
	
	for ($i = 0; isset($gama_all[$i]); $i++) {
		
		/* Criar diretorios para todas as gamas */
		$path_gama = 'imagens/' .$gama_all[$i];
		if(!file_exists($path_gama))
			mkdir($path_gama,0755,true);
		
		
		/* Selecionar todos os grupos de cada gama */
		$sql ="SELECT DISTINCT " .$c_grupo. " FROM produto WHERE " .$c_gama. " = '$gama_all[$i]'";
		$query = mysql_query($sql);
		//$nr_ocor = mysql_num_rows($query);
		//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
		for ($j=0;$row = mysql_fetch_array($query);$j++) 
			$grupo_all[$j]= $row[$c_grupo];
		
		/* Criar diretorios para todos os grupos de cada gama*/
		for ($j = 0; isset($grupo_all[$j]); $j++) {
			$path_grupo = 'imagens/' .$gama_all[$i] .'/' .$grupo_all[$j];
			if(!file_exists($path_grupo))
				mkdir($path_grupo,0755,true);
			
			/* Selecionar todos os artigos de cada grupo */
			$sql ="SELECT DISTINCT " .$c_artigo. " FROM produto WHERE " .$c_gama. " = '$gama_all[$i]' AND " .$c_grupo. " =  '$grupo_all[$j]'";
			$query = mysql_query($sql);
			//$nr_ocor = mysql_num_rows($query);
			//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
			for ($k=0;$row = mysql_fetch_array($query);$k++) 
				$artigo_all[$k]= $row[$c_artigo];
				
			/* Criar 5 imagens DEFAULT para cada artigo */
			for ($k=0;isset($artigo_all[$k]);$k++){
				for ($y=1;y<6;$y++){
					$path_artigo = 'imagens/' .$gama_all[$i] .'/' .$grupo_all[$j]. '/' .$artigo_all[$k]. '_' .$y. '.jpg';
					if(!file_exists($path_artigo)){
						if(!copy($no_pic, $path_artigo))
							echo "Failed to copy image";
					}
				}
			} 
		}
	}
	
	echo "Diretórios e Imagens carregadas!";
		
		
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
