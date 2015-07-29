<?php echo '<?' ?>xml version="1.0" encoding="utf-8" ?>
<rsp stat="ok" version="1.0">
  <?php foreach($classifica as $k=>$d) : ?>
    <politician>
      <opid><?php echo $k ?></opid>
      <contentid><?php echo $d[1] ?></contentid>
      <days><?php echo $d[0] ?></days>
    </politician>
  <?php endforeach ?>	
</rsp>