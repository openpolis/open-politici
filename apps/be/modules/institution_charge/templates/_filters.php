<?php use_helper('Object') ?>

<div class="sf_admin_filters">
<?php echo form_tag('institution_charge/list', array('method' => 'get')) ?>

  <fieldset>
    <h2><?php echo __('filters') ?></h2>
    <div class="form-row">
      <label for="filters_description">ID del politico</label>
      <div class="content">
        <?php echo input_tag('filters[politician_id]', 
                             isset($filters['politician_id']) ? $filters['politician_id'] : null, array ('size' => 10 )) ?>
      </div>
    </div>
  </fieldset>

</form>
</div>
