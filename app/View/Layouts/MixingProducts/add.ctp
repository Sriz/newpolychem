<div class="mixingProducts form">
<?php echo $this->Form->create('MixingProduct'); ?>
	<fieldset>
		<legend><?php echo __('Add Mixing Product'); ?></legend>
	<?php
		echo $this->Form->input('quality');
		echo $this->Form->input('color');
		echo $this->Form->input('dimension');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Mixing Products'), array('action' => 'index')); ?></li>
	</ul>
</div>
