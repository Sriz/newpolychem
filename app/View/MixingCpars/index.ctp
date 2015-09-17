<div class="mixingCpars index">
	<h2><?php echo __('Mixing Cpars'); ?></h2>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('shift'); ?></th>
			<th><?php echo $this->Paginator->sort('supervisor_name'); ?></th>
			<th><?php echo $this->Paginator->sort('operator_name'); ?></th>
			<th><?php echo $this->Paginator->sort('quality'); ?></th>
			<th style="text-align: right;"><?php echo $this->Paginator->sort('noofcharge'); ?></th>
			<th><?php echo $this->Paginator->sort('color'); ?></th>
			<th><?php echo $this->Paginator->sort('material_id'); ?></th>
			<th><?php echo $this->Paginator->sort('standard'); ?></th>
			<th><?php echo $this->Paginator->sort('blenderquality'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mixingCpars as $mixingCpar): ?>
	<tr class="success">
		<td><?php echo h($mixingCpar['MixingCpar']['id']); ?>&nbsp;</td>
		<td><?php echo h($mixingCpar['MixingCpar']['date']); ?>&nbsp;</td>
		<td><?php echo h($mixingCpar['MixingCpar']['shift']); ?>&nbsp;</td>
		<td><?php echo h($mixingCpar['MixingCpar']['supervisor_name']); ?>&nbsp;</td>
		<td><?php echo h($mixingCpar['MixingCpar']['operator_name']); ?>&nbsp;</td>
		<td><?php echo h($mixingCpar['MixingCpar']['quality']); ?>&nbsp;</td>
		<td style="text-align: right;"><?php echo h($mixingCpar['MixingCpar']['noofcharge']); ?>&nbsp;</td>
		<td><?php echo h($mixingCpar['MixingCpar']['color']); ?>&nbsp;</td>
		<td><?php echo h($mixingCpar['MixingCpar']['material_id']); ?>&nbsp;</td>
		<td><?php echo h($mixingCpar['MixingCpar']['standard']); ?>&nbsp;</td>
		<td><?php echo h($mixingCpar['MixingCpar']['blenderquality']); ?>&nbsp;</td>
		<td class="actions">
			<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Add</button>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mixingCpar['MixingCpar']['id']), null, __('Are you sure you want to delete # %s?', $mixingCpar['MixingCpar']['id'])); ?>
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
	<ul class="paging">
	
		<li><?php echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));?></li>
		<li><?php echo $this->Paginator->numbers(array('separator' => ''));echo '</li>';?></li>
		<li><?php echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));echo '</li>';?></li>
	
	</ul>
	
	<div id="myModal" class="modal fade" role="dialog">
	
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CPAR </h4>
      </div>
      <div class="modal-body">
      <?php echo $this->Form->create(null,array(
		'url' => array('controller' => 'MixingCpars', 'action' => 'add'),
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
		echo $this->Form->input('date',array('type'=>'hidden','id'=>'datetime'));
		echo $this->Form->input('shift',array('id'=>'shift','type'=>'hidden'));
		echo $this->Form->input('supervisor_name',array('class'=>'input input-sm'));
		echo $this->Form->input('operator_name',array('class'=>'input input-sm'));
		echo $this->Form->input('quality',array('class'=>'input input-sm','options'=>$opt1));
		echo $this->Form->input('noofcharge',array('type'=>'hidden'));
		echo $this->Form->input('color',array('class'=>'input input-sm'));
		echo $this->Form->input('material_id',array('class'=>'form-control input-sm','options'=>$opt,'id'=>'row1'));
		echo $this->Form->input('standard',array('class'=>'input input-sm','id'=>'std'));
		echo $this->Form->input('Blender Quality',array('name'=>'data[MixingCpar][blenderquality]','class'=>'input input-sm','id'=>'blender'));
		echo '<div class="addbox"><button type="button" class="btn btn-primary btn-sm" id="irow1">+add</button></div>';
	?>
	  <table class="table" id="mtable1"> <tr><th class="success">Material</th><th class="success">Quantity</th><th class="success">Blender Quantity</th></tr>   
    <tr>
        <td >
        
        </td>
        <td>
           
        </td>
		<td>
           
        </td>
		
	
       
    </tr>
</table>
	  
	  
	  
	</fieldset>

      </div>
	   <div class="modal-footer">
              <?php echo $this->Form->end(__('Submit')); ?>
            </div>
     
    </div>

  </div>
</div>
	
	
	
	
	
</div>

