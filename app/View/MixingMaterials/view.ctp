<div class="mixingMaterials view">
<h2><?php echo __('Mixing Material'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mixingMaterial['MixingMaterial']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($mixingMaterial['MixingMaterial']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Department'); ?></dt>
		<dd>
			<?php echo h($mixingMaterial['MixingMaterial']['department']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mixing Material'), array('action' => 'edit', $mixingMaterial['MixingMaterial']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mixing Material'), array('action' => 'delete', $mixingMaterial['MixingMaterial']['id']), null, __('Are you sure you want to delete # %s?', $mixingMaterial['MixingMaterial']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mixing Materials'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mixing Material'), array('action' => 'add')); ?> </li>
	</ul>
</div>
