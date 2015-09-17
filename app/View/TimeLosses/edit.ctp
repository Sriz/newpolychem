<script type="text/javascript">
 $(document).ready(function()
	  {
		 $( '#endtime' ).focusout(function() {
			calculate();
  })
	  });

         $(document).ready(function(){
              $('.nepalidatepicker').nepaliDatePicker();
         });
   	$(document).ready(function(){
    $("#nepalidatepicker").focus(function(e){
        //$("span").css("display", "inline").fadeOut(2000);
		//console.log("focus")
		showCalendarBox('nepalidatepicker');
    });
});
	

	function calculate()
	{
		 var starttime = $('#starttime').val();
        var endtime = $('#endtime').val();
        if (starttime.indexOf('.') >= 0) {
            var arr0 = starttime.split('.');
            if (arr0[1].length == 1) {
                arr0[1] = arr0[1] * 10;
                starttime = arr0[0] + '.' + arr0[1];
            }
        }
        if (endtime.indexOf('.') >= 0) {
            var arr1 = endtime.split('.');
            if (arr1[1].length == 1) {
                arr1[1] = arr1[1] * 10;
                endtime = arr1[0] + '.' + arr1[1];
            }
        }
        var breakfast = moment(starttime, 'HH.mm');
        var lunch = moment(endtime, 'HH.mm');
        var different = lunch - breakfast;
        var t = moment.duration(different).as('minutes');
        var sec = moment.duration(different).as('seconds');
        var hours = Math.floor(t / 60);
        var min = t % 60;
        var losstime = hours + "." + min;
        $('#totalloss').val(Math.abs(losstime));
        $('#totalloss_sec').val(Math.abs(sec));
   }
   

  
					  
		
		
		
	
	function fetchdata()
	{
	 var qty
	 var department=document.getElementById('department').value;
	 var x = document.getElementsByClassName('type');
for(i = 0; i < x.length; i++) {
	var e = document.getElementById("type");
    qty = e.options[e.selectedIndex].text;
                

    }
	var dataString = 'id='+ qty+ '&departmentid=' + department ;
        
    $.ajax
({
type: "POST",
url: "/polychem/TimeLosses/fetchreason",
data: dataString,
cache: false,
success: function(html)
{
$(".reason").html(html);
}
});
	
	}
</script>
<div class="panel panel-primary">

	
		<div class="panel-heading"><?php echo __('EDIT Time Loss'); ?></div>
		<div class="panel-body">
			<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'TimeLosses', 'action' => 'edit'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));
 ?>
		<fieldset>
	<?php
	//print_r($type);
		//$date= date('d-m-Y');
		echo $this->Form->input('id');
		echo $this->Form->input('nepalidate',array('id'=>'nepalidatepicker','type'=>'text','class'=>'nepalidatepicker form-control input-sm'));
		//echo $this->Form->input('date',array('type'=>'text','value'=>$date,'class'=>array('form-control input-sm')));
		echo $this->Form->input('shift',array('options'=>array('null'=>'Please Select','A'=>'A','B'=>'B'),'class'=>'form-control input-sm'));
		echo $this->Form->input('department_id',array('id'=>'department','type'=>'hidden','value'=>'calender','class'=>'form-control input-sm'));
		echo $this->Form->input('type',array('id'=>'type','class'=>array('type','form-control','input-sm'),'options'=>array('please select'=>'please select','BreakDown'=>'BreakDown','LossHour'=>'LossHour'),'onchange'=>'fetchdata()'));
		echo $this->Form->input('reasons',array('id'=>'reasons','options'=>$type,'class'=>array('reason','form-control input-sm')));
		echo $this->Form->input('time',array('id'=>'starttime','class'=>'form-control input-sm','label'=>array('class'=>'col-sm-2 control-label','text'=>'Start Time')));
		echo $this->Form->input('wk_hrs',array('label'=>array('class'=>'col-sm-2 control-label','text'=>'End Time'),'class'=>'form-control input-sm','type'=>'text','id'=>'endtime','onchange'=>'calculate()'));
		 //echo $form->input('Contact.name', array('label' => array('class' => 'Your-Class', 'text' => 'Name<span style="color:#f89e01">*</span> :'), 'size' => '25'));
	echo $this->Form->input('totalloss',array('label'=>array('class'=>'col-sm-2 control-label','text'=>'Total Loss'),'id'=>'totalloss','readonly','class'=>array('totalloss','form-control input-sm')));
	
			?>
		<div style="margin-left: 10px;">
			<?php echo $this->Form->end(__('Submit')); ?>
			</div>
	</fieldset>

</div>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Time Losses'), array('action' => 'index')); ?></li>
	</ul>
</div>
