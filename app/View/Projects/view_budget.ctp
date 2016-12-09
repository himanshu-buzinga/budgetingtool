<?php 
//echo "<pre>"; print_r($project_detail); die;
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
					<?php echo $this->Html->link('Users',array('controller'=>'projects','action'=>'view',$project_detail['id'],'users'), array("class"=>"")); ?>
				</li>
				<li class="col-md-4">
					<?php echo $this->Html->link('Budget Detail',array('controller'=>'projects','action'=>'view',$project_detail['id'],'budget'), array("class"=>"active")); ?>
				</li>
			</ul>  
			<div class="project-details-content">
				<div class="project-overview">
					<b>Coming Soon.</b>
				</div>
			</div>
		</div>
	</div>
</div>
	

