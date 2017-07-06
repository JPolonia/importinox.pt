<?php
	/* Na base de dados é feita a seguinte correspondência:
			 * column1 = Gama
			 * column2 = Grupo
			 * column3 = Artigo (norma/referência/formato) <---OLD  NEW*  	*column3 = Artigo
			 * column4 = Material											*column4 = Familia
			 * column5 = Acabamento											*column5 = Material
			 * column6 = Código												*column6 = Acabamento
			 * column7 = Descrição / medida									*column7 = Código
			 * column8 = Equivalente										*column8 = Descrição / medida
			 * column9 = Stock 												*column9 = Equivalente
																			*column10 = Artigo
	*/	
			 
	session_start(); //inicio da sessão de um cliente (a usar futuramente)

	/* Ligação à base de dados */
	include("db_connect/ligacao.php");

	/* Apontadores para colunas em SQL */
	$c_id_gama = "column1";
	$c_gama = "column2";
	$c_id_grupo = "column3";
	$c_grupo = "column4";
	$c_artigo = "column5";
	$c_familia = "column6";
	$c_material = "column7";
	$c_acabamento = "column8";
	$c_codigo = "column9";
	$c_descricao = "column10";
	$c_equivalente = "column11";
	$c_stock = "column12";
	
	/* Pasta das imagens */
	$directory = "imagens";

if(isset($_GET['gru']) && isset($_GET['gam']) ){ /* caso as variaveis gama, grupo e formato estejam definidas no url */

	/* Load ID's of Gama & Grupo */
	$id_gama = $_GET['gam'];
	$id_grupo = $_GET['gru'];
	
	/* Descodifica gama */
	$sql ="SELECT DISTINCT " .$c_gama. " FROM produto WHERE " .$c_id_gama. " = '" .$id_gama. "'";
	$query = mysql_query($sql);
	//$nr_ocor = mysql_num_rows($query);
	//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
	$row = mysql_fetch_assoc($query);
	$gama= $row[$c_gama];
	
	
	/* Descodifica grupo */
	$sql ="SELECT DISTINCT " .$c_grupo. " FROM produto WHERE " .$c_id_gama. " = '" .$id_gama. "' AND " .$c_id_grupo. " = '" .$id_grupo. "'";
	$query = mysql_query($sql);
	//$nr_ocor = mysql_num_rows($query);
	//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
	$row = mysql_fetch_assoc($query);
	$grupo= $row[$c_grupo];

	
	/* Selecionar todos os grupos da gama - Preencher menus laterais */
	$sql ="SELECT DISTINCT " .$c_grupo. " , " .$c_id_grupo." FROM produto WHERE " .$c_id_gama. " = '$id_gama'";
	$query = mysql_query($sql);
	//$nr_ocor = mysql_num_rows($query);
	//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
	for ($i=0;$row = mysql_fetch_array($query);$i++) {
		$grupo_all[$i]= $row[$c_grupo];
		$grupo_all_id[$i]= $row[$c_id_grupo];
	}
	
	/* Selecionar todos os artigos do grupo */
	$sql ="SELECT DISTINCT " .$c_artigo. " , " .$c_familia.  " FROM produto WHERE " .$c_id_grupo. " = '$id_grupo' AND " .$c_id_gama. " = '$id_gama'";
	$query = mysql_query($sql);
	//$nr_ocor = mysql_num_rows($query);
	//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
	for ($i=0;$row = mysql_fetch_array($query);$i++){
		$artigo_all[$i]= $row[$c_artigo];
		$familia_all[$i] = $row[$c_familia];
	}

		
	
	
	
																/*ATENÇÃO: ACRESCENTE CODIGO ATÉ AQUI*/
	

									/* ATENÇÃO: NÃO ESCREVER MAIS CÓDIGO! AS VARs [$query] & [$sql] VÃO SER USADAS MAIS Á FRENTE! ESCREVER ACIMA!! */
}
else {
	echo "Problema com as variaveis gam, gru e for";
    $grupo_all=0; // you can change it
}
	 
	 
	/* Funções para a codificação e descodificação */
    function safe_b64encode($string) {
 
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
	function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
 
    function encode($value){ 
		$skey = "SuPerEncKey2010";
	    if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim(safe_b64encode($crypttext)); 
    }
 
    function decode($value){
		$skey = "SuPerEncKey2010";
        if(!$value){return false;}
        $crypttext = safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta content="text/html"; charset="iso-8859-1" http-equiv="Content-Type">
	<title>Importinox</title>
	<?php include("layout/head.php"); ?>		
</head>

<body bottommargin="0" rightmargin="0" leftmargin="0" topmargin="0">
	<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
		<tbody>
			<tr>
				<td background="templates/img_tratada01.jpg" align="center" style="background-position:center top; background-repeat:no-repeat">
					<table cellspacing="0" cellpadding="0" border="0">
						<tbody>
							<tr>
								<td width="6" background="templates/left.png" style="background-repeat:repeat-y">
									<img width="6" height="1" src="templates/blank.gif">
								</td>
								<td width="950">
									<table width="950" cellspacing="0" cellpadding="0" border="0">
										<tbody>
											<tr>
												<td valign="top" height="120" background="templates/logo_fnd_pt.jpg" align="left">
													<table width="100%" cellspacing="0" cellpadding="0" border="0">
														<tbody>
															<tr>
																<td width="415">
																	<img width="415" height="120" src="templates/blank.gif">																
																</td>
																<td valign="top" align="right">
																	<table width="100%" height="120" cellspacing="0" cellpadding="0" border="0">
																		<tbody>
																			<tr>
																				<td class="blue" align="right">
																					<table cellspacing="0" cellpadding="0" border="0">
																						<tbody>
																							<tr>
																								<td>
																									<a href="index.php?lingua=pt">
																										<img border="0" src="templates/pt.jpg">
																									</a>
																								</td>
																								<td width="22">
																									<img width="22" height="1" src="templates/blank.gif">
																								</td>
																								<td>
																									<a href="index.php?lingua=en">
																										<img border="0" onmouseout="this.src='templates/en_cinza.jpg'" onmouseover="this.src='templates/en.jpg'" src="templates/en_cinza.jpg">
																									</a>
																								</td>
																								<td width="22">
																									<img width="22" height="1" src="templates/blank.gif">
																								</td>
																								<td>
																									<a href="index.php?lingua=es">
																										<img border="0" onmouseout="this.src='templates/es_cinza.jpg'" onmouseover="this.src='templates/es.jpg'" src="templates/es_cinza.jpg">
																									</a>
																								</td>
																								<td width="4">
																									<img width="4" height="1" src="templates/blank.gif">
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																			<tr>
																				<td height="21" align="right">
																					<form method="get" action="nm_pesquisa.php" name="f_pesquisa">
																						<table width="206" height="20" cellspacing="0" cellpadding="0" border="0">
																							<tbody>
																								<tr>
																									<td width="178" style="padding-left:15px;background: url('templates/cx_pesquisa_topo.jpg') right no-repeat;">
																										<input id="pesquisa" type="text" style="border:0px; width:165px;" value="" name="pesquisa">
																									</td>
																									<td width="23px" align="left">
																										<input type="image" src="templates/bt_pesquisar.jpg">
																									</td>
																								</tr>
																							</tbody>
																						</table>
																					</form>
																				</td>
																			</tr>
																			<tr>
																				<td height="20" align="right">
																					<img width="6" height="20" src="templates/blank.gif">
																				</td>
																			</tr>
																			<tr>
																				<td valign="top" height="15" align="right">
																					<a href="index.php">Home <img align="absmiddle" src="templates/seta_topo.jpg"></a>
																					<a>&nbsp;&nbsp;&nbsp;</a>
																					<a href="nm_quemsomos.php?id=12">Downloads <img align="absmiddle" src="templates/seta_topo.jpg"></a>
																					<a>&nbsp;</a>
																				</td>
																			</tr>
																			<tr>
																				<td height="20" align="right">
																					<img width="6" height="20" src="templates/blank.gif">
																				</td>
																			</tr>
																		</tbody>
																	</table>														
																</td>
																<td width="17" valign="top" align="right">
																	<img width="6" height="6" src="templates/blank.gif">
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr>
												<td valign="top" align="left">
													<div style="position:relative">
														<ilayer id="layerMenu" width="1">
															<div id="divMenu" style="position:absolute">
																<img id="posicao" width="1" height="46" border="0" name="id" src="cm_fillx.gif" alt="">
															</div>
														</ilayer>
													</div>
													<table cellspacing="0" cellpadding="0" border="0" background="templates/menu1.jpg">
														<tbody>
															<tr>
																<td width="142" height="47">&nbsp;</td>
																<td class="menu" width="1"><img src="templates/sep.jpg"></td>
																<td width="148" height="47">&nbsp;</td>
																<td class="menu" width="1"><img src="templates/sep.jpg"></td>
																<td width="148" height="47">&nbsp;</td>
																<td class="menu" width="1"><img src="templates/sep.jpg"></td>
																<td width="154" height="47">&nbsp;</td>
																<td class="menu" width="1"><img src="templates/sep.jpg"></td>
																<td width="190" height="47">&nbsp;</td>
																<td class="menu" width="1"><img src="templates/sep.jpg"></td>
																<td width="154" height="47">&nbsp;</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<tr><td height="10" background="templates/home_fundo_cont.jpg" align="center" style="background-repeat:repeat-x"></td></tr>
											<tr><td><img height="5px" src="templates/blank.gif"></td></tr>
											<tr>
												<td>
													<table width="950" height="500px" cellspacing="0" cellpadding="0" border="0">
														<tbody>
															<tr>
																<td width="679" valign="top" align="left">
																	<script src="litbox2/js/prototype.js" type="text/javascript"></script>
																	<script src="litbox2/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
																	<script src="litbox2/js/effects.js" type="text/javascript"></script>
																	<script src="litbox2/js/builder.js" type="text/javascript"></script>
																	<script src="litbox2/js/lightbox.js" type="text/javascript"></script>
																	<script src="litbox2/js/addons.js" type="text/javascript"></script>
																	<link media="screen" type="text/css" href="litbox2/css/lightbox.css" rel="stylesheet">
																	<link rel="stylesheet" type="text/css" href="javascript/css/thickbox.css" media="screen"
																	<script type="text/javascript">
																	<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
																		<tbody>
																			<tr>
																				<td width="20"></td>
																				<td height="30" colspan="2" style="BORDER-BOTTOM: #aeb8b9 1px solid; BORDER-TOP: #aeb8b9 1px solid">
																					<table width="100%" cellspacing="0" cellpadding="0" border="0">
																						<tbody>
																							<tr>
																								
																								<td width="100" align="center"> 
																									<a class="submenu_off" href="nm_catalogo.php?gam=CPF&gru=FCU"><?php if($gama=="Chapa Perfurada"){  ?><b>Chapa Perfurada</b><?php } else { ?> Chapa Perfurada	<?php } ?></a>
																								</td>
																								<td width="100" align="center">
																									<a class="submenu_off" href="nm_catalogo.php?gam=FIX&gru=AFS"><?php if($gama=="Fixação") { ?><b>Fixação</b><?php } else { ?>Fixação</a><?php } ?> 
																								</td>
																								<td width="100" align="center">
																									<a class="submenu_off" href="nm_catalogo.php?gam=FRI&gru=PRM"><?php if($gama=="Fixação Rosca Inglesa") { ?><b>Fixação Rosca Inglesa</b><?php } else { ?>Fixação Rosca Inglesa</a><?php } ?> 
																								</td>
																								<td width="100" align="center">
																									<a class="submenu_off" href="nm_catalogo.php?gam=QUI&gru=SEL"><?php if($gama=="Químicos") { ?><b>Químicos</b><?php } else { ?>Químicos</a><?php } ?> 
																								</td>
																							</tr>
																							
																						</tbody>
																					</table>
																				</td>
																				<td width="20"></td>
																			</tr>
																			<tr>
																				<td></td>
																				<td height="44">
																					<a class="preto_c" href="#" ><?php echo $gama; ?></a>
																					&nbsp;&gt;&nbsp;
																					<a class="preto_c" href="#"><?php echo $grupo; ?></a>
																					&gt;
																					
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
																		<tbody>
																			<tr>
																				<td width="20"></td>
																				<td width="164" valign="top">
																					<table width="164" cellspacing="0" cellpadding="0" border="0" align="center">
																						<tbody>
																							<tr><td><img height="3" src="templates/spacer.gif"></td></tr>
																							<?php 
																								$i=0;
																								while (isset($grupo_all[$i])) 
																								{ 
																								if (strcmp($grupo,$grupo_all[$i])==0) {	
																							?>
																							<tr>
																								<td id="td1_0" height="24" style="background:#0075a0;">
																									<table width="100%" cellspacing="0" cellpadding="6" border="0" align="center">
																										<tbody>
																											<tr>
																												<td>
																													<a class="subfam" href=""><?php echo $grupo_all[$i]; ?></a>
																												</td>
																											</tr>
																										</tbody>
																									</table>
																								</td>
																								<td width="2">
																									<img width="2" src="templates/spacer.gif">
																								</td>
																								<td id="td2_0" width="24" valign="middle" align="center" style="background:#0075a0;">
																									<img id="cross_0" src="templates/cat_fam.png">
																								</td>
																							</tr>
																							<tr><td height="2"></td></tr>
																							<?php } else { ?>
																							<tr >
																								<td id="td1_0" height="24" style="background: none repeat scroll 0% 0% rgb(0, 155, 211);">
																									<table width="100%" cellspacing="0" cellpadding="6" border="0" align="center">
																										<tbody>
																											<tr>
																												<td>
																													<a class="subfam" href="nm_catalogo.php?gam=<?php echo $id_gama;?>&gru=<?php echo $grupo_all_id[$i];?>"><?php echo $grupo_all[$i]; ?></a>
																												</td>
																											</tr>
																										</tbody>
																									</table>
																								</td>
																								<td width="2">
																									<img width="2" src="templates/spacer.gif">
																								</td>
																								<td id="td2_0" width="24" valign="middle" align="center" style="background: none repeat scroll 0% 0% rgb(0, 155, 211);">
																									<img id="cross_0" src="templates/cat_fam.png">
																								</td>
																							</tr>
																							<tr><td height="2"></td></tr>
																							<?php }	++$i;
																								} ?>
																						</tbody>
																					</table>
																				</td>
																				<td width="24"><img width="24" src="templates/spacer.gif"></td>
																				<td valign="top">
																					<table cellspacing="0" cellpadding="0" border="0">
																						<tbody>
																							<?php for ($i = 0; isset($artigo_all[$i*5]); $i++) { ?>
																							<tr>
																								<?php for ($j = 0; $j<5 && isset($artigo_all[5*$i+$j]) ; $j++) { 
																									 		
																								$pic = $directory."/".$id_gama."/".$id_grupo."/".$artigo_all[5*$i+$j]."_1.jpg";
																																															
																								?>
																									<td width="143" valign="top" height="71">
																									<table width="143" height="6" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td height="6" colspan="3"><img src="templates/lp_box_top.jpg"></td></tr></tbody></table>
																									<table width="143" height="57" cellspacing="0" cellpadding="0" border="0">
																										<tbody>
																											<tr>
																												<td width="8" style="background:url('http://www.importinox.com/templates/lp_box_bg.jpg') left;"><img width="8" src="http://www.importinox.com/templates/spacer.gif"></td>
																												<td width="126" valign="bottom" style="background:url('http://www.importinox.com/templates/lp_box_bg.jpg') center;">
																													<table width="100%" height="57" cellspacing="0" cellpadding="0" border="0">
																														<tbody>
																															<tr><td colspan="2"><a href="produtos.php?gam=<?php echo $id_gama;?>&gru=<?php echo $id_grupo;?>&art=<?php echo encode($artigo_all[5*$i+$j]);?>&fam=<?php echo encode($familia_all[5*$i+$j]); ?>"><img border="0" src="<?php echo $pic; ?>"></a></td></tr>
																															<tr>
																																<td valign="middle" height="14"><a class="link_lista" href="produtos.php?gam=<?php echo $id_gama;?>&gru=<?php echo $id_grupo;?>&art=<?php echo encode($artigo_all[5*$i+$j]);?>&fam=<?php echo encode($familia_all[5*$i+$j]); ?>"><?php echo $artigo_all[5*$i+$j]; ?></a></td>
																																<td align="right"><a href="produtos.php?gam=<?php echo $id_gama;?>&gru=<?php echo $id_grupo;?>&art=<?php echo encode($artigo_all[5*$i+$j]); ?>&fam=<?php echo encode($familia_all[5*$i+$j]);?>"><img border="0" src="http://www.importinox.com/templates/cross_link.jpg"></a></td>
																															</tr>
																														</tbody>
																													</table>
																												</td>
																												<td width="7" style="background:url('http://www.importinox.com/templates/lp_box_bg.jpg') right;"><img width="7" src="http://www.importinox.com/templates/spacer.gif"></td>
																											</tr> 
																										</tbody>
																									</table>
																									<table width="143" height="8" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td height="8" colspan="3"><img src="http://www.importinox.com/templates/lp_box_bottom.jpg"></td></tr></tbody></table>
																								</td>
																								<?php  } ?>
																							</tr>
																							<?php } ?>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table> 
																	<script>
																		function switchColor(idx, state)
																		{
																			if(state==1)
																			{
																			document.getElementById('td1_'+idx).style.backgroundColor='#0075a0';
																			document.getElementById('td2_'+idx).style.backgroundColor='#0075a0';
																			//document.getElementById('cross_'+idx).src='templates/cat_fam_on.jpg';
																			}
																			else
																			{
																			document.getElementById('td1_'+idx).style.backgroundColor='#009bd3';
																			document.getElementById('td2_'+idx).style.backgroundColor='#009bd3';
																			//document.getElementById('cross_'+idx).src='templates/cat_fam.jpg';
																			}
																			}

																	</script>
																	<script type="text/javascript">
																		function imprime(id)
																		{
																			altura=600;
																			largura=750;
																			pos_y=(screen.availheight/2)-(largura/2);
																			pos_x=(screen.availwidth/2)-(altura/2);
																			var n=window.open("imprime_prod.php?ID="+id+"" ,"_blank","Height="+altura+"px,Width="+largura+"px,scrollbars=yes")
																		}
																		function ShowOpiniao2()
																		{
																			altura=500;
																			largura=700;
																			pos_y=(screen.availheight/2)-(largura/2);
																			pos_x=(screen.availwidth/2)-(altura/2);
																			var n=window.open("opinioes.php?ID=724&nova=0","_blank","scrollbars=yes,toolbar=no,menubar=no,left="+pos_x+",top="+pos_y+",width="+largura+",height="+altura);
																		} 
																	</script>
																</td>
																<td width="10px"><img width="10px" src="templates/blank.gif"></td>
																<!-- <td width="261px" valign="top" align="left">
																	<table width="281" height="171" cellspacing="0" cellpadding="0" border="0">
																		<tbody>
																			<tr>
																				<td width="9" style="border-left:1px solid #aeb8b9"><img width="9" height="1" src="templates/blank.gif"></td>
																				<td valign="bottom" height="30" align="right"><img align="left" src="templates/noticias_new2_icon_pt.png"></td>
																				<td width="18"><img width="18" height="1" src="templates/blank.gif"></td>
																			</tr>
																			<tr>
																				<td width="9" style="border-left:1px solid #aeb8b9">&nbsp;</td>
																				<td valign="top" align="right">
																					<table width="100%" cellspacing="0" cellpadding="0" border="0">
																						<tbody>
																							<tr>
																								<td valign="top" height="100" align="right">
																									<table width="100%" cellspacing="2" cellpadding="1" border="0">
																										<tbody>
																											<tr>
																												<td height="10" align="right" style="font-size:12px" colspan="3">
																													<img width="4" height="1" src="templates/blank.gif">
																												</td>
																											</tr>
																											<tr>
																												<td height="10" align="left" colspan="3">
																													<a class="noticias" style="font-size:12px" href="catalogo_noticias.php?ID=8"><strong>Condições Gerais de Venda da IMPORTINOX</strong></a>
																													<br>
																													<a class="noticias" href="catalogo_noticias.php?ID=8">[2010-12-01]</a>
																												</td>
																											</tr>
																											<tr>
																												<td valign="top">
																													<a class="noticias" style="font-size:11px" href="catalogo_noticias.php?ID=8"> »</a>
																												</td>
																												<td width="4"><img width="4" height="1" src="templates/blank.gif"></td>
																												<td align="right"><a href="catalogo_noticias.php?ID=8"><img border="0" src="img_upload/catalogo_noticias/8_1_peqx.jpg"></a></td>
																											</tr>
																										</tbody>
																									</table>
																									<table width="100%" cellspacing="2" cellpadding="1" border="0">
																										<tbody>
																											<tr>
																												<td align="left"><a style="font-size:12px" href="catalogo_noticias.php?ID=8">ler mais » </a></td>
																												<td align="right"><a style="font-size:12px" href="nm_catalogo_noticias.php?ID=1&ID_ORG=1">ver todas » </a></td>
																											</tr>
																										</tbody>
																									</table>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																				<td width="18"></td>
																			</tr>
																		</tbody>
																	</table>
																</td> -->
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td width="6" background="templates/right.png" style="background-repeat:repeat-y"><img width="6" height="1" src="templates/blank.gif"></td>
							</tr>
							<tr>
								<td><img src="templates/canto_left.jpg"></td>
								<td><img src="templates/sh_bottom.jpg"></td>
								<td><img src="templates/canto_right.jpg"></td>
							</tr>
						</tbody>
					</table>
					
					<?php include("layout/rodape_2.php"); ?>
					
				</td>
			</tr>
		</tbody>
	</table>
<?php include("layout/menus_cool_3.php"); ?>
</body>

</html>
