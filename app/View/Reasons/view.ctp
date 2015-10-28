<div class="reasons view">
<h2><?php echo __('Reason'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($reason['Reason']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reasons'); ?></dt>
		<dd>
			<?php echo h($reason['Reason']['reasons']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($reason['Reason']['department_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Reason'), array('action' => 'edit', $reason['Reason']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Reason'), array('action' => 'delete', $reason['Reason']['id']), null, __('Are you sure you want to delete # %s?', $reason['Reason']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reasons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reason'), array('action' => 'add')); ?> </li>
	</ul>
</div>
