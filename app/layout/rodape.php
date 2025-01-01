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
