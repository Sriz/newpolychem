<script>

         $(document).ready(function(){
              $('.nepali-calendar').nepaliDatePicker();
         });
   	$(document).ready(function(){
    $("#nepali-calendar").focus(function(e){
        //$("span").css("display", "inline").fadeOut(2000);
		console.log("focus")
		showCalendarBox('nepali-calendar');
    });
});
	
</script>
<div class="requests form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'Requests', 'action' => 'add'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('Request'); ?>
	<fieldset>
		<legend><?php echo __('Add Request'); ?></legend>
	<?php
	//$date = date('d-m-Y');
		echo $this->Form->input('date',array('class'=>'input input-sm nepali-calendar','id'=>'nepali-calendar'));
		echo $this->Form->input('department_id',array('type'=>'text','value'=>AuthComponent::user('role'),'class'=>'input input-sm'));
		echo $this->Form->input('material_id',array('options'=>$materials,'class'=>'input input-sm'));
		echo $this->Form->input('quantity',array('class'=>'input input-sm'));
		echo $this->Form->input('remarks',array('class'=>'input input-sm'));
		echo $this->Form->input('user_id',array('type'=>'text','id'=>'user','class'=>'input input-sm'));
	
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Requests'), array('action' => 'index')); ?></li>
	</ul>
</div>
