<div class="printingData form">
<?php echo $this->Form->create('PrintingDatum'); ?>
	<fieldset>
		<legend><?php echo __('Add Printing Datum'); ?></legend>
	<?php
		echo $this->Form->input('dimension');
		echo $this->Form->input('color');
		echo $this->Form->input('color_code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Printing Data'), array('action' => 'index')); ?></li>
	</ul>
</div>
