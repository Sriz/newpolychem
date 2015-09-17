<div class="timelossReasons view">
<h2><?php echo __('Timeloss Reason'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($timelossReason['TimelossReason']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($timelossReason['TimelossReason']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reason'); ?></dt>
		<dd>
			<?php echo h($timelossReason['TimelossReason']['reason']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department'); ?></dt>
		<dd>
			<?php echo h($timelossReason['TimelossReason']['department']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Timeloss Reason'), array('action' => 'edit', $timelossReason['TimelossReason']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Timeloss Reason'), array('action' => 'delete', $timelossReason['TimelossReason']['id']), null, __('Are you sure you want to delete # %s?', $timelossReason['TimelossReason']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Timeloss Reasons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Timeloss Reason'), array('action' => 'add')); ?> </li>
	</ul>
</div>
