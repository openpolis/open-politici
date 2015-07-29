<pre <?php if($op_import_modifications->getBlockedAt()): ?>style="color: #ababab"<?php endif; ?>>
<?php echo str_replace(";", "|", $op_import_modifications->getCsvRec()); ?>
</pre>