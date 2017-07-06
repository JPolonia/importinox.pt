<?php
session_start();
if(isset($_GET['id']))
    $id=$_GET['id'];
 else
    $id=0;
    
function descodifica($value) 
{
	switch ($value) {
		case 15:
			return "empresa/quem_somos.php";
			break;
		case 64:
		case 65:
			return "empresa/nossos_clientes.php";
			break;
		case 24:
			return "empresa/objectivos.php";
			break;
		case 25:
			return "empresa/principios_valores.php";
			break;
		case 16:
			return "empresa/compromisso_solido.php";
			break;
		case 66:
			return "empresa/timeline.php";
			break;
		case 61:
			return "servicos/servico_importinox.php";
			break;
		case 38:
			return "servicos/factelec_edi.php";
			break;
		case 40:
			return "servicos/slap_ship.php";
			break; 
		case 41:
			return "servicos/repacking.php";
			break;	
		case 42:
			return "servicos/blanket_ordering.php";
			break;
		case 43:
			return "servicos/jit_kanban.php";
			break;
		case 44:
			return "servicos/vendorman_inventory.php";
			break;
		case 45:
			return "qualidade/qualidade_importinox.php";
			break;
		case 46:
			return "qualidade/certif_iso9001.php";
			break;
		case 47:
			return "qualidade/controle_qualidade.php";
			break;
		case 48:
			return "qualidade/certif_qualidade.php";
			break;
		case 17:
			return "misc/politica_privacidade.php";
			break;
		case 69:
			return "misc/projecto_qren.php";
			break;
		case 1:
			return "misc/copyright.php";
			break;
		case 12:
			return "misc/downloads.php";
			break;
			
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
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
											
											<?php include("layout/cabecalho_2.php"); ?>
											
											<tr>
												<td>
													<table width="950" height="500px" cellspacing="0" cellpadding="0" border="0">
														<tbody>
															<tr>
																<td width="679" valign="top" align="left">
																	<script>
																		function SwitchMenuxx(obj){
																		if(document.getElementById)
																		{
																		var el = document.getElementById("ax"+obj);
																		var el2 = document.getElementById("zx"+obj);
																		var ar = document.getElementById("mymaster").getElementsByTagName("span");
																		var ar2 = document.getElementById("mymaster").getElementsByTagName("img");
																		if(el.style.display != "block") {
																		for (var i=0; i<ar.length; i++) {
																		if (ar[i].className=="submenuxx")
																		ar[i].style.display = "none";
																		}
																		//alert(ar2.length)
																		for (var i=0; i<ar2.length; i++) {
																		//alert(ar2[i].className)
																		if (ar2[i].className=="minusgrand") ar2[i].src="templates/home_cont_mais1.jpg";
																		}
																		el.style.display = "block";
																		el2.src= "templates/home_cont_menos.jpg";
																		}
																		else
																		{
																		el.style.display = "none";
																		el2.src= "templates/home_cont_mais1.jpg";
																		}
																		}
																		} 
																	</script>
																	<script src="litbox2/js/prototype.js" type="text/javascript"></script>
																	<script src="litbox2/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
																	<script src="litbox2/js/effects.js" type="text/javascript"></script>
																	<script src="litbox2/js/builder.js" type="text/javascript"></script>
																	<script src="litbox2/js/lightbox.js" type="text/javascript"></script>
																	<script src="litbox2/js/addons.js" type="text/javascript"></script>
																	<link media="screen" type="text/css" href="litbox2/css/lightbox.css" rel="stylesheet">
																	<div id="mymaster">
																		<?php $path = descodifica("$id"); ?> 
																		<?php include("$path"); ?>
																	</div>
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
					<?php include("layout/rodape.php"); ?>
				</td>
			</tr>
		</tbody>
	</table>
<?php include("layout/menus_cool_2.php"); ?>
</body>

</html>
