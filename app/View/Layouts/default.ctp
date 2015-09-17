<?php

?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $title_for_layout; ?> - <?php echo Configure::read('Application.name') ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
  	<?php echo $this->Html->css(array('bootstrap.min', 'font-asome/css/font-awesome.min','custom', 'sb-admin', 'style','jquery-ui','admin','jquery-ui','nepali.datepicker.css')); ?>
	<?php echo $this->CakeStrap->automaticCss(); ?>
	<?php echo $this->Html->script('lib/jquery.min'); ?>
	<?php echo $this->Html->script('lib/jquery'); ?>
	<?php echo $this->Html->script(array('lib/bootstrap.min','src/scripts','lib/nepali.datepicker.min','lib/xepOnline.jqPlugin.js','lib/bootbox.min')); ?>
	
	<?php //echo $this->Html->script('lib/jquery-ui') ?>
	<?php echo $this->Html->script('lib/bootstrap-editable') ?>
	<?php echo $this->Html->script('lib/moment') ?>
	<?php echo $this->fetch('meta');echo $this->fetch('css');//echo $this->fetch('script');?>
	<style>
			.addbox {
       position: relative;
bottom: 46px;
left: 325px;
}
			
	</style>
	<script>

   $( document ).ready(function() {
	
	var a="<?php
	$v=AuthComponent::user('role');	echo $v?>";
	var us="<?php
	$s=AuthComponent::user('username');	echo $s?>";
	    $('#department').val(a);
		$('#user').val(us);
		var dt = new Date();
var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
$('#datetime').val(dt);
	var dn=dt.getHours();
	var hr=((dn + 11) % 12 + 1)
	console.log(hr);
	if (dn>12) {
			$('#shift').val("A");
			
	}
	else
	{
			$('#shift').val("B");
	}
	
});

		
</script>

</head>

<body class="<?php echo $this->params->params['controller'].'_'.$this->params->params['action']?>">
<!--[if lt IE 7]>
<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser
	today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better
	experience this site.</p>
<![endif]-->


<div id="wrapper">

	<?php echo $this->element('nav')?>

	<div id="page-wrapper">

		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->



<?php echo $this->CakeStrap->automaticScript(); ?>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

<script>
	
	
	
	
</script>

</body>
</html>
