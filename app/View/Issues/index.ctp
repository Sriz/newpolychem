<div class="container">
	<h2><?php echo __('Issues'); ?>
	</h2>
	<?php
			echo '<table style="padding:0px;margin:0px;" class="table" border="0px"><tr><td width="200px;">'.$this->Search->create('',array('class'=>'form-inline'));
			echo $this->Search->input('filter1',array('type'=>'text','placeholder'=>'Search......','class'=>'search-query form-control input input-sm'));
			echo  '</td><td>'.$this->Search->end(__('Search',array('class'=>'btn btn-danger'), true)).'</td><td><button type="button" style="float:left;position:relative;width: 130px;font-size: 16px;" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add New Issue</button></td></tr></table>';
		?>
	<table class="table" id="mainTable">
	<tr>
			<th><?php echo $this->Paginator->sort('issue_id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('material_id'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th><?php echo $this->Paginator->sort('issued_to'); ?></th>
			<th><?php echo $this->Paginator->sort('issued_by'); ?></th>
			<?php //echo $this->Paginator->sort('category_id'); ?>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($issues as $issue): ?>
	<tr class="success">
		<td><?php echo h($issue['Issue']['issue_id']); ?>&nbsp;</td>
		<td><?php echo h($issue['Issue']['date']); ?>&nbsp;</td>
		<td><?php echo h($issue['Issue']['material_id']); ?>&nbsp;</td>
		<td><?php echo h(number_format($issue['Issue']['quantity'])); ?>&nbsp;</td>
		<td><?php echo h($issue['Issue']['department_id']); ?>&nbsp;</td>
		<td><?php echo h($issue['Issue']['issued_to']); ?>&nbsp;</td>
		<td><?php echo h($issue['Issue']['issued_by']); ?>&nbsp;</td>
		
		<td class="actions">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add</button>
			<?php echo $this->Html->link(__('Edit'), array('class'=>'btn btn-primary btn-xs','action' => 'edit', $issue['Issue']['issue_id'])); ?>			
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $issue['Issue']['issue_id']), null, __('Are you sure you want to delete # %s?', $issue['Issue']['issue_id'])); ?>
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
        <h4 class="modal-title">Issues</h4>
      </div>
      <div class="modal-body">
       <?php echo $this->Form->create(null,array(
		'url' => array('controller' => 'Issues', 'action' => 'add'),
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
			echo $this->Form->input('issued_to',array('class'=>'form-control input-sm','options'=>$store));
			echo $this->Form->input('material_id',array('class'=>'form-control input-sm','options'=>$opt));
			echo $this->Form->input('quantity',array('class'=>'form-control input-sm'));
			echo $this->Form->input('department_id',array('class'=>'form-control input-sm','type'=>'hidden','id'=>'department'));
			echo $this->Form->input('date',array('class'=>'form-control input-sm','type'=>'hidden','id'=>'datetime'));
			echo $this->Form->input('issued_by',array('class'=>'form-control input-sm','id'=>'user','type'=>'hidden'));
		//	echo $this->Form->input('category_id',array('class'=>'form-control input-sm','type'=>'hidden'));
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

