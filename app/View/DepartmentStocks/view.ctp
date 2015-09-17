<div class="departmentStocks view">
<h2><?php echo __('Department Stock'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($departmentStock['DepartmentStock']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($departmentStock['DepartmentStock']['department_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Material Id'); ?></dt>
		<dd>
			<?php echo h($departmentStock['DepartmentStock']['material_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($departmentStock['DepartmentStock']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($departmentStock['DepartmentStock']['quantity']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Department Stock'), array('action' => 'edit', $departmentStock['DepartmentStock']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Department Stock'), array('action' => 'delete', $departmentStock['DepartmentStock']['id']), null, __('Are you sure you want to delete # %s?', $departmentStock['DepartmentStock']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Department Stocks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department Stock'), array('action' => 'add')); ?> </li>
	</ul>
</div>
