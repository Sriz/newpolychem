<div class="laminatingReasons form">
<?php echo $this->Form->create('LaminatingReason'); ?>
	<fieldset>
		<legend><?php echo __('Add Laminating Reason'); ?></legend>
	<?php
		echo $this->Form->input('reason');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Laminating Reasons'), array('action' => 'index')); ?></li>
	</ul>
</div>
