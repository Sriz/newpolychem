<div class="printingStocks form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'PrintingStocks', 'action' => 'edit'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('PrintingStock'); ?>
	<fieldset>
		<legend><?php echo __('Edit Printing Stock'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('printing_rawmaterialid');
		echo $this->Form->input('quantity');
		echo $this->Form->input('balance');
		echo $this->Form->input('issue');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PrintingStock.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PrintingStock.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Printing Stocks'), array('action' => 'index')); ?></li>
	</ul>
</div>
