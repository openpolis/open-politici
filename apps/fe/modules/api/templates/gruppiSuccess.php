<?php echo '<?' ?>xml version="1.0" encoding="utf-8" ?>
<rsp stat="ok" version="1.0">
  <gruppi>
	  <?php while($gruppi->next()): ?>
	    <gruppo>
	      <id><?php echo $gruppi->getInt(1) ?></id>
	      <nome><?php echo $gruppi->getString(2) ?></nome>
	      <acronimo><?php echo $gruppi->getString(3) ?></acronimo>
	    </gruppo> 
	  <?php endwhile; ?>
  </gruppi>
</rsp>