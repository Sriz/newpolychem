<div class="dimensiontarget view">
<h2><?php echo __('Dimension'); ?></h2>
	<dl>
		
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($dimension['DimensionTarget']['dimension']); ?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('Target'); ?></dt>
		<dd>
			<?php echo h($dimension['DimensionTarget']['target']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit DimensionTarget'), array('action' => 'edit', $dimension['DimensionTarget']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete DimensionTarget'), array('action' => 'delete', $dimension['DimensionTarget']['id']), null, __('Are you sure you want to delete # %s?', $dimension['DimensionTarget']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List DimensionTarget'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New DimensionTarget'), array('action' => 'add')); ?> </li>
	</ul>
</div>
