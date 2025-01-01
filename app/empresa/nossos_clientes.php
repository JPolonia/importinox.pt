<?php 
function descodifica2($value) 
{
	switch ($value) {
		case 64:
			return "empresa/mercado_industrial.php";
			break;
		case 65:
			return "empresa/distribuicao.php";
			break;
	}

} 
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody>
		<tr>
			<td height="30" colspan="2">
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tbody>
						<tr>
							<td width="5" style="WIDTH: 30px"><div>&nbsp;</div></td>
							<td width="110" style="BORDER-BOTTOM: #aeb8b9 1px solid; VERTICAL-ALIGN: middle; BORDER-TOP: #aeb8b9 1px solid"><div align="center"><a class="submenu_off" href="nm_quemsomos.php?id=15"><span style="FONT-FAMILY: Arial; COLOR: #325d9f; FONT-SIZE: 12px">Quem Somos</span></a></div></td>
							<td width="140" style="BORDER-BOTTOM: #aeb8b9 1px solid; BORDER-TOP: #aeb8b9 1px solid"><div align="center"><a class="submenu_off" href="nm_quemsomos.php?id=64"><span style="FONT-FAMILY: Arial; COLOR: #325d9f; FONT-SIZE: 12px"><strong>Os nossos Clientes</strong></span></a></div></td>
							<td width="100" style="BORDER-BOTTOM: #aeb8b9 1px solid; BORDER-TOP: #aeb8b9 1px solid"><div align="center"><a class="submenu_off" href="nm_quemsomos.php?id=24"><span style="FONT-FAMILY: Arial; COLOR: #325d9f; FONT-SIZE: 12px">Objectivos</span></a></div></td>
							<td width="155" style="BORDER-BOTTOM: #aeb8b9 1px solid; BORDER-TOP: #aeb8b9 1px solid"><div align="center"><a class="submenu_off" href="nm_quemsomos.php?id=25"><span style="FONT-FAMILY: Arial; COLOR: #325d9f; FONT-SIZE: 12px">Príncipios e valores</span></a></div></td>
							<td style="BORDER-BOTTOM: #aeb8b9 1px solid; BORDER-TOP: #aeb8b9 1px solid"><div align="center"><a class="submenu_off" href="nm_quemsomos.php?id=16"><span style="FONT-FAMILY: Arial; COLOR: #325d9f; FONT-SIZE: 12px">Um compromisso<br>sólido</span></a></div></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td style="WIDTH: 30px"></td>
			<td style="PADDING-TOP: 10px">
				<?php $path2 = descodifica2("$id"); ?> 
				<?php include("$path2"); ?>
			</td>
		</tr>
	</tbody>
</table>
