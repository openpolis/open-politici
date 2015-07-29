<div id="title">
  <h1>
    <span class="bacchetta">
        e-mail inviate!
    </span>
  </h1>
</div>

<div id="mail">

  <p class="main">Hai inviato con successo le e-mail a:</p>

  <div id="lista">
    <?php
    	foreach ($friends as $friend) {
    		echo $friend . "<br/>";
    	}
    ?>
  </div>

  <br />
  <h2><?php echo link_to("&raquo;&nbsp;torna all'elenco dei temi", "@themes_list?sort=insert"); ?><br /></h2>
  <?php echo link_to("&raquo;&nbsp;vai alla pagina del tema appena inserito", "@tema?theme_id=$theme_id"); ?>


</div>