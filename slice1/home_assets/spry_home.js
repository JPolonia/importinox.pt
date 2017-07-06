var sp2;
var quotes;
var lastTab="slice1";
function switchTab(tab)
{
	if (tab!=lastTab)
	{
		document.getElementById(tab).className=("tabActive");
		document.getElementById(lastTab).className=("tab");
		sp2.showPanel(tab+"Panel");
		lastTab=tab;
	}
}
Spry.Utils.addLoadListener(function()
{
	Spry.$$(".slidingTabPanelWrapper").setStyle("display: block");
	Spry.$$("#slice1, #slice2, #slice3, #slice4, #slice5, #slice6, #slice7, #slice8, #slice9, #slice10, #slice11").addEventListener("click", function(){ switchTab(this.id); return false; }, false);
	Spry.$$("#slidingPanel").addClassName("SlidingPanels").setAttribute("tabindex", "0");
	Spry.$$("#slidingPanel > div").addClassName("SlidingPanelsContentGroup");
	Spry.$$("#slidingPanel .SlidingPanelsContentGroup > div").addClassName("SlidingPanelsContent");
	sp2 = new Spry.Widget.SlidingPanels('slidingPanel');
	Spry.$$(".quoteBox").setStyle("position: relative; height: 260px;");
	quotes = Spry.$$(".quote").setStyle("position: absolute; top: 0px; left: 0px; opacity: 0; filter: alpha(opacity=0);");
});
