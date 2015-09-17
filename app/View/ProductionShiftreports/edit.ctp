<script>
	$( document ).ready(function() {
if ($("#ot").val()=="0") {
	$("#ot").attr('disabled','disabled');   
}

if ($("#mt").val()=="0") {
	$("#mt").attr('disabled','disabled');   
}

if ($("#ut").val()=="0") {
	$("#ut").attr('disabled','disabled');   
}
if ($("#pf").val()=="0") {
	$("#pf").attr('disabled','disabled');   
}
if ($("#ct").val()=="0") {
	$("#ct").attr('disabled','disabled');   
}




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
	function fetchdata()
	{
	  var x = document.getElementsByClassName('brand');
for(i = 0; i < x.length; i++) {
	var e = document.getElementById("brand");
var strUser = e.options[e.selectedIndex].text;
  x[i].value = strUser;
  
  
  
  
  
	  
}
 
  var dataString = 'id='+ strUser;
  
    $.ajax
({
type: "POST",
url: "/polychem/ProductionShiftreports/color",
data: dataString,
cache: false,
success: function(html)
{
$(".color").html(html);
}
});
	 
	  if(strUser=='Calio') { 
    		$("#ot").attr("disabled", "disabled");
			$("#mt").attr("disabled", false);
			$("#pf").attr("disabled", false);
			$("#ct").attr("disabled", false);
			
			
       
    	}
	  else if(strUser=='Carnival'){
			$("#mt").attr("disabled", "disabled");
			$("#ot").attr("disabled", "disabled");
			$("#ct").attr("disabled", false);
			$("#pf").attr("disabled", false);
				
	  }
	  else if(strUser=='Calio Max'){
			
			$("#ot").attr("disabled", "disabled");
				$("#mt").attr("disabled", false);
					$("#pf").attr("disabled", false);
						$("#ct").attr("disabled", false);
	  }
	  else if(strUser=='Chipps'){
			
			$("#ot").attr("disabled", "disabled");
				$("#mt").attr("disabled", false);
					$("#pf").attr("disabled", false);
				  $("#ct").attr("disabled", false);
				  	
	  }
	  else if(strUser=='Galaxy'){
			$("#mt").attr("disabled", "disabled");
			$("#ot").attr("disabled", "disabled");
				$("#pf").attr("disabled", false);
					$("#ct").attr("disabled", false);
	  }
	  else if(strUser=='Jupiter'){
			$("#ct").attr("disabled", "disabled");
			$("#pf").attr("disabled", "disabled");
				$("#mt").attr("disabled", false);
					$("#ot").attr("disabled", false);
	  }
	  else if(strUser=='Mars'){
			$("#ct").attr("disabled", "disabled");
			$("#pf").attr("disabled", "disabled");
			$("#mt").attr("disabled", false);
				$("#ot").attr("disabled", false);
	  }
	  else if(strUser=='Neptune'){
			$("#ct").attr("disabled", "disabled");
			$("#pf").attr("disabled", "disabled");
				$("#mt").attr("disabled", false);
					$("#ot").attr("disabled", false);
	  }
	  else if(strUser=='Super Calio'){
			
			$("#ot").attr("disabled", "disabled");
				$("#mt").attr("disabled", false);
					$("#pf").attr("disabled", false);
						$("#ct").attr("disabled", false);
	  }
	  else if(strUser=='Venus'){
			$("#mt").attr("disabled", "disabled");
			$("#ot").attr("disabled", "disabled");
				$("#ct").attr("disabled", false);
					$("#pf").attr("disabled", false);
	  }
      else
      {
      
      } 
	}
</script>
<div class="productionShiftreports form">
<?php echo $this->Form->create(null,array(
	'url' => array('controller' => 'ProductionShiftreports', 'action' => 'edit'),
    'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => ' col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    )));//('ProductionShiftreport'); ?>
	<fieldset>
		<legend><?php echo __('Edit Production Shift Reports'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('shift');
		echo $this->Form->input('date',array('class'=>'nepalidatepicker','id'=>'nepalidatepicker'));
		echo $this->Form->input('brand',array('class'=>'brand','id'=>'brand','options'=>$opt,'onchange'=>'fetchdata()'));
		echo $this->Form->input('color',array('options'=>$opti,'class'=>'color','id'=>'color'));
		echo $this->Form->input('base_ut',array('label'=>array('class'=>'col-sm-2 control-label','text'=>'Base UT'),'default'=>'0','id'=>'ut'));
		echo $this->Form->input('base_mt',array('label'=>array('class'=>'col-sm-2 control-label','text'=>'Base MT'),'default'=>'0','id'=>'mt'));
		//echo $this->Form->input('print_m');
		echo $this->Form->input('base_ot',array('label'=>array('class'=>'col-sm-2 control-label','text'=>'Base OT'),'default'=>'0','id'=>'ot'));
		echo $this->Form->input('print_film',array('label'=>array('class'=>'col-sm-2 control-label','text'=>'Print Film'),'default'=>'0','id'=>'pf'));
		echo $this->Form->input('CT',array('label'=>array('class'=>'col-sm-2 control-label','text'=>'CT'),'default'=>'0','id'=>'ct'));
		echo $this->Form->input('output',array('default'=>'0'));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProductionShiftreport.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ProductionShiftreport.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Production Shift Reports'), array('action' => 'index')); ?></li>
	</ul>
</div>
