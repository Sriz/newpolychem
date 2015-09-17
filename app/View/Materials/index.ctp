<div class="materials index">
	<h2><?php echo __('Materials'); ?>
	<?php
			echo'	<div class = "action" style="float:right;">'.
				'<button type="button" style="width: 150px;height: 30px;font-size: 16px;" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add Materials</button>'.
				'</div>';		
	?>
	</h2>
	
	<table class="table" id="mainTable">
	<tr>
			<th><?php echo $this->Paginator->sort('material_id'); ?></th>
			<th><?php echo $this->Paginator->sort('material_name'); ?></th>
			<th><?php echo $this->Paginator->sort('material_state'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('vender_id'); ?></th>
			<th><?php echo $this->Paginator->sort('measuring_unit'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($materials as $material): ?>
	<tr class="success">
		<td><?php echo h($material['Material']['material_id']); ?>&nbsp;</td>
		<td><?php echo h($material['Material']['material_name']); ?>&nbsp;</td>
		<td><?php echo h($material['Material']['material_state']); ?>&nbsp;</td>
		<td><?php echo h($material['Material']['category_id']); ?>&nbsp;</td>
		<td><?php echo h($material['Material']['vender_id']); ?>&nbsp;</td>
		<td><?php echo h($material['Material']['measuring_unit']); ?>&nbsp;</td>
		<td class="actions">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add</button>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $material['Material']['material_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $material['Material']['material_id']), null, __('Are you sure you want to delete # %s?', $material['Material']['material_id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
	
	

	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	
	<div id="myModal" class="modal fade" role="dialog">
	
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Materials</h4>
      </div>
      <div class="modal-body">
     <?php echo $this->Form->create(null,array(
		'url' => array('controller' => 'Materials', 'action' => 'add'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));
    ?>
	<fieldset>
			<?php
			
		echo $this->Form->input('material_name',array('class'=>'form-control input-sm'));
		echo $this->Form->input('material_state',array('class'=>'form-control input-sm','options'=>array('solid'=>'solid','liquid'=>'liquid','others'=>'others')));
		echo $this->Form->input('category_id',array('class'=>'form-control input-sm','options'=>$opt));
		echo $this->Form->input('vender_id',array('class'=>'form-control input-sm','options'=>$opt1));
		echo $this->Form->input('measuring_unit',array('class'=>'form-control input-sm'));
	?>
	</fieldset>

      </div>
	   <div class="modal-footer">
              <?php echo $this->Form->end(__('Submit')); ?>
            </div>
     
    </div>

  </div>
</div>
	
	
	
	
	
</div>

