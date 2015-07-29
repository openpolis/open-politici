<?php
  echo str_replace(array('index_be_', 'index_be.php'), 
                   array('index_fe_', 'index.php'), 
                   link_to($op_user->__toString(), "/user/show?hash=" . $op_user->getHash()) );
?>