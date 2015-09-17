<div class="laminatingReasons view">
<h2><?php echo __('Laminating Reason'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($laminatingReason['LaminatingReason']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reason'); ?></dt>
		<dd>
			<?php echo h($laminatingReason['LaminatingReason']['reason']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($laminatingReason['LaminatingReason']['type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Laminating Reason'), array('action' => 'edit', $laminatingReason['LaminatingReason']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Laminating Reason'), array('action' => 'delete', $laminatingReason['LaminatingReason']['id']), null, __('Are you sure you want to delete # %s?', $laminatingReason['LaminatingReason']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Laminating Reasons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Laminating Reason'), array('action' => 'add')); ?> </li>
	</ul>
</div>
