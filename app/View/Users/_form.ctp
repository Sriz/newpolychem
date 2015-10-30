<div class="row">
  <div class="col-lg-4 col-lg-offset-4">
    <?php echo $this->Form->create('User');?>
    <div class="center">
      <h2><?php echo $label ?></h2>
    </div>

    <hr>
        <?php echo $this->Form->input('username',array(
            'label' => __('Username'),
            'value' => !empty( $user['username'] ) ? $user['username'] : ''));?>
      
        <?php echo $this->Form->input('email', array(
            'label' => __('Email'),
            'value' => !empty( $user['email'] ) ? $user['email'] : ''));?>
     
        <?php echo $this->Form->input('password',array(
            'label' => __('Password'),
            'value' => false));?>


	      <?php if(AuthComponent::user('role') == 'admin'){?>
        <?php echo $this->Form->input('role', array(
            'label' => __('Department'),
            'options' => array('admin' => __('admin'), 'store' => __('store'),'mixing'=>__('mixing'),
							   'calender'=>__('calender'),'printing'=>__('printing'),'laminating'=>__('laminating'),'scrap'=>__('scrap'),'electronic'=>__('electronic'),'rexin'=>__('rexin'),'mechanical'=>__('mechanical')),
            'selected' => !empty( $user['role'] ) ? $user['role'] : ''));?>
	      <?php }?>
      
        <?php echo $this->Form->end(__("Submit"));?>
  </div>
</div>
