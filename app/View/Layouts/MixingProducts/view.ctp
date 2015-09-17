<div class="mixingProducts view">
<h2><?php echo __('Mixing Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mixingProduct['MixingProduct']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quality'); ?></dt>
		<dd>
			<?php echo h($mixingProduct['MixingProduct']['quality']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Color'); ?></dt>
		<dd>
			<?php echo h($mixingProduct['MixingProduct']['color']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimension'); ?></dt>
		<dd>
			<?php echo h($mixingProduct['MixingProduct']['dimension']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mixing Product'), array('action' => 'edit', $mixingProduct['MixingProduct']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mixing Product'), array('action' => 'delete', $mixingProduct['MixingProduct']['id']), null, __('Are you sure you want to delete # %s?', $mixingProduct['MixingProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mixing Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mixing Product'), array('action' => 'add')); ?> </li>
	</ul>
</div>
