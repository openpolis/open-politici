<pre <?php if($op_import_similar->getDeletedAt()): ?>style="color: #ababab"<?php endif; ?>>
Min: <?php echo str_replace(";", "|", $op_import_similar->getNewCsvRec()); ?>

 Op: <?php echo str_replace(";", "|", $op_import_similar->getOldCsvRec()); ?>
</pre>