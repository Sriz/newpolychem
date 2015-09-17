<div class="factoryHalts view">
<h2><?php echo __('Factory Halt'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($factoryHalt['FactoryHalt']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($factoryHalt['FactoryHalt']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($factoryHalt['FactoryHalt']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reason'); ?></dt>
		<dd>
			<?php echo h($factoryHalt['FactoryHalt']['reason']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($factoryHalt['FactoryHalt']['department_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Factory Halt'), array('action' => 'edit', $factoryHalt['FactoryHalt']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Factory Halt'), array('action' => 'delete', $factoryHalt['FactoryHalt']['id']), null, __('Are you sure you want to delete # %s?', $factoryHalt['FactoryHalt']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Factory Halts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Factory Halt'), array('action' => 'add')); ?> </li>
	</ul>
</div>
