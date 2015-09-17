<div class="consumptionStocks view">
<h2><?php echo __('Consumption Stock'); ?></h2>
	<dl>
		<dt><?php echo __('Consumption Id'); ?></dt>
		<dd>
			<?php echo h($consumptionStock['ConsumptionStock']['consumption_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality Id'); ?></dt>
		<dd>
			<?php echo h($consumptionStock['ConsumptionStock']['quality_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Brand'); ?></dt>
		<dd>
			<?php echo h($consumptionStock['ConsumptionStock']['brand']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($consumptionStock['ConsumptionStock']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department Id'); ?></dt>
		<dd>
			<?php echo h($consumptionStock['ConsumptionStock']['department_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($consumptionStock['ConsumptionStock']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Material Id'); ?></dt>
		<dd>
			<?php echo h($consumptionStock['ConsumptionStock']['material_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($consumptionStock['ConsumptionStock']['dimension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($consumptionStock['ConsumptionStock']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo h($consumptionStock['ConsumptionStock']['shift']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Consumption Stock'), array('action' => 'edit', $consumptionStock['ConsumptionStock']['consumption_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Consumption Stock'), array('action' => 'delete', $consumptionStock['ConsumptionStock']['consumption_id']), null, __('Are you sure you want to delete # %s?', $consumptionStock['ConsumptionStock']['consumption_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Consumption Stocks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Consumption Stock'), array('action' => 'add')); ?> </li>
	</ul>
</div>
