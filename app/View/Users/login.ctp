<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
        
            <div class="form-login">
				<div class="logo-login">
					<img src="/bzng/img/buzinga.png" />
				</div>
				<?php echo $this->Form->create('User'); ?>
				<?php echo $this->Flash->render('tw_auth'); ?>
						<?php echo $this->Form->input('user_name', array('div'=>false,'label'=>false,"placeholder"=>"Email Address")); ?>
						<br /><br />
						<?php echo $this->Form->input('password', array('div'=>false,'label'=>false,"placeholder"=>"Password")); ?>
				<?php echo $this->Form->end(__('Login')); ?>
				<div id="login-register">
				  <p>New to Buzinga Budgeting tool ?<br>
				  <?php echo $this->Html->link('Click Here', array('controller' => 'users','action'=> 'tw_authenticate')); ?>
				   to get register with teamwork.</p>
				</div> 
			</div>
        
        </div>
    </div>
</div>
