<div class="scrapDepartments view">
<h2><?php echo __('Scrap Department'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($scrapDepartment['ScrapDepartment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($scrapDepartment['ScrapDepartment']['department_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo h($scrapDepartment['ScrapDepartment']['shift']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($scrapDepartment['ScrapDepartment']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality Brand'); ?></dt>
		<dd>
			<?php echo h($scrapDepartment['ScrapDepartment']['quality_brand']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($scrapDepartment['ScrapDepartment']['quantity']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Scrap Department'), array('action' => 'edit', $scrapDepartment['ScrapDepartment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Scrap Department'), array('action' => 'delete', $scrapDepartment['ScrapDepartment']['id']), null, __('Are you sure you want to delete # %s?', $scrapDepartment['ScrapDepartment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Scrap Departments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scrap Department'), array('action' => 'add')); ?> </li>
	</ul>
</div>
