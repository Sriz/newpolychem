<?php 
echo $this->Html->link('Add new Dimension Target', array('controller' => 'dimensiontarget', 'action' => 'add','align'=>'right'), array('class' => 'btn btn-primary'));?>


<div class="dimensiontarget index">
	<h2><?php echo __('Dimension Target'); ?></h2>
	<table class="col-md-12 table-bordered table-striped table-condensed cf" cellpadding="0" cellspacing="0">
	<tr>
			
			<th><?php echo ('Dimension'); ?></th>
			<th><?php echo ('Type'); ?></th>
			<th><?php echo ('Brand'); ?></th>
			<th><?php echo ('Target'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>

	<?php foreach ($dimensions as $dimension): ?>
	<tr>
		
		<td><?php echo h($dimension['dimension_target']['dimension']); ?>&nbsp;</td>
		<td><?php echo h($dimension['dimension_target']['type']); ?>&nbsp;</td>
		<td><?php echo h($dimension['dimension_target']['brand']); ?>&nbsp;</td>
		<td><?php echo h($dimension['dimension_target']['target']); ?>&nbsp;</td>
		<td class="actions">
			
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $dimension['dimension_target']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dimension['dimension_target']['id']), null, __('Are you sure you want to delete # %s?', $dimension['dimension_target']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	
</div>
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Dimension'), array('action' => 'add')); ?></li>
	</ul>
</div> -->
