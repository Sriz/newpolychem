<div class="mixingMaterials form">
<?php echo $this->Form->create('LaminatingTarget'); ?>
	<fieldset>
		<legend><?php echo __('Edit Mixing Material'); ?></legend>
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('brand',['required'=>'required']);
	echo $this->Form->input('type',['required'=>'required']);
	echo $this->Form->input('weight',['required'=>'required']);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('LaminatingTarget.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('LaminatingTarget.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Laminating Targets'), array('action' => 'index')); ?></li>
	</ul>
</div>
