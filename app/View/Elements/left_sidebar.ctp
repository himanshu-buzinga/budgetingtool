<div class="side-menu">
	<nav class="navbar navbar-default" role="navigation"> 
		<!-- Main Menu -->
		<div class="side-menu-container">
			<ul class="nav navbar-nav">
				<li class="<?php echo ($this->params['controller'] == 'projects')?"active":""; ?>" > 
					<a  href="<?php echo $this->webroot.'projects/all'; ?>">
						<span class="glyphicon glyphicon-list-alt"></span> Projects  
					</a>
				</li>
				<li class="<?php echo ($this->params['controller'] == 'peoples')?"active":""; ?>" > 
					<a  href="<?php echo $this->webroot.'peoples/all'; ?>">
						<span class="glyphicon glyphicon-user"></span> Users  
					</a>
				</li>
				<li class="<?php echo ($this->params['controller'] == 'budgets')?"active":""; ?>" > 
					<a  href="<?php echo $this->webroot.'budgets/all'; ?>">
						<span class="glyphicon glyphicon-briefcase"></span> Total Budget
					</a>
				</li>
			</ul>
		</div> 
	</nav>
</div>
