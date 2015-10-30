<div class="calenderInputs index">
	<h2><?php echo __('Calender Inputs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('total_input'); ?></th>
			<th><?php echo $this->Paginator->sort('actual_raw_material'); ?></th>
			<th><?php echo $this->Paginator->sort('DANA'); ?></th>
			<th><?php echo $this->Paginator->sort('total_scrap'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('shift'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($calenderInputs as $calenderInput): ?>
	<tr>
		<td><?php echo h($calenderInput['CalenderInput']['id']); ?>&nbsp;</td>
		<td><?php echo h($calenderInput['CalenderInput']['total_input']); ?>&nbsp;</td>
		<td><?php echo h($calenderInput['CalenderInput']['actual_raw_material']); ?>&nbsp;</td>
		<td><?php echo h($calenderInput['CalenderInput']['DANA']); ?>&nbsp;</td>
		<td><?php echo h($calenderInput['CalenderInput']['total_scrap']); ?>&nbsp;</td>
		<td><?php echo h($calenderInput['CalenderInput']['date']); ?>&nbsp;</td>
		<td><?php echo h($calenderInput['CalenderInput']['shift']); ?>&nbsp;</td>
		<td><?php echo h($calenderInput['CalenderInput']['department_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $calenderInput['CalenderInput']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $calenderInput['CalenderInput']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $calenderInput['CalenderInput']['id']), null, __('Are you sure you want to delete # %s?', $calenderInput['CalenderInput']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Calender Input'), array('action' => 'add')); ?></li>
	</ul>
</div>
