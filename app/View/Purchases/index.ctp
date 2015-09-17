<div class="purchases index">
	<h2><?php echo __('Purchases'); ?>
	<?php
			echo'	<div class = "action" style="float:right;">'.
				'<button type="button" style="width: 150px;height: 30px;font-size: 16px;" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add Purchase</button>'.
				'</div>';		
	?></h2>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('purchase_id'); ?></th>
			<th><?php echo $this->Paginator->sort('purchase_date'); ?></th>
			<th><?php echo $this->Paginator->sort('material_id'); ?></th>
			<th><?php echo $this->Paginator->sort('vender_id'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('purchase_price'); ?></th>
			<th><?php echo $this->Paginator->sort('purchase_user'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($purchases as $purchase): ?>
	<tr class="success">
		<td><?php echo h($purchase['Purchase']['purchase_id']); ?>&nbsp;</td>
		<td><?php echo h($purchase['Purchase']['purchase_date']); ?>&nbsp;</td>
		<td><?php echo h($purchase['Purchase']['material_id']); ?>&nbsp;</td>
		<td><?php echo h($purchase['Purchase']['vender_id']); ?>&nbsp;</td>
		<td><?php echo h(number_format($purchase['Purchase']['quantity'])); ?>&nbsp;</td>
		<td><?php echo h(number_format($purchase['Purchase']['purchase_price'],2)); ?>&nbsp;</td>
		<td><?php echo h($purchase['Purchase']['purchase_user']); ?>&nbsp;</td>
		<td class="actions">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add</button>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $purchase['Purchase']['purchase_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $purchase['Purchase']['purchase_id']), null, __('Are you sure you want to delete # %s?', $purchase['Purchase']['purchase_id'])); ?>
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
        <h4 class="modal-title">Purchase</h4>
      </div>
      <div class="modal-body">
     <?php echo $this->Form->create(null,array(
		'url' => array('controller' => 'Purchases', 'action' => 'add'),
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
			$d = date('d-m-y');
		echo $this->Form->input('material_id',array('class'=>'form-control input input-sm','options'=>$opt,'id'=>'row'));
		echo $this->Form->input('vender_id',array('class'=>'form-control input input-sm','options'=>$opt1));
		echo $this->Form->input('category_id',array('class'=>'form-control input-sm','options'=>$opt2));
		echo $this->Form->input('quantity',array('class'=>'form-control input-sm','id'=>'qty'));
		echo $this->Form->input('purchase_price',array('class'=>'form-control input-sm'));
		echo $this->Form->input('purchase_date',array('class'=>'form-control input-sm','id'=>'date','type'=>'text','value'=>$d));
		echo $this->Form->input('purchase_user',array('class'=>'form-control input-sm'));
		echo '<div class="form-group" align="center">';
		echo $this->Form->end(__('Submit'));
		echo '</div>';
		//echo '<div class="addbox"> <button type="button" class="btn btn-primary btn-sm" id="irow">+add</button></div>';
	?>
	
	</fieldset>

      </div>
	   
     
    </div>

  </div>
</div>
	
	
	
	
	
</div>

