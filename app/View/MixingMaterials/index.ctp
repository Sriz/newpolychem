<div class="mixingMaterials index">
	<h2><?php echo __('Mixing Materials'); ?></h2>
	<table class="col-md-12 table-bordered table-striped table-condensed cf">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('department'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
        <?php
        $arr = array();
        foreach($category as $c):
            $arr[$c['CategoryMaterial']['id']] = $c['CategoryMaterial']['name'];
        endforeach;
        ?>
	<?php foreach ($mixingMaterials as $mixingMaterial): ?>
	<tr>
		<td><?php echo h($mixingMaterial['MixingMaterial']['id']); ?>&nbsp;</td>
		<td><?php echo h($mixingMaterial['MixingMaterial']['name']); ?>&nbsp;</td>
		<td><?php echo h($mixingMaterial['MixingMaterial']['department']); ?>&nbsp;</td>
		<td><?=isset($mixingMaterial['MixingMaterial']['category_id'])?$arr[$mixingMaterial['MixingMaterial']['category_id']]:'No-Category'; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $mixingMaterial['MixingMaterial']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mixingMaterial['MixingMaterial']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mixingMaterial['MixingMaterial']['id']), null, __('Are you sure you want to delete # %s?', $mixingMaterial['MixingMaterial']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Mixing Material'), array('action' => 'add')); ?></li>
	</ul>
</div>
