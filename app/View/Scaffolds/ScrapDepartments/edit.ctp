<div class="scrapDepartments form">
<?php echo $this->Form->create('ScrapDepartment'); ?>
	<fieldset>
		<legend><?php echo __('Edit Scrap Department'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('department_id');
		echo $this->Form->input('shift');
		echo $this->Form->input('date');
		echo $this->Form->input('quality_brand');
		echo $this->Form->input('quantity');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ScrapDepartment.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ScrapDepartment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Scrap Departments'), array('action' => 'index')); ?></li>
	</ul>
</div>
