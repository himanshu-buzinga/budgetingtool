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
						<?php echo $this->Form->input('email_id', array('type'=>'email', 'div'=>false,'label'=>false,"placeholder"=>"Email Address", "required"=>true)); ?>
						<p class="input-help-text">&nbsp;Email address registered with teamwork account.</p>
						<br />
						<?php echo $this->Form->input('api_key', array('type'=>'password','div'=>false,'label'=>false,"placeholder"=>"API Key", "required"=>true)); ?>
						<p class="input-help-text">&nbsp;API Key of your teamwork account.</p>
				<?php 
				echo '<div class="form-login-button">';
				echo $this->Form->button('< Login', array('type' => 'button','onclick' => 'location.href=\'/bzng\''));
				echo $this->Form->button('Next');
				echo '</div>';
				//echo $this->Form->end(__('Next')); 
				?>
			</div>
		</div>
	</div>
</div>
