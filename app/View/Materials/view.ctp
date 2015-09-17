<div class="materials view">
<h2><?php echo __('Material'); ?></h2>
	<dl>
		<dt><?php echo __('Material Id'); ?></dt>
		<dd>
			<?php echo h($material['Material']['material_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Material Name'); ?></dt>
		<dd>
			<?php echo h($material['Material']['material_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Material State'); ?></dt>
		<dd>
			<?php echo h($material['Material']['material_state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Id'); ?></dt>
		<dd>
			<?php echo h($material['Material']['category_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vender Id'); ?></dt>
		<dd>
			<?php echo h($material['Material']['vender_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measuring Unit'); ?></dt>
		<dd>
			<?php echo h($material['Material']['measuring_unit']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Material'), array('action' => 'edit', $material['Material']['material_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Material'), array('action' => 'delete', $material['Material']['material_id']), null, __('Are you sure you want to delete # %s?', $material['Material']['material_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Materials'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Material'), array('action' => 'add')); ?> </li>
	</ul>
</div>
