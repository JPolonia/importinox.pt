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
oCMenu.makeMenu('top0','','<div style="height:46px; margin-top:15px">Empresa</div>','nm_quemsomos.php?id=15','','143.5'<?php if($_GET['id']==64 || $_GET['id']==65 || $_GET['id']==66 || $_GET['id']==15 || $_GET['id']==16 || $_GET['id']==24 || $_GET['id']==25) { ?>,'','','','clLevel0_selected','clLevel0_selectedover'<?php } ?>)
oCMenu.makeMenu('top1','','<div style="height:46px; margin-top:15px">Produtos</div>','nm_catalogo.php?gam=FIX&gru=AFS','','149.5')
oCMenu.makeMenu('top2','','<div style="height:46px; margin-top:15px">Serviços</div>','nm_quemsomos.php?id=61','','149.5'<?php if($_GET['id']==61 || $_GET['id']==38 || $_GET['id']==40 || $_GET['id']==41 || $_GET['id']==42 || $_GET['id']==43 || $_GET['id']==44) { ?>,'','','','clLevel0_selected','clLevel0_selectedover'<?php } ?>)
oCMenu.makeMenu('top3','','<div style="height:46px; margin-top:15px">Qualidade</div>','nm_quemsomos.php?id=45','','155.5'<?php if($_GET['id']==45 || $_GET['id']==46 || $_GET['id']==47 || $_GET['id']==48) { ?>,'','','','clLevel0_selected','clLevel0_selectedover'<?php } ?>)
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
