<div class="mixingMaterials form">
<?php echo $this->Form->create('ScrapMixing'); ?>
	<fieldset>
		<legend><?php echo __('Add Mixing Material'); ?></legend>
	<?php
		//echo $this->Form->input('department');
		$arr = ['printed_scrap'=>'Printed Scrap','unprinted_scrap'=>'Unprinted Scrap'];
		echo $this->Form->input('scrap_sent',['options'=>$arr, 'label'=>'Category', 'empty'=>'No-Category','required'=>'required']);

		echo $this->Form->input('weight',['required'=>'required']);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Mixing Materials'), array('action' => 'index')); ?></li>
	</ul>
</div>
