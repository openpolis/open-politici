function change_area(el, original_url) {
  var area = el.options[el.selectedIndex].value;
  if (area == '') area = 'x';
  var url = original_url.replace(/temi\/.*?\//, 'temi/'+area+'/');
  new Ajax.Updater($('items_container'), url, { 
    asynchronous: true,
    evalScripts: false,
    method: 'get', 
    onComplete:function(request, json){
      Element.hide('indicator')}, 
    onLoading:function(request, json){
      Element.show('indicator')}});
}
