<script>
jQuery.noConflict();
(function($) {
    $(document).ready(function(){
      $("li.keep").click(function (){
        return confirm("L'operazione è difficilmente riparabile. Conferma.");
      });
    });
  })(jQuery);
</script>