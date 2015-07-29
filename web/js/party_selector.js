function change_party(el, original_url) {
  var party_id = el.options[el.selectedIndex].value;
  if (party_id == '') party_id = 'x';
  var url_pattern = /assegna_candidato\/(.*)\/x/;
  var result = original_url.match(url_pattern);
  var politician_id = result[1];
  var url = original_url.replace(url_pattern, "assegna_candidato/$1/" + party_id);
  new Ajax.Updater($('party_info_' + politician_id), url, { 
    asynchronous: true,
    evalScripts: false,
    method: 'get', 
    onComplete:function(request, json){
      Element.hide('indicator_' + politician_id)}, 
    onLoading:function(request, json){
      Element.show('indicator_' + politician_id)}});
}
