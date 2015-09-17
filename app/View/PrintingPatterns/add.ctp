<div class="printingPatterns form">
<?php echo $this->Form->create('PrintingPattern'); ?>
	<fieldset>
		<legend><?php echo __('Add Printing Pattern'); ?></legend>
	<?php
		echo $this->Form->input('pattern_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Printing Patterns'), array('action' => 'index')); ?></li>
	</ul>
</div>
