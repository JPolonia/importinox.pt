<?php
/* Na base de dados é feita a seguinte correspondência:
		 * column1 = Gama
		 * column2 = Grupo
		 * column3 = Artigo (norma/referência/formato)
		 * column4 = Material
		 * column5 = Acabamento
		 * column6 = Código
		 * column7 = Descrição / medida
		 * column8 = Equivalente
		 * column9 = Stock */
		 
session_start(); //inicio da sessão de um cliente (a usar futuramente)

//Ligação à base de dados
$ligacao = mysql_connect("localhost", "root", ""); 
$ok = mysql_select_db("importinox.db.com", $ligacao);

	/*
	
	//Selecionar todos os grupos da gama - Preencher menus laterais
	$sql ="SELECT DISTINCT n_grupo FROM formato WHERE n_gama='$gama'";
	$query = mysql_query($sql);
	//$nr_ocor = mysql_num_rows($query);
	//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
	for ($i=0;$row = mysql_fetch_array($query);$i++) 
		$grupo_all[$i]= $row['n_grupo'];
	
	//Selecionar todos os formatos do grupo
	$sql ="SELECT n_formato FROM formato WHERE n_grupo='$grupo'";
	$query = mysql_query($sql);
	//$nr_ocor = mysql_num_rows($query);
	//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
	for ($i=0;$row = mysql_fetch_array($query);$i++) 
		$formato[$i]= $row['n_formato'];*/
		
	
	
	
	
	
															/*ATENÇÃO: ACRESCENTE CODIGO ATÉ AQUI*/
	$termo = $_GET['pesquisa'];
	if (strlen($termo)<3)
		$termo="Por favor insira no mínimo 3 caracteres";
	
	$sql ="SELECT DISTINCT column6, column7, column9 FROM produto WHERE column1 LIKE '%$termo%' OR column2 LIKE '%$termo%' OR column3 LIKE '%$termo%' OR column4 LIKE '%$termo%' OR column5 LIKE '%$termo%' OR column6 LIKE '%$termo%' OR column7 LIKE '%$termo%' OR column8 LIKE '%$termo%' OR column9 LIKE '%$termo%' ORDER BY column6 ASC";
	$query = mysql_query($sql);
	$nr_ocor_special = mysql_num_rows($query);
	//echo "Nº de ocorrências de " . $sql .": " .$nr_ocor;
	/*for ($i=0;$row = mysql_fetch_array($query);$i++) 
		$codigo[$i]= $row['column6'];
		$desc[$i]= $row['column7'];
		$stock[$i]= $row['column9'];*/

									/* ATENÇÃO: NÃO ESCREVER MAIS CÓDIGO! AS VARs [$query] & [$sql] VÃO SER USADAS MAIS Á FRENTE! ESCREVER ACIMA!! */

	 
	 
	//Funções para a codificação e descodificação segura
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
	function codificar($value){    
		switch ($value) {
			case "Furo Redondo RT":
				return "";
				break;
			case "Anilhas e Freios":
				return "AFS";
				break;
			case "Cabos, Correntes e Acessórios":
				return "CCA";
				break;
			case "Diversos":
				return "DIV";
				break;
			case "Parafusos para madeira":
				return "PPM";
				break;
			case "Parafusos Rosca Métrica":
				return "PRM";
				break;
			case "Pernos, Hastes e Olhais":
				return "PHO";
				break;
			case "Porcas":
				return "POR";
				break;		
			case "Rosca de Metal":
				return "RDM";
				break;
			case "Quimicos":
				return "";
				break; }
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta content="text/html"; charset="iso-8859-1" http-equiv="Content-Type">
	<title>Importinox</title>
	<meta content="" name="DESCRIPTION">
	<meta content="Parafusos, Parafusaria, Chapa perfurada, Metal distendido, Gradil, Degraus, Anti derrapante, Porcas, Anilhas, Buchas, Varão roscado, Inox, 8.8, 10.9, 12.9, A2, A4, A4-80, Silicone, Cola e veda, Espuma, Bucha química, Porto, Maia, EN 14399, EN14399, DIN 6914, DIN6914, Certificado CE, Marcação CE, CE Mark, Certificado 3.1, Chapa, Aço, Inoxidável, Ferro, Aço macio, Alumínio, Zincado, Galvanizado, Dacromet, Titânio, Hasteloy, Plástico, Nylon, Kuprodur, DIN, ISO, ASTM, UNC, UNF, BSW, Tornillos, Tornilleria, Chapa perforada, Metal expandido, Rejillas , Peldaños, Antideslizante, Tuercas, Arandelas, Anclajes, Varilla roscada, Inox, 8.8, 10.9, 12.9, A2, A4, A4-80, Siliconas, Selladores, Espuma, Anclajes quimicos, Porto, Maia, EN 14399, EN14399, DIN 6914, DIN6914, Certificado CE, Marca CE, CE Mark, Certificado 3.1, Chapa, Acero, Inoxidable, Hierro, Aluminio, Electrozincado, Galvanizado, Dacromet, Titanio, Hasteloy, Plastico, Nylon, Kuprodur, DIN, ISO, ASTM, UNC, UNF, BSW" name="KEYWORDS">
	<script>
		function SymError(){ return true;}
		window.onerror = SymError;
	</script>
	<script type="text/javascript" src="AC_RunActiveContent.js"></script>
	<link type="text/css" rel="stylesheet" href="templates/styles.css"></link>
	<link REL="shortcut icon" HREF="templates/importinox_icon2.jpg">
	<script>
		meses = new Array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
		semana = new Array("Domingo","Segunda","Terça","Quarta","Quinta","Sexta","Sábado");
		function DiaExtenso() {
			hoje = new Date();
			dia = hoje.getDate();
			dias = hoje.getDay();
			mes = hoje.getMonth();
			ano = hoje.getYear();
			if (navigator.appName == "Netscape")
				ano = ano + 1900;
			diaext = semana[dias] + ", " + dia + " de " + meses[mes]
			+ " de " + ano;
			return diaext;
		}
	</script>		
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
																				
																									<td class="titulo" valign="middle" height="32" style="border-top:1px solid #E4E4E4; border-bottom:1px solid #E4E4E4">Pesquisa</td>
																			
																				
																				<td width="20"></td>
																			</tr>
																			<tr>
																				<td></td>
																				<td height="44">
																					<a class="preto_c" ><?php echo "Resultados da pesquisa por:"; ?></a>
																					&nbsp;
																					<a class="preto_c" >'<?php echo $termo; ?>'</a>
																					&nbsp;
																					<a class="preto_c" >(<?php echo $nr_ocor_special; ?> ocorrências encontradas)</a>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
																		<tbody>
																			<tr>
																				<td width="20"></td>
																				
																				<td valign="top">
																					<table width="100%" cellspacing="0" cellpadding="2" border="0" align="center">
																															<tbody>
																																<tr>
																																	<td class="fichaquad_tit">&nbsp;Código</td>
																																	<td class="fichaquad_tit">Descrição/Medida</td>
																																	
																																	<td class="fichaquad_tit" align="right">&nbsp;&nbsp;&nbsp;Stock</td>
																																	
																																	<td class="fichaquad_tit" align="right"><!--Cesto-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
																																	
																																</tr>
																																<?php
																																$qwert=2; 
																																while ($row = mysql_fetch_array($query)) 
																																	{
																																		$cod = $row['column6'];
																																		$desc = $row['column7'];
																																		$stock = $row['column9'];
																																		
																																	 ?>
																																	<form method="post" action="adicionar_cesto.php?gam=<?php/* echo $_GET['gam'];*/?>&gru=<?php /*echo $_GET['gru']; */?>&for=<?php /* $_GET['for']; */?>&cod=<?php /* $cod; */?>" name="pesquisa">
																																<tr>
																																	<td class="fichaquad<?php if($qwert%2==0) echo ""; else echo "2"; ?>">&nbsp;<?php echo $cod; ?></td>
																																	<td class="fichaquad<?php if($qwert%2==0) echo ""; else echo "2"; ?>"><?php echo $desc; ?></td>
																																	<td class="fichaquad<?php if($qwert%2==0) echo ""; else echo "2"; ?>" align="right">
																																		<?php switch($stock) {
																																			case 2: ?>
																																				<img width="18" align="absmiddle" title="Disponibilidade imediata" src="templates/stock_semaforo_3.png">
																																		<?php break; case 1: ?>
																																				<img width="18" align="absmiddle" title="Disponível em aprox. 1 semana" src="templates/stock_semaforo_2.png">
																																		<?php break; case 0: ?>
																																				<img width="18" align="absmiddle" title="Sob consulta" src="templates/stock_semaforo_1.png">
																																		<?php break;} ?>
																																		
																																	</td>
																																	
																																	<td class="fichaquad<?php if($qwert%2==0) echo ""; else echo "2"; ?>" align="right"><!--<input id="<?php/* echo $cod; */?>" class="ficha_input" type="text"  value="" name="<?php/* echo $cod; */?>">--></td>
																																	<td class="fichaquad<?php if($qwert%2==0) echo ""; else echo "2"; ?>" align="right"><!--<input type="image" src="img_upload/cesto2.gif">--></td>
																																	
																																</tr>
																																</form>
																																<?php  ++$qwert; } ?>
																															</tbody>
																														</table>
																														<br>
				<p align="right"><a href="javascript:history.back(1)"><img border="0" src="img_upload/botao_voltar.jpg" title=""></a></p>
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
																<td width="261px" valign="top" align="left">
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
																</td>
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
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tbody>
							<tr>
								<td align="center">
									<script>
										function addFav(){
											var url = "http://www.importinox.com/";
											var title = "Importinox";
											if (window.sidebar) window.sidebar.addPanel(title, url, "");
											else if (window.opera && window.print) {
												var mbm = document.createElement('a');
												mbm.setAttribute('rel', 'sidebar');
												mbm.setAttribute('href', url);
												mbm.setAttribute('title',title);
												mbm.click();
											}
											else if(document.all){window.external.AddFavorite(url, title);}
											else if(window.chrome){
												alert('Pressione ctrl+D para adicionar aos Favoritos (Command+D em macs) depois de clicar em Ok');
											}
										}
										function clearDefault(el) { if (el.defaultValue==el.value) el.value = ""; }
									</script>
									<table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td height="6"><img width="1" height="6" src="templates/blank.gif"></td></tr></tbody></table>
									<table width="950" cellspacing="0" cellpadding="0" border="0">
										<tbody>
											<tr>
												<td height="22" align="center" style="border-top:1px solid #738788; border-bottom:1px solid #738788" colspan="2">
													<a class="rodape_cinza" href="index.php">Home</a>
													|
													<a class="rodape_cinza" title="Favoritos" href="javascript:addFav()">Favoritos</a>
													|
													<a class="rodape_cinza" href="nm_sugira.php">Recomendar</a>
													|
													<a class="rodape_cinza" href="nm_quemsomos.php?id=17">Política de Privacidade</a>
													|
													<a class="rodape_cinza" href="nm_mapa.php">Mapa do Site</a>
													|
													<a class="rodape_cinza" href="nm_quemsomos.php?id=69">Projecto QREN</a>
												</td>
											</tr>
										</tbody>
									</table>
									<table width="950" cellspacing="0" cellpadding="0" border="0">
										<tbody>
											<tr>
												<td width="32"><img width="32" height="1" src="templates/blank.gif"></td>
												<td width="291" align="left"><img src="templates/logos_bottom.jpg"></td>
												<td valign="middle" height="53" align="right"><img border="0" src="img_upload/logos_color.jpg" title=""></td>
												<td width="32"><img width="32" height="1" src="templates/blank.gif"></td>
											</tr>
										</tbody>
									</table>
									<table width="950" cellspacing="0" cellpadding="0" border="0">
										<tbody>
											<tr>
												<td valign="middle" height="26" align="center">
													<a class="cinza" href="nm_quemsomos.php?id=1">Copyright &copy; 2010 Importinox, Lda. - Todos os direitos reservados</a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	<style type="text/css">
		
	/* CoolMenus 4 - default styles - do not edit */
.clCMEvent{position:absolute; width:99%; height:99%; clip:rect(0,100%,100%,0); left:0; top:0; visibility:visible}
.clCMAbs{position:absolute; visibility:hidden; left:0; top:0}
/* CoolMenus 4 - default styles - end */
/*Style for the background-bar*/
.clBar{position:absolute; width:10; height:10; background-color:Navy; layer-background-color:Navy; visibility:hidden}
/*Styles for level 0*/
.clLevel0,.clLevel0over{position:absolute; padding:0px; font-family:arial; font-size:14px; text-align: center; font-weight:bold}
.clLevel0{color:#FFFFFF; }
.clLevel0over{color:#006b9b; cursor:pointer; cursor:hand; background:url(templates/menu3.jpg);}
.clLevel0border{position:absolute; visibility:hidden; }
.clLevel0_selected,.clLevel0_selectedover{position:absolute; padding:0px; font-weight:bold; font-family:arial; font-size:14px; text-align: center; background:url(templates/menu3.jpg); color:#006b9b; cursor:pointer; cursor:hand;}
/*Styles for level 1*/
.clLevel1,.clLevel1over{position:absolute; padding:3px; font-family:arial; font-size:14px; text-align:left; padding-left:23px}
.clLevel1{background:url(templates/menu3.jpg); color:#006b9b;}
.clLevel1over{background:url(templates/menu1.jpg); color:#FFFFFF; cursor:hand; cursor:pointer;}
.clLevel1border{position:absolute; z-index:500; visibility:hidden; background-color:#EEEEF0; layer-background-color:#EEEEF0}
/*Styles for level 2*/
.clLevel2,.clLevel2over{position:absolute; padding:3px; font-family:arial; font-size:14px; text-align:left; padding-left:23px}
.clLevel2{background:url(templates/menu3.jpg); color:#006b9b}
.clLevel2over{background:url(templates/menu1.jpg); color:#FFFFFF; cursor:hand; cursor:pointer;}
.clLevel2border{position:absolute; z-index:500; visibility:hidden; background-color:#EEEEF0; layer-background-color:#EEEEF0} 
	
	</style>
	<script src="coolmenus4.js" language="JavaScript1.2" type="text/javascript"></script>
	<script src="cm_addins.js" language="JavaScript1.2"></script>
	<script type="text/javascript">
		//Extra code to find position:
function janela_w(){
var viewportwidth;
var viewportheight;
if (typeof window.innerWidth != 'undefined')
{
viewportwidth = window.innerWidth,
viewportheight = window.innerHeight
}
else if (typeof document.documentElement != 'undefined'
&& typeof document.documentElement.clientWidth !=
'undefined' && document.documentElement.clientWidth != 0)
{
viewportwidth = document.documentElement.clientWidth,
viewportheight = document.documentElement.clientHeight
}
else
{
viewportwidth = document.getElementsByTagName('body')[0].clientWidth,
viewportheight = document.getElementsByTagName('body')[0].clientHeight
}
return viewportwidth;
}
function findPos(){
if(bw.ns4){ //Netscape 4
x = document.layers.layerMenu.pageX
y = document.layers.layerMenu.pageY
}else{ //other browsers
x=0; y=0; var el,temp
el = bw.ie4?document.all["posicao"]:document.getElementById("posicao");
if(el.offsetParent){
temp = el
while(temp.offsetParent){ //Looping parent elements to get the offset of them as well
temp=temp.offsetParent;
x+=temp.offsetLeft
y+=temp.offsetTop;
}
}
x+=el.offsetLeft
y+=el.offsetTop
}
x=(janela_w()/2)-475;
y=125;
//Returning the x and y as an array
return [x,y]
}
pos = findPos();
//Menu object creation
oCMenu=new makeCM("oCMenu") //Making the menu object. Argument: menuname
//Menu properties
oCMenu.pxBetween=1;
oCMenu.fromLeft=pos[0];
oCMenu.fromTop=pos[1];
oCMenu.onresize="pos=findPos(); oCMenu.fromLeft=pos[0]; oCMenu.fromTop=pos[1]"
oCMenu.rows=1
oCMenu.menuPlacement=0
oCMenu.offlineRoot="file:///C|/Inetpub/wwwroot/dhtmlcentral/projects/coolmenus/examples/"
oCMenu.onlineRoot=""
oCMenu.resizeCheck=1
oCMenu.wait=1000
oCMenu.fillImg="cm_fill.gif"
oCMenu.zIndex=0
//Background bar properties
oCMenu.useBar=0
oCMenu.barWidth="menu"
oCMenu.barHeight="menu"
oCMenu.barClass="clBar"
oCMenu.barX="menu"
oCMenu.barY="menu"
oCMenu.barBorderX=0
oCMenu.barBorderY=0
oCMenu.barBorderClass=""
//Level properties - ALL properties have to be spesified in level 0
oCMenu.level[0]=new cm_makeLevel() //Add this for each new level
oCMenu.level[0].width=220
oCMenu.level[0].height=47
oCMenu.level[0].regClass="clLevel0"
oCMenu.level[0].overClass="clLevel0over"
oCMenu.level[0].borderX=0
oCMenu.level[0].borderY=0
oCMenu.level[0].borderClass="clLevel0border"
oCMenu.level[0].offsetX=0
oCMenu.level[0].offsetY=0
oCMenu.level[0].rows=0
oCMenu.level[0].arrow=0
oCMenu.level[0].arrowWidth=0
oCMenu.level[0].arrowHeight=0
oCMenu.level[0].align="bottom"
oCMenu.level[0].filter="progid:DXImageTransform.Microsoft.Fade(duration=0.5)" //VALUE: 0 || "filter specs"
//EXAMPLE SUB LEVEL[1] PROPERTIES - You have to specify the properties you want different from LEVEL[0] - If you want all items to look the same just remove this
oCMenu.level[1]=new cm_makeLevel() //Add this for each new level (adding one to the number)
oCMenu.level[1].width=250
oCMenu.level[1].height=47
oCMenu.level[1].regClass="clLevel1"
oCMenu.level[1].overClass="clLevel1over"
oCMenu.level[1].borderX=1
oCMenu.level[1].borderY=1
oCMenu.level[1].align="right"
oCMenu.level[1].offsetX=3
oCMenu.level[1].offsetY=3
oCMenu.level[1].borderClass="clLevel1border"
//EXAMPLE SUB LEVEL[2] PROPERTIES - You have to spesify the properties you want different from LEVEL[1] OR LEVEL[0] - If you want all items to look the same just remove this
oCMenu.level[2]=new cm_makeLevel() //Add this for each new level (adding one to the number)
oCMenu.level[2].width=250
oCMenu.level[2].height=47
oCMenu.level[2].regClass="clLevel2"
oCMenu.level[2].overClass="clLevel2over"
oCMenu.level[2].borderX=1
oCMenu.level[2].borderY=1
oCMenu.level[2].align="right"
oCMenu.level[2].offsetX=3
oCMenu.level[2].offsetY=3
oCMenu.level[2].borderClass="clLevel2border"
/******************************************
Menu item creation:
myCoolMenu.makeMenu(name,parent_name,text,link,target,width,height,regImage,overImage,regClass,overClass ,align,rows,nolink,onclick,onmouseover,onmouseout)
*************************************/
oCMenu.makeMenu('top0','','<div style="height:46px; margin-top:15px">Empresa</div>','nm_quemsomos.php?id=15','','143.5')
oCMenu.makeMenu('top1','','<div style="height:46px; margin-top:15px">Produtos</div>','nm_catalogo.php?gam=FIX&gru=AFS','','149.5','','','','clLevel0_selected','clLevel0_selectedover')
oCMenu.makeMenu('top2','','<div style="height:46px; margin-top:15px">Serviços</div>','nm_quemsomos.php?id=61','','149.5')
oCMenu.makeMenu('top3','','<div style="height:46px; margin-top:15px">Qualidade</div>','nm_quemsomos.php?id=45','','155.5')
oCMenu.makeMenu('top4','','<div style="height:46px; margin-top:15px">Aplicações</div>','nm_registo.php','','191.5')
oCMenu.makeMenu('top5','','<div style="height:46px; margin-top:15px">Contactos</div>','nm_contactos.php','','155.5')
oCMenu.construct() 
	</script>
	
	<!--
	<div id="oCMenu_top0_0" class="clLevel0border" style="z-index: 2; clip: rect(0px, 143.5px, 47px, 0px); width: 143.5px; height: 47px; left: 325px; top: 125px; visibility: visible;">
		<div id="oCMenu_top0" class="clLevel0" style="z-index: 4; clip: rect(0px, 143.5px, 47px, 0px); width: 143.5px; height: 47px; left: 0px; top: 0px; visibility: inherit;">
			<div style="height:46px; margin-top:15px">Empresa</div>
		</div>
	</div>
	<div id="oCMenu_top1_0" class="clLevel0border" style="z-index: 3; clip: rect(0px, 149.5px, 47px, 0px); width: 149.5px; height: 47px; left: 469.5px; top: 125px; visibility: visible;">
		<div id="oCMenu_top1" class="clLevel0" style="z-index: 5; clip: rect(0px, 149.5px, 47px, 0px); width: 149.5px; height: 47px; left: 0px; top: 0px; visibility: inherit;">
			<div style="height:46px; margin-top:15px">Produtos</div>
		</div>
	</div>
	<div id="oCMenu_top2_0" class="clLevel0border" style="z-index: 4; clip: rect(0px, 149.5px, 47px, 0px); width: 149.5px; height: 47px; left: 620px; top: 125px; visibility: visible;">
		<div id="oCMenu_top2" class="clLevel0" style="z-index: 6; clip: rect(0px, 149.5px, 47px, 0px); width: 149.5px; height: 47px; left: 0px; top: 0px; visibility: inherit;">
			<div style="height:46px; margin-top:15px">Serviços</div>
		</div>
	</div>
	<div id="oCMenu_top3_0" class="clLevel0border" style="z-index: 5; clip: rect(0px, 155.5px, 47px, 0px); width: 155.5px; height: 47px; left: 770.5px; top: 125px; visibility: visible;">
		<div id="oCMenu_top3" class="clLevel0" style="z-index: 7; clip: rect(0px, 155.5px, 47px, 0px); width: 155.5px; height: 47px; left: 0px; top: 0px;">
			<div style="height:46px; margin-top:15px">Qualidade</div>
		</div>
	</div>
	<div id="oCMenu_top4_0" class="clLevel0border" style="z-index: 6; clip: rect(0px, 191.5px, 47px, 0px); width: 191.5px; height: 47px; left: 927px; top: 125px; visibility: visible;">
		<div id="oCMenu_top4" class="clLevel0" style="z-index: 8; clip: rect(0px, 191.5px, 47px, 0px); width: 191.5px; height: 47px; left: 0px; top: 0px;">
			<div style="height:46px; margin-top:15px">Área de cliente</div>
		</div>
	</div>
	<div id="oCMenu_top5_0" class="clLevel0border" style="z-index: 7; clip: rect(0px, 155.5px, 47px, 0px); width: 155.5px; height: 47px; left: 1119.5px; top: 125px; visibility: visible;">
		<div id="oCMenu_top5" class="clLevel0" style="z-index: 9; clip: rect(0px, 155.5px, 47px, 0px); width: 155.5px; height: 47px; left: 0px; top: 0px;">
			<div style="height:46px; margin-top:15px">Contactos</div>
		</div>
	</div>
	<div id="overlay" style="display: none;"></div>
	<div id="lightbox" style="display: none;">
		<div id="outerImageContainer" style="width: 250px; height: 250px;"></div>
		<div id="imageDataContainer"></div>
	</div>
	-->
</body>

</html>
