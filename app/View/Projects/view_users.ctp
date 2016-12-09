<?php 
//echo "<pre>"; print_r($project_users); die;
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4><b>Project Detail View</b></h4>
	</div>
	<ol class="breadcrumb bread-primary ">
		<li ><?php echo $this->Html->link('Projects',array('controller'=>'projects','action'=>'all')); ?></li>
		<li class="active"><?php echo $project_detail['name'].' ('.$project_detail['id'].')';?></li>
		<li class="active">Overview</li>
		
	</ol>
	<div class="panel-body">
		<div class="project-details-container">
			<ul class="project-details-tabs">
				<li class="col-md-4">
					<?php echo $this->Html->link('Overview',array('controller'=>'projects','action'=>'view',$project_detail['id']), array("class"=>"")); ?>
				</li>
				<li class="col-md-4">
					<?php echo $this->Html->link('Users',array('controller'=>'projects','action'=>'view',$project_detail['id'],'users'), array("class"=>"active")); ?>
				</li>
				<li class="col-md-4">
					<?php echo $this->Html->link('Budget Detail',array('controller'=>'projects','action'=>'view',$project_detail['id'],'budget'), array("class"=>"")); ?>
				</li>
			</ul> 
			<div class="project-details-content">
				<div class="project-table">
								
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Role / Title</th>
												<th>User Id</th>
												<th>Name</th>
												<th>Email</th>
												<th>Teamwork Profile</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if($project_users->STATUS == 'OK') {
												foreach($project_users->people as $k=>$v) {
													$v = (array)$v;
													echo "<tr>";
														echo "<td><b>";
														echo (empty($v['title']))?"-":$v['title']."</b></td>";
														echo "<td>".$v['id']."</td>";
														echo "<td>".$v['first-name']." ".$v['last-name']."</td>";
														echo "<td>".$v['email-address']."</td>";
														echo "<td>".$this->Html->link('View on Teamwork','https://buzinga.teamwork.com/#/people/'.$v['id'].'')."</td>";
													echo "</tr>";
												} //https://buzinga.teamwork.com/#/people/185657
											}   else  {
												echo "<tr>";
													echo "<td colspan='5'>No user assign to this project.</td>";
												echo "</tr>";
											}
											?>
											
											
										</tbody>
									</table>
									<!--<div class="text-right">
										 <ul class="pagination">
										  <li class="active"><a href="#">1</a></li>
										  <li><a href="#">2</a></li>
										  <li><a href="#">3</a></li>
										  <li><a href="#">4</a></li>
										  <li><a href="#">5</a></li>
										  <li><a href="#">Next</a></li>
										</ul>
									</div>-->
								</div>
								
							</div>
							
							
			</div>
		</div>
	</div>
</div>
	

