<div class="baseEmbosses view">
<h2><?php echo __('Base Emboss'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($baseEmboss['BaseEmboss']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Brand'); ?></dt>
		<dd>
			<?php echo h($baseEmboss['BaseEmboss']['Brand']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($baseEmboss['BaseEmboss']['Dimension']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($baseEmboss['BaseEmboss']['Type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($baseEmboss['BaseEmboss']['Color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Emboss'); ?></dt>
		<dd>
			<?php echo h($baseEmboss['BaseEmboss']['Emboss']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Base Emboss'), array('action' => 'edit', $baseEmboss['BaseEmboss']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Base Emboss'), array('action' => 'delete', $baseEmboss['BaseEmboss']['id']), null, __('Are you sure you want to delete # %s?', $baseEmboss['BaseEmboss']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Base Embosses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Base Emboss'), array('action' => 'add')); ?> </li>
	</ul>
</div>
