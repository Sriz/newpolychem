<div class="productionShiftreports view">
<h2><?php echo __('Production Shiftreport'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productionShiftreport['ProductionShiftreport']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo h($productionShiftreport['ProductionShiftreport']['shift']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($productionShiftreport['ProductionShiftreport']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Brand'); ?></dt>
		<dd>
			<?php echo h($productionShiftreport['ProductionShiftreport']['brand']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($productionShiftreport['ProductionShiftreport']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base Ut'); ?></dt>
		<dd>
			<?php echo h($productionShiftreport['ProductionShiftreport']['base_ut']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base Mt'); ?></dt>
		<dd>
			<?php echo h($productionShiftreport['ProductionShiftreport']['base_mt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Print M'); ?></dt>
		<dd>
			<?php echo h($productionShiftreport['ProductionShiftreport']['print_m']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Output'); ?></dt>
		<dd>
			<?php echo h($productionShiftreport['ProductionShiftreport']['output']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift Incharge'); ?></dt>
		<dd>
			<?php echo h($productionShiftreport['ProductionShiftreport']['shift_incharge']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Production Shiftreport'), array('action' => 'edit', $productionShiftreport['ProductionShiftreport']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Production Shiftreport'), array('action' => 'delete', $productionShiftreport['ProductionShiftreport']['id']), null, __('Are you sure you want to delete # %s?', $productionShiftreport['ProductionShiftreport']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Production Shiftreports'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Production Shiftreport'), array('action' => 'add')); ?> </li>
	</ul>
</div>
