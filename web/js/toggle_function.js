function toggleTagDiv(v)
{
  if (Element.visible('tags_for_'+v))
  {
    new Effect.BlindUp('tags_for_'+v, {duration:0.4});
  }
  else
  {
    new Effect.BlindDown('tags_for_'+v, {duration:0.4});
  }

  return false;
}

function toggleDiv(loc_type,img)
{
	var location_div=loc_type+'_politicians';
	var image = $(img);
	if (Element.visible(location_div))
	{
		new Effect.BlindUp(location_div, {duration:0.6});
		image.src='/images/buttons/open.png';
	}
	else
	{
		new Effect.BlindDown(location_div, {duration:0.6});
		image.src='/images/buttons/close.png';
	}
	return false;
}

function toggleContainer(div)
{
  var image = $(div+'_toggle_img');
  if (Element.visible(div))
  {
    new Effect.BlindUp(div, {duration:0.6});
	image.src = '/images/buttons/open.png';
  }
  else
  {
    new Effect.BlindDown(div, {duration:0.6});
	image.src = '/images/buttons/close.png';

  }

  return false;
}

function showPreviews(titolo,area,id,tipo)
{
	var typeValue = Form.getInputs('form1','radio','tpl').find(function(radio) {return radio.checked; }).value;
	if (tipo=='Voti') tipo='VotiV';
	if (tipo=='Indice') tipo='IndiceI';
	if (tipo=='Presenze') tipo='PresenzeP';
	var win = new Window({url: 'http://www.openpolis.it/widgets/'+tipo+'/politician_id/'+id+'/dim/'+$('width').value+escape($('widthtype').value)+'/tipo/'+typeValue,className: "mac_os_x", width:350, height:400, zIndex: 100, resizable: true, title: titolo, hideEffect: Effect.SwitchOff, draggable:true, wiredDrag: true})
	//win.setHTMLContent($(area).value);
	win.setDestroyOnClose();
	win.setStatusBar(titolo);
	win.showCenter();
	win.refresh();
	win.toFront();
}

function impostaCodice(area,id,tipo)
{
	var typeValue = Form.getInputs('form1','radio','tpl').find(function(radio) {return radio.checked; }).value;
	$(area).value='<script src="http://www.openpolis.it/widgets/'+tipo+'/politician_id/'+id+'/dim/'+$('width').value+escape($('widthtype').value)+'/tipo/'+typeValue+'" type="text/javascript"></script>';
}

function copia(area)
{

if (window.clipboardData)
   {

   window.clipboardData.setData("Text", $(area).value);

   }
   else if (window.netscape)
   {

   netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');

   var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
   if (!clip) return;

   var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
   if (!trans) return;

   trans.addDataFlavor('text/unicode');

   var str = new Object();
   var len = new Object();

   var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);

   var copytext=$(area).value;

   str.data=copytext;

   trans.setTransferData("text/unicode",str,copytext.length*2);

   var clipid=Components.interfaces.nsIClipboard;

   if (!clip) return false;

   clip.setData(trans,null,clipid.kGlobalClipboard);

   }
   alert("WIdget copiato");
   return false;

}