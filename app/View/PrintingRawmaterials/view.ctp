<div class="printingRawmaterials view">
<h2><?php echo __('Printing Rawmaterial'); ?></h2>
	<dl>
		<dt><?php echo __('Printing Rawmaterialid'); ?></dt>
		<dd>
			<?php echo h($printingRawmaterial['PrintingRawmaterial']['printing_rawmaterialid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($printingRawmaterial['PrintingRawmaterial']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Printing Rawmaterial'), array('action' => 'edit', $printingRawmaterial['PrintingRawmaterial']['printing_rawmaterialid'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printing Rawmaterial'), array('action' => 'delete', $printingRawmaterial['PrintingRawmaterial']['printing_rawmaterialid']), null, __('Are you sure you want to delete # %s?', $printingRawmaterial['PrintingRawmaterial']['printing_rawmaterialid'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printing Rawmaterials'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printing Rawmaterial'), array('action' => 'add')); ?> </li>
	</ul>
</div>
