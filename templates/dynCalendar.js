
// variaveis Globais 

	dynCalendar_layers=new Array();
	dynCalendar_mouseoverStatus=false;
	dynCalendar_mouseX=0;
	dynCalendar_mouseY=0;
	

	function dynCalendar(objName,callbackFunc)
	{
		
		
		// datas
		this.today=new Date();
		this.date=this.today.getDate();
		this.month=this.today.getMonth();
		this.year=this.today.getFullYear();
		
		
		
		this.objName=objName;
		this.callbackFunc=callbackFunc;
		this.imagesPath=arguments[2] ? arguments[2] : 'templates/';
		this.layerID=arguments[3] ? arguments[3] : 'dynCalendar_layer_'+dynCalendar_layers.length;

		this.offsetX=5;
		this.offsetY=5;

		this.useMonthCombo=true;
		this.useYearCombo=true;
		this.yearComboRange=5;

		this.currentMonth=this.month;
		this.currentYear=this.year;
		
		//metodos publicos
		this.show=dynCalendar_show;
		this.writeHTML=dynCalendar_writeHTML;

		// metodos
		this.setOffset=dynCalendar_setOffset;
		this.setOffsetX=dynCalendar_setOffsetX;
		this.setOffsetY=dynCalendar_setOffsetY;
		this.setImagesPath=dynCalendar_setImagesPath;
		this.setMonthCombo=dynCalendar_setMonthCombo;
		this.setYearCombo=dynCalendar_setYearCombo;
		this.setCurrentMonth=dynCalendar_setCurrentMonth;
		this.setCurrentYear=dynCalendar_setCurrentYear;
		this.setYearComboRange=dynCalendar_setYearComboRange;

		//metodos privados
		
		// manipulação da layer
		this._getLayer=dynCalendar_getLayer;
		this._hideLayer=dynCalendar_hideLayer;
		this._showLayer=dynCalendar_showLayer;
		this._setLayerPosition=dynCalendar_setLayerPosition;
		this._setHTML=dynCalendar_setHTML;

		// misturado
		this._getDaysInMonth=dynCalendar_getDaysInMonth;
		this._mouseover=dynCalendar_mouseover;
		
		
      // tipo de codigo        
		dynCalendar_layers[dynCalendar_layers.length]=this; this.writeHTML();
		
	}

//funçao da lingua
function linguagem(lang) {
	var lingua=lang;
	return lingua;
}

function dynCalendar_show()
	{
		// declaraçao de variaveis
		var month,year,monthnames,numdays,thisMonth,firstOfMonth;
		var ret,row,i,cssClass,linkHTML,previousMonth,previousYear;
		var nextMonth,nextYear,prevImgHTML,prevLinkHTML,nextImgHTML,nextLinkHTML;
		var monthComboOptions,monthCombo,yearComboOptions,yearCombo,html;

			
		this.currentMonth=month=arguments[0] != null ? arguments[0] : this.currentMonth;
		this.currentYear=year=arguments[1] != null ? arguments[1] : this.currentYear;		
		
		if(lingua=="pt") monthnames=new Array('Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
		else if(lingua=="es") monthnames=new Array('Enero','Febrero','Marzo','April','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		else if(lingua=="en") monthnames=new Array('January','February','March','April','May','June','July','August','September','October','November','December');
		else if(lingua=="de") monthnames=new Array('Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember');
		else if(lingua=="fr") monthnames=new Array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
		else if(lingua=="it") monthnames=new Array('Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre');


		numdays=this._getDaysInMonth(month,year);

		thisMonth=new Date(year,month,1);
		firstOfMonth=thisMonth.getDay();

		// First few blanks up to first day
		ret=new Array(new Array());
		for(i=0; i<firstOfMonth; i++){
			ret[0][ret[0].length]='<td>&nbsp;</td>';
		}

		// Main body of calendar
		row=0;
		i=1;
		while(i <= numdays){
			if(ret[row].length== 7){
				ret[++row]=new Array();
			}

			/**
            * Generate this cells' HTML
            */
			cssClass=(i== this.date && month== this.month && year== this.year) ? 'dynCalendar_today' : 'dynCalendar_day';
			linkHTML=sprintf('<a href="javascript: %s(%s,%s,%s); %s._hideLayer()">%s</a>',this.callbackFunc,i,Number(month)+1,year,this.objName,i++);

			ret[row][ret[row].length]=sprintf('<td align="center" class="%s">%s</td>',cssClass,linkHTML);
		}

		// Format the HTML
		for(i=0; i<ret.length; i++){
			ret[i]=ret[i].join('\n')+'\n';
		}

		previousYear=thisMonth.getFullYear();
		previousMonth=thisMonth.getMonth() - 1;
		if(previousMonth < 0){
			previousMonth=11;
			previousYear--;
		}
		
		nextYear=thisMonth.getFullYear();
		nextMonth=thisMonth.getMonth()+1;
		if(nextMonth > 11){
			nextMonth=0;
			nextYear++;
		}

		prevImgHTML=sprintf('<img src="templates/left.gif" border="0">',this.imagesPath);
		prevLinkHTML=sprintf('<table border=0 cellspacing=0 cellpadding=0><tr><td><a href="javascript: %s.show(%s,%s)">%s</a>',this.objName,previousMonth,previousYear,prevImgHTML);
		nextImgHTML=sprintf('<img src="templates/right.gif" border="0">',this.imagesPath);
		nextLinkHTML=sprintf('<a href="javascript: %s.show(%s,%s)">%s</a></td></tr><table>',this.objName,nextMonth,nextYear,nextImgHTML);

		/**
        * Build month combo
        */
		if (this.useMonthCombo) {
			monthComboOptions='';
			for (i=0; i<12; i++) {
				selected=(i== thisMonth.getMonth() ? 'selected="selected"' : '');
				monthComboOptions+= sprintf('<option value="%s" %s>%s</option>',i,selected,monthnames[i]);
			}
			monthCombo=sprintf('<select style="width:70; height:17; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:10px; color:#374955" name="months" onchange="%s.show(this.options[this.selectedIndex].value,%s.currentYear)">%s</select></td>',this.objName,this.objName,monthComboOptions);
		} else {
			monthCombo=monthnames[thisMonth.getMonth()];
		}
		
		/**
        * Build year combo
        */
		if (this.useYearCombo) {
			yearComboOptions='';
			//alert(this.year);
			//for (i=thisMonth.getFullYear() - this.yearComboRange; i <= (thisMonth.getFullYear()+this.yearComboRange); i++) {
			for (i=(this.year-100); i<=this.year; i++){
				selected=(i== thisMonth.getFullYear() ? 'selected="selected"' : '');
				yearComboOptions+= sprintf('<option value="%s" %s>%s</option>',i,selected,i);
			}
			yearCombo=sprintf('<td><select style="width:70; height:17; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:10px; color:#374955" name="years" onchange="%s.show(%s.currentMonth,this.options[this.selectedIndex].value)">%s</select>',this.objName,this.objName,yearComboOptions);
		} else {
			yearCombo=thisMonth.getFullYear();
		}
		
		if(lingua=="pt") {dia1="D"; dia2="S"; dia3="T"; dia4="Q"; dia5="Q"; dia6="S"; dia7="S"}
		else if(lingua=="es") {dia1="D"; dia2="L"; dia3="M"; dia4="M"; dia5="J"; dia6="V"; dia7="S"}
		else if(lingua=="en") {dia1="S"; dia2="M"; dia3="T"; dia4="W"; dia5="T"; dia6="F"; dia7="S"}
		else if(lingua=="de") {dia1="S"; dia2="M"; dia3="D"; dia4="M"; dia5="D"; dia6="F"; dia7="S"}
		else if(lingua=="fr") {dia1="D"; dia2="L"; dia3="M"; dia4="M"; dia5="J"; dia6="V"; dia7="S"}
		else if(lingua=="it") {dia1="D"; dia2="L"; dia3="M"; dia4="M"; dia5="G"; dia6="V"; dia7="S"}

		
		html='<table border="0" bgcolor="#eeeeee">';
		html+= sprintf('<tr><td class="dynCalendar_header">%s</td><td colspan="5" align="center" class="dynCalendar_header">%s %s</td><td align="right" class="dynCalendar_header">%s</td></tr>',prevLinkHTML,monthCombo,yearCombo,nextLinkHTML);
		html+= '<tr>';
		html+= '<td class="dynCalendar_dayname">'+dia1+'</td>';
		html+= '<td class="dynCalendar_dayname">'+dia2+'</td>';
		html+= '<td class="dynCalendar_dayname">'+dia3+'</td>';
		html+= '<td class="dynCalendar_dayname">'+dia4+'</td>';
		html+= '<td class="dynCalendar_dayname">'+dia5+'</td>';
		html+= '<td class="dynCalendar_dayname">'+dia6+'</td>';
		html+= '<td class="dynCalendar_dayname">'+dia7+'</td></tr>';
		html+= '<tr>'+ret.join('</tr>\n<tr>')+'</tr>';
		html+= '</table>';

		this._setHTML(html);
		if (!arguments[0] && !arguments[1]) {
			this._showLayer();
			this._setLayerPosition();
		}
	}

/**
* Writes HTML to document for layer
*
* @access public
*/
	function dynCalendar_writeHTML()
	{
		if (is_ie5up || is_nav6up || is_gecko) {
			document.write(sprintf('<a href="javascript: %s.show()"><img src="templates/calend.jpg" border="0" align="absmiddle"></a>',this.objName,this.imagesPath));
			document.write(sprintf('<div class="dynCalendar" id="%s" onmouseover="%s._mouseover(true)" onmouseout="%s._mouseover(false)"></div>',this.layerID,this.objName,this.objName));
		}
	}

/**
* Sets the offset to the mouse position
* that the calendar appears at.
*
* @access public
* @param integer Xoffset Number of pixels for vertical
*                        offset from mouse position
* @param integer Yoffset Number of pixels for horizontal
*                        offset from mouse position
*/
	function dynCalendar_setOffset(Xoffset,Yoffset)
	{
		this.setOffsetX(Xoffset);
		this.setOffsetY(Yoffset);
	}

/**
* Sets the X offset to the mouse position
* that the calendar appears at.
*
* @access public
* @param integer Xoffset Number of pixels for horizontal
*                        offset from mouse position
*/
	function dynCalendar_setOffsetX(Xoffset)
	{
		this.offsetX=Xoffset;
	}

/**
* Sets the Y offset to the mouse position
* that the calendar appears at.
*
* @access public
* @param integer Yoffset Number of pixels for vertical
*                        offset from mouse position
*/
	function dynCalendar_setOffsetY(Yoffset)
	{
		this.offsetY=Yoffset;
	}
	
/**
* Sets the images path
*
* @access public
* @param string path Path to use for images
*/
	function dynCalendar_setImagesPath(path)
	{
		this.imagesPath=path;
	}

/**
* Turns on/off the month dropdown
*
* @access public
* @param boolean useMonthCombo Whether to use month dropdown or not
*/
	function dynCalendar_setMonthCombo(useMonthCombo)
	{
		this.useMonthCombo=useMonthCombo;
	}

/**
* Turns on/off the year dropdown
*
* @access public
* @param boolean useYearCombo Whether to use year dropdown or not
*/
	function dynCalendar_setYearCombo(useYearCombo)
	{
		this.useYearCombo=useYearCombo;
	}

/**
* Sets the current month being displayed
*
* @access public
* @param boolean month The month to set the current month to
*/
	function dynCalendar_setCurrentMonth(month)
	{
		this.currentMonth=month;
	}

/**
* Sets the current month being displayed
*
* @access public
* @param boolean year The year to set the current year to
*/
	function dynCalendar_setCurrentYear(year)
	{
		this.currentYear=year;
	}

/**
* Sets the range of the year combo. Displays this number of
* years either side of the year being displayed.
*
* @access public
* @param integer range The range to set
*/
	function dynCalendar_setYearComboRange(range)
	{
		this.yearComboRange=range;
	}

/**
* Returns the layer object
*
* @access private
*/
	function dynCalendar_getLayer()
	{
		var layerID=this.layerID;

		if (document.getElementById(layerID)) {

			return document.getElementById(layerID);

		} else if (document.all(layerID)) {
			return document.all(layerID);
		}
	}

/**
* Hides the calendar layer
*
* @access private
*/
	function dynCalendar_hideLayer()
	{
		this._getLayer().style.visibility='hidden';
	}

/**
* Shows the calendar layer
*
* @access private
*/
	function dynCalendar_showLayer()
	{
		this._getLayer().style.visibility='visible';
	}

/**
* Sets the layers position
*
* @access private
*/
	function dynCalendar_setLayerPosition()
	{
		this._getLayer().style.top=(dynCalendar_mouseY+this.offsetY)+'px';
		this._getLayer().style.left=(dynCalendar_mouseX+this.offsetX)+'px';
	}

/**
* Sets the innerHTML attribute of the layer
*
* @access private
*/
	function dynCalendar_setHTML(html)
	{
		this._getLayer().innerHTML=html;
	}

/**
* Returns number of days in the supplied month
*
* @access private
* @param integer month The month to get number of days in
* @param integer year  The year of the month in question
*/
	function dynCalendar_getDaysInMonth(month,year)
	{
		monthdays=[31,28,31,30,31,30,31,31,30,31,30,31];
		if (month != 1) {
			return monthdays[month];
		} else {
			return ((year % 4== 0 && year % 100 != 0) || year % 400== 0 ? 29 : 28);
		}
	}

/**
* onMouse(Over|Out) event handler
*
* @access private
* @param boolean status Whether the mouse is over the
*                       calendar or not
*/
	function dynCalendar_mouseover(status)
	{
		dynCalendar_mouseoverStatus=status;
		return true;
	}

/**
* onMouseMove event handler
*/
	if (!mouseMoveEventAssigned) {
		dynCalendar_oldOnmousemove=document.onmousemove ? document.onmousemove : new Function;
	
		document.onmousemove=function ()
		{
			if (arguments[0]) {
				dynCalendar_mouseX=arguments[0].pageX;
				dynCalendar_mouseY=arguments[0].pageY;
			} else {
				dynCalendar_mouseX=event.clientX+document.body.scrollLeft;
				dynCalendar_mouseY=event.clientY+document.body.scrollTop;
				arguments[0]=null;
			}
	
			dynCalendar_oldOnmousemove(arguments[0]);
		}
		
		var mouseMoveEventAssigned=true;
	}

/**
* Callbacks for document.onclick
*/
	if (!clickEventAssigned) {
		dynCalendar_oldOnclick=document.onclick ? document.onclick : new Function;
	
		document.onclick=function ()
		{
			if(!dynCalendar_mouseoverStatus){
				for(i=0; i<dynCalendar_layers.length;++i){
					dynCalendar_layers[i]._hideLayer();
				}
			}
	
			dynCalendar_oldOnclick(arguments[0] ? arguments[0] : null);
		}
		var clickEventAssigned=true;
	}

/**
* Javascript mini implementation of sprintf()
*/
	function sprintf(strInput)
	{
		var strOutput='';
		var currentArg=1;
	
		for (var i=0; i<strInput.length; i++) {
			if (strInput.charAt(i)== '%' && i != (strInput.length - 1) && typeof(arguments[currentArg]) != 'undefined') {
				switch (strInput.charAt(++i)) {
					case 's':
						strOutput+= arguments[currentArg];
						break;
					case '%':
						strOutput+= '%';
						break;
				}
				currentArg++;
			} else {
				strOutput+= strInput.charAt(i);
			}
		}
	
		return strOutput;
	} 
