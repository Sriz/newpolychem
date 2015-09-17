<div class="laminatingReasonOthers view">
<h2><?php echo __('Laminating Reason Other'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($laminatingReasonOther['LaminatingReasonOther']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($laminatingReasonOther['LaminatingReasonOther']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reason'); ?></dt>
		<dd>
			<?php echo h($laminatingReasonOther['LaminatingReasonOther']['reason']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Laminating Reason Other'), array('action' => 'edit', $laminatingReasonOther['LaminatingReasonOther']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Laminating Reason Other'), array('action' => 'delete', $laminatingReasonOther['LaminatingReasonOther']['id']), null, __('Are you sure you want to delete # %s?', $laminatingReasonOther['LaminatingReasonOther']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Laminating Reason Others'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Laminating Reason Other'), array('action' => 'add')); ?> </li>
	</ul>
</div>
