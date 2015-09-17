<div class="mixingProducts form">
<?php echo $this->Form->create('MixingProduct'); ?>
	<fieldset>
		<legend><?php echo __('Edit Mixing Product'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MixingProduct.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MixingProduct.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Mixing Products'), array('action' => 'index')); ?></li>
	</ul>
</div>
