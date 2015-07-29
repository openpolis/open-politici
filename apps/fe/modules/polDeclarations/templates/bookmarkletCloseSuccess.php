<?php echo use_helper('Javascript') ?>

   
<div align="center" style="padding:100px 0px 10px 0px">  

<div style="font-size:20px;">
  
    <span class="bacchetta">
          La dichiarazione &egrave; stata pubblicata su openpolis!
    </span>
  
</div> 

<hr />
<br />
<div align="center">
  <input type="button" value="Chiudi la finestra" onClick="javascript:window.close()" class="cerca"> <br />
  
  <?php if ($declaration_id!==0) : ?>
    <br/>oppure<br/>
    <?php echo link_to('vai alla dichiarazione pubblicata','@dichiarazione?declaration_id='.$declaration_id, array('target' => '_blank', 'onClick' => 'javascript:window.close()'))?>.
  <?php endif ?>  
  
</div>
<br />
</div>