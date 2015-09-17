<div class="scrapDepartments form">
<?php echo $this->Form->create('ScrapDepartment'); ?>
	<fieldset>
		<legend><?php echo __('Add Scrap Department'); ?></legend>
	<?php
		echo $this->Form->input('department_id',array('class'=>'form-control input-sm','type'=>'text','id'=>'department'));
		echo $this->Form->input('shift',array('id'=>'shift'));
		echo $this->Form->input('date',array('class'=>'form-control input-sm','id'=>'datetime'));
		echo $this->Form->input('quality_brand');
		echo $this->Form->input('quantity');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Scrap Departments'), array('action' => 'index')); ?></li>
	</ul>
</div>
