<div class="printdimensiontarget index">
	<h2><?php echo __('Print Dimension Target'); ?></h2>
	<table class="col-md-12 table-bordered table-striped table-condensed cf" cellpadding="0" cellspacing="0">
	<tr>
			
			<th><?php echo $this->Paginator->sort('dimension'); ?></th>
			
			<th><?php echo $this->Paginator->sort('target'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($dimensions as $dimension): ?>
	<tr>
		
		<td><?php echo h($dimension['PrintDimensionTarget']['dimension']); ?>&nbsp;</td>
		
		<td><?php echo h($dimension['PrintDimensionTarget']['target']); ?>&nbsp;</td>
		<td class="actions">
			
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $dimension['PrintDimensionTarget']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dimension['PrintDimensionTarget']['id']), null, __('Are you sure you want to delete # %s?', $dimension['PrintDimensionTarget']['id'])); ?>
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
	<ul class="pagination">
	<?php
		echo '<li>'.$this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')).'</li>';
		echo '<li>'.$this->Paginator->numbers(array('separator' => '')).'</li>';
		echo '<li>'.$this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')).'</li>';
	?>
	</ul>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Dimension'), array('action' => 'add')); ?></li>
	</ul>
</div>
