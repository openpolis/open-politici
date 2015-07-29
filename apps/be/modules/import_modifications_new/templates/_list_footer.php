<script type="text/javascript">
//<![CDATA[

jQuery.noConflict();
(function($) {
  $().ready(function(){

	  var sWindow = $('<div id="windowContainer" title="Risoluzione similarit&agrave;"></div>');

    $('.sf_admin_td_actions li.similarity a').click(
    	function(){
    	  var id = $(this).attr('id');
    		sWindow.dialog({
    		  width: 800,
    			height: 500,
    			modal: true,
    			buttons: { 
    			  Ok: function() {
    			   $(this).dialog("close"); 
    			  }
    			}, 
    			close: function(event, ui){
    			  $('#windowContainer').html('');
    			}
    		});
    		$('#windowContainer').append('<div><img src="/images/indicator.gif"/> Attendere ...</div>');
    		$('#windowContainer').load('getSimilars?id='+id);
    	}
    );
    

  })
})(jQuery);

//]]>
</script>


