<div class="timelossReasons index">
	<h2><?php echo __('Timeloss Reasons'); ?></h2>
	<table class="col-md-12 table-bordered table-striped table-condensed cf">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('reason'); ?></th>
			<th><?php echo $this->Paginator->sort('department'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($timelossReasons as $timelossReason): ?>
	<tr>
		<td><?php echo h($timelossReason['TimelossReason']['id']); ?>&nbsp;</td>
		<td><?php echo h($timelossReason['TimelossReason']['type']); ?>&nbsp;</td>
		<td><?php echo h($timelossReason['TimelossReason']['reason']); ?>&nbsp;</td>
		<td><?php echo h($timelossReason['TimelossReason']['department']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $timelossReason['TimelossReason']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $timelossReason['TimelossReason']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $timelossReason['TimelossReason']['id']), null, __('Are you sure you want to delete # %s?', $timelossReason['TimelossReason']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Timeloss Reason'), array('action' => 'add')); ?></li>
	</ul>
</div>
