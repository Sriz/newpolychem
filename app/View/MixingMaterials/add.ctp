<div class="mixingMaterials form">
<?php echo $this->Form->create('MixingMaterial'); ?>
        <?php
        $arr = array();
        foreach($category as $c):
            $arr[$c['CategoryMaterial']['id']]=$c['CategoryMaterial']['name'];
        endforeach;
        ?>
	<fieldset>
		<legend><?php echo __('Add Mixing Material'); ?></legend>
	<?php
		echo $this->Form->input('name');
		//echo $this->Form->input('department');

		echo $this->Form->input('category_id',['options'=>$arr, 'label'=>'Category', 'empty'=>'No-Category']);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Mixing Materials'), array('action' => 'index')); ?></li>
	</ul>
</div>
