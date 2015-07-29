Event.observe(window, 'load', function() {
  var accordion_accordion_container = new accordion ('accordion_container', {resizeSpeed:10});

  // rimuovere il commento se si desidera che la prima voce sia attivata
  // accordion_accordion_container.activate($$('#accordion_container .accordion_toggle')[0]); 
});
