
<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
			<div class="form-login">
				<div class="logo-login">
					<img src="/bzng/img/buzinga.png" />
					<p class="login-headline">Register with teamwork</p>
				</div>
				<?php echo $this->Form->create('User'); ?>
				<?php echo $this->Flash->render('tw_auth'); ?>
					<?php echo $this->Form->hidden('user_id', array('value'=>$reqData->id)); ?>
					<?php echo $this->Form->hidden('api_key', array('value'=>$reqData->apikey)); ?> 
					<?php echo $this->Form->hidden('username', array('value'=>$reqData->email)); ?> 
					<?php echo $this->Form->hidden('first_name', array('value'=>$reqData->first_name)); ?> 
					<?php echo $this->Form->hidden('last_name', array('value'=>$reqData->last_name)); ?> 
					
					<?php echo $this->Form->input('email', array('value'=>$reqData->email,'type'=>'email', 'div'=>false,'label'=>false,"placeholder"=>"Email Address", "required"=>true, "disabled"=>true)); ?>
					<br /><br />
					<?php echo $this->Form->input('password', array('type'=>'password','div'=>false,'label'=>false,"placeholder"=>"Password", "required"=>true)); ?>
					<br /><br />
					<?php echo $this->Form->input('confirmPassword', array('type'=>'password','div'=>false,'label'=>false,"placeholder"=>"Confirm Password", "required"=>true)); ?>
				<?php 
					echo '<div class="form-login-button">';
					echo $this->Form->button('Complete your Registration');
					echo '</div>';
				 ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" >

var password = document.getElementById("UserPassword")
  , confirm_password = document.getElementById("UserConfirmPassword");

function validatePassword(){
  if(password.value.length >= 6) {
	  password.setCustomValidity('');
	  if(password.value != confirm_password.value) {
		confirm_password.setCustomValidity("Passwords Don't Match");
	  } else {
		confirm_password.setCustomValidity('');
	  }
  }  else {
	  password.setCustomValidity("Passwords length must be greater than 6.");
	  confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
