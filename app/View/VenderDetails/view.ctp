<div class="venderDetails view">
<h2><?php echo __('Vender Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Vender Id'); ?></dt>
		<dd>
			<?php echo h($venderDetail['VenderDetail']['vender_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vender Name'); ?></dt>
		<dd>
			<?php echo h($venderDetail['VenderDetail']['vender_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vender Phone'); ?></dt>
		<dd>
			<?php echo h($venderDetail['VenderDetail']['vender_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vender Location'); ?></dt>
		<dd>
			<?php echo h($venderDetail['VenderDetail']['vender_location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vender Mobile'); ?></dt>
		<dd>
			<?php echo h($venderDetail['VenderDetail']['vender_mobile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vender Email'); ?></dt>
		<dd>
			<?php echo h($venderDetail['VenderDetail']['vender_email']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vender Detail'), array('action' => 'edit', $venderDetail['VenderDetail']['vender_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vender Detail'), array('action' => 'delete', $venderDetail['VenderDetail']['vender_id']), null, __('Are you sure you want to delete # %s?', $venderDetail['VenderDetail']['vender_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Vender Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vender Detail'), array('action' => 'add')); ?> </li>
	</ul>
</div>
