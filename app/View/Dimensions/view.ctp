<div class="dimensions view">
<h2><?php echo __('Dimension'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dimension['Dimension']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($dimension['Dimension']['dimension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base'); ?></dt>
		<dd>
			<?php echo h($dimension['Dimension']['base']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality'); ?></dt>
		<dd>
			<?php echo h($dimension['Dimension']['quality']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($dimension['Dimension']['color']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dimension'), array('action' => 'edit', $dimension['Dimension']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dimension'), array('action' => 'delete', $dimension['Dimension']['id']), null, __('Are you sure you want to delete # %s?', $dimension['Dimension']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dimensions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dimension'), array('action' => 'add')); ?> </li>
	</ul>
</div>
