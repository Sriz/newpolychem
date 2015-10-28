<div class="printingRawmaterials form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'PrintingRawmaterials', 'action' => 'edit'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('PrintingRawmaterial'); ?>
	<fieldset>
		<legend><?php echo __('Edit Printing Rawmaterial'); ?></legend>
	<?php
		echo $this->Form->input('printing_rawmaterialid');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PrintingRawmaterial.printing_rawmaterialid')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PrintingRawmaterial.printing_rawmaterialid'))); ?></li>
		<li><?php echo $this->Html->link(__('List Printing Rawmaterials'), array('action' => 'index')); ?></li>
	</ul>
</div>
