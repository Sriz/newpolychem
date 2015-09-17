<div class="qualities view">
<h2><?php echo __('Quality'); ?></h2>
	<dl>
		<dt><?php echo __('Quality Id'); ?></dt>
		<dd>
			<?php echo h($quality['Quality']['quality_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($quality['Quality']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($quality['Quality']['dimension']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Quality'), array('action' => 'edit', $quality['Quality']['quality_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Quality'), array('action' => 'delete', $quality['Quality']['quality_id']), null, __('Are you sure you want to delete # %s?', $quality['Quality']['quality_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Qualities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Quality'), array('action' => 'add')); ?> </li>
	</ul>
</div>
