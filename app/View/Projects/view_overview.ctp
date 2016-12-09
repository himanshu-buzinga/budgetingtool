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
					<?php echo $this->Html->link('Overview',array('controller'=>'projects','action'=>'view',$project_detail['id']), array("class"=>"active")); ?>
				</li>
				<li class="col-md-4">
					<?php echo $this->Html->link('Users',array('controller'=>'projects','action'=>'view',$project_detail['id'],'users'), array("class"=>"")); ?>
				</li>
				<li class="col-md-4">
					<?php echo $this->Html->link('Budget Detail',array('controller'=>'projects','action'=>'view',$project_detail['id'],'budget'), array("class"=>"")); ?>
				</li>
			</ul> 
			<div class="project-details-content">
				<div class="project-overview">
					<div class="project-ve">
						<div class="col-md-3">Project Id:</div>
						<div class="col-md-9"><?php echo $project_detail['id']; ?></div>
					</div>
					<div class="project-ve">
						<div class="col-md-3">Name:</div>
						<div class="col-md-9"><?php echo $project_detail['name']; ?></div>
					</div>
					<div class="project-ve">
						<div class="col-md-3">Description:</div>
						<div class="col-md-9"><?php echo (strlen($project_detail['description']) > 0)?$project_detail['description']:'-'; ?></div>
					</div>
					<div class="project-ve">
						<div class="col-md-3">Company:</div>
						<div class="col-md-9"><b><?php echo $project_detail['company']->name; ?></b></div>
					</div>
					<div class="project-ve">
						<div class="col-md-3">Status:</div>
						<div class="col-md-9"><?php echo $project_detail['status']; ?></div>
					</div>
					<div class="project-ve">
						<div class="col-md-3">Created Date:</div>
						<div class="col-md-9"><?php echo date('Y-M-d H:i:s',strtotime($project_detail['created-on'])); ?></div>
					</div>
					<div class="project-ve">
						<div class="col-md-3">Last Updation Date:</div>
						<div class="col-md-9"><?php echo date('Y-M-d H:i:s',strtotime($project_detail['last-changed-on'])); ?></div>
					</div>
					<div class="project-ve">
						<div class="col-md-3">Teamwork Link:</div>
						<div class="col-md-9"><?php echo $this->Html->link('https://buzinga.teamwork.com/#/projects/'.$project_detail['id'].'/overview','https://buzinga.teamwork.com/#/projects/'.$project_detail['id'].'/overview', array('target' => '_blank'));	?></div>
					</div>
					<div class="project-ve">
						<div class="col-md-3">Categories: </div>
						<div class="col-md-9">-</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	

