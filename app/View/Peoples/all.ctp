	<div class="panel panel-default">
				<div class="panel-heading"><h4><b>Users Listing</b></h4></div>
				<ol class="breadcrumb bread-primary ">

				</ol>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>User Id </th>
									<th>First Name </th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Cost Rate </th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row"><input type="text" class="form-control" placeholder="ID"></th>
									<td><input type="text" class="form-control" placeholder="First Name"></td>
									<td><input type="text" class="form-control" placeholder="Last Name"></td>
									<td><input type="text" class="form-control" placeholder="Email"></td>
									<td><select class="form-control amount-prefix ">
											<option>&lt; </option>
											<option>&lt;=</option>
											<option>&gt;</option>
											<option>&gt;=</option>
											<option>=</option>
												<option>!=</option>
										</select> <input type="text" placeholder="Amount" class="amount form-control"></td>
									<td></td>
								</tr>
								<?php
								foreach($peopleData['data'] as $k=>$v) {
									echo "<tr>";
										echo "<td>".$v['user_id']."</td>";
										echo "<td>".$v['first_name']."</td>";
										echo "<td>".$v['last_name']."</td>";
										echo "<td>".$v['email']."</td>";
										echo "<td>"."$0.00"."</td>";
										echo "<td>";
										echo $this->Html->link('View',array('controller' => 'peoples', 'action' => 'view', $v['user_id']), 
										array("class"=>"btn btn-success"));
										echo "</td>";
									echo "</tr>";
								}
								?>
							</tbody>
						</table>
						<?php 
							$curPage 	= $peopleData['pager']['page'];
							$totalPages = $peopleData['pager']['pages']; 
							$linkary = array();
							if($curPage <= 5) {
								$linkary = array(1=>'1',2=>'2',3=>'3',4=>'4',5=>'5',6=>'6',7=>'7',8=>'8',9=>'9',10=>'>>');
							}  else {
								$linkary = array(
								$curPage-5 => '<<',
								$curPage-4 => $curPage-4,
								$curPage-3 => $curPage-3,
								$curPage-2 => $curPage-2,
								$curPage-1 => $curPage-1,
								$curPage => $curPage,
								$curPage+1 => $curPage+1,
								$curPage+2 => $curPage+2,
								$curPage+3 => $curPage+3,
								$curPage+4 => $curPage+4,
								$curPage+5 => '>>'
								);
							}
						?>
						<div class="text-right">
							 <ul class="pagination">
							<?php foreach($linkary as $k=>$v) { 
								if($k <= $totalPages ) {
									if ($curPage==$k) {
										echo '<li class="active">';
									}  else  {
										echo '<li>';
									}
									echo $this->Html->link($v,array('controller' => 'peoples', 'action' => 'all', $k));
									echo '</li>';
								}
							} ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		
