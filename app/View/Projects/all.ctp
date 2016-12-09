<div class="panel panel-default">
	<div class="panel-heading">
		<h4><b>Projects Listing</b></h4>
	</div>
	<ol class="breadcrumb bread-primary ">
		
	</ol>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Project Id</th>
						<th>Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row"><input type="text" class="form-control" placeholder="Project Id"></th>
						<td><input type="text" class="form-control" placeholder="Name"></td>
						<td><select class="form-control">
						<option>- Status -</option>
								<option>Active</option>
								<option>On Hold</option>
								<option>Working</option>
								
							</select></td>
						<td></td>
					</tr>
					<?php 
					if(!empty($userProjects)) {
						foreach($userProjects as $k=>$v) {
							
							echo '<tr>';
								echo '<th scope="row">'.$v->id.'</th>';
								echo '<td>'.$v->name.'</td>';
								echo '<td>'.$v->status.'</td>';
								echo '<td>'.$this->Html->link('View Detail', array('controller'=>'projects','action'=>'view',$v->id), array('class'=>'btn btn-success')).'</td>';
							echo '</tr>';
						}
					}  else  {
						echo '<tr>';
							echo '<th colspan="4">No Project assigned.</th>';
						echo '</tr>';
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
