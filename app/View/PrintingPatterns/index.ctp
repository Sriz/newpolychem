<div class="printingPatterns index">
	<h2><?php echo __('Printing Patterns'); ?></h2>
	<div class="table-responsive">
	<table class="col-md-12 table-bordered table-striped table-condensed cf">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('pattern_name'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
        $arr = array();
        foreach($category as $c):
            $arr[$c['CategoryPrinting']['id']] = $c['CategoryPrinting']['name'];
        endforeach;
        ?>
	<?php foreach ($printingPatterns as $printingPattern): ?>
		
	<tr>
		<td><?php echo h($printingPattern['PrintingPattern']['id']); ?>&nbsp;</td>
		<td><?php echo h($printingPattern['PrintingPattern']['pattern_name']); ?>&nbsp;</td>
		<!-- <td><?php echo h($printingPattern['PrintingPattern']['category_id']); ?>&nbsp;</td> -->
		<td><?=isset($printingPattern['PrintingPattern']['category_id'])?$arr[$printingPattern['PrintingPattern']['category_id']]:'No-Category'; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $printingPattern['PrintingPattern']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $printingPattern['PrintingPattern']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $printingPattern['PrintingPattern']['id']), null, __('Are you sure you want to delete # %s?', $printingPattern['PrintingPattern']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	</div>
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
		<li><?php echo $this->Html->link(__('New Printing Pattern'), array('action' => 'add')); ?></li>
	</ul>
</div>
