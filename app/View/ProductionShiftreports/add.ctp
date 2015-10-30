<script>
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

	function checkoutput()
	{	
		var output = document.getElementById('output');
		var ut = document.getElementById('ut');
		var mt = document.getElementById('mt');
		var ot = document.getElementById('ot');
		var pf = document.getElementById('pf');
		var ct = document.getElementById('CT');

		if(output.value>ut.value || output.value>mt.value || output.value>ot.value || output.value>ut.value || output.value>pf.value || output.value>ct.value)
		{
			alert("Output should be lesser than Base-UT, Base-MT, Base-OT, Print Film and CT");
			
		}
	}

	function checksubmit()
	{
		var output = document.getElementById('output');
		var ut = document.getElementById('ut');
		var mt = document.getElementById('mt');
		var ot = document.getElementById('ot');
		var pf = document.getElementById('pf');
		var ct = document.getElementById('CT');

		if(output.value>ut.value || output.value>mt.value || output.value>ot.value || output.value>ut.value || output.value>pf.value || output.value>ct.value)
		{
			alert("Output should be lesser than Base-UT, Base-MT, Base-OT, Print Film and CT");
			
		}
	}
	  
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
<?php echo $this->Form->create(array('ProductionShiftreport', 'class' => 'form-horizontal',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
        'div' => array('class' => 'control-group'),
        'label' => array('class' => 'col-sm-2 control-label'),
        'between' => '<div class="col-xs-10">',
        'after' => '</div>',
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    ))); ?>
	<fieldset>
		<legend><?php echo __('Add Production Shiftreport'); ?></legend>
	<?php
	//$date = date('d-m-Y');
		echo $this->Form->input('date',array('type'=>'text','id'=>'nepalidatepicker','class'=>'form-control input-sm nepalidatepicker'));
		echo $this->Form->input('shift',array('options'=>array('A'=>'A','B'=>'B'),'class'=>'form-control input-sm'));
		echo $this->Form->input('brand',array('class'=>array('form-control','input-sm','brand'),'id'=>'brand','onchange'=>'fetchdata()','type'=>'select','options'=>array('Null'=>'Please Select',$opt),'default'=>'Please Select'));
		echo $this->Form->input('color',array('class'=>array('form-control','input-sm','color'),'id'=>'color','type'=>'select'));
		echo $this->Form->input('base_ut',array('label'=>array('class'=>'col-sm-2 control-label','text'=>'Base UT'),'class'=>array('form-control','input-sm'),'value'=>'0','id'=>'ut'));
		echo $this->Form->input('base_mt',array('label'=>array('class'=>'col-sm-2 control-label','text'=>'Base MT'),'class'=>array('form-control','input-sm'),'value'=>'0','id'=>'mt'));
		echo $this->Form->input('base_ot',array('label'=>array('class'=>'col-sm-2 control-label','text'=>'Base OT'),'class'=>array('form-control','input-sm'),'value'=>'0','id'=>'ot'));
		echo $this->Form->input('print_film',array('class'=>array('form-control','input-sm'),'value'=>'0','id'=>'pf'));
		echo $this->Form->input('CT',array('label'=>array('class'=>'col-sm-2 control-label','text'=>'CT'),'class'=>array('form-control','input-sm'),'value'=>'0','id'=>'ct'));
		echo $this->Form->input('output',array('class'=>array('form-control','input-sm'),'id'=>'output','value'=>'0','onkeyup'=>'checkoutput()'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'),array('onclick'=>'checksubmit()')); ?>
</div>